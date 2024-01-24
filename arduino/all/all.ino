#include <WiFiManager.h>
#include <WiFi.h>
#include <WiFiClientSecure.h>
#include <UniversalTelegramBot.h>
#include <ArduinoJson.h>
#include <OneWire.h>
#include <DallasTemperature.h>
#include <HTTPClient.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <Arduino_JSON.h>

#define ONE_WIRE_BUS 2
#define TURBIDITY_SENSOR_PIN 39

const int sensorPinNTU          = 35;
const int sensorPinPh           = A0;
float Po                        = 0;

const char* serverNameSave = "http://192.168.10.109/app-iot-suhu/welcome/api_save";
const char* serverNameConfig = "http://192.168.10.109/app-iot-suhu/welcome/api_config";
unsigned long lastTime = 0;
unsigned long timerDelay = 10000;

#define BOT_TOKEN "6698205127:AAHoSzyxNbCaxb2GK-NsbkpE9dJFIs-eLq0"
//#define CHAT_ID "5571110814"

const unsigned long BOT_MTBS = 1000; // mean time between scan messages
unsigned long bot_lasttime; // last time messages' scan has been done
WiFiClientSecure secured_client;
UniversalTelegramBot bot(BOT_TOKEN, secured_client);

OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);

LiquidCrystal_I2C lcd(0x27, 20, 4);

float ntu_val = 0;
String sensorReadings;

void handleNewMessages(int numNewMessages)
{
  Serial.print("handleNewMessages ");
  Serial.println(numNewMessages);

  String answer;
  float valueNTU = SensorNTU();
  float valueSuhu = SensorSuhu();
  float valueKelembapan = SensorKelembapan();
  float valuePH = SensPH();
  for (int i = 0; i < numNewMessages; i++)
  {
    telegramMessage &msg = bot.messages[i];
    Serial.println("Received " + msg.text);
    if (msg.text == "/help") {
      answer = "So you need _help_, uh? me too! use /start or /status";
    } else if (msg.text == "/start") {
      answer = "Welcome my new friend! You are the first *" + msg.from_name + "* I've ever met";
    } else if (msg.text == "/status") {
      answer = "SUHU :" + String(valueSuhu) + "\n";
      answer += "Kekeruhan : " + String(valueNTU) + "\n";
      answer += "Kelembapan : " + String(valueKelembapan) + "\n";
      answer += "PH Air : " + String(valuePH) + "\n";
    } else {
      answer = "Say what?";
    }
    bot.sendMessage(msg.chat_id, answer, "Markdown");
  }
}

void bot_setup()
{
  const String commands = F("["
                            "{\"command\":\"help\",  \"description\":\"Get bot usage help\"},"
                            "{\"command\":\"start\", \"description\":\"Message sent when you open a chat with a bot\"},"
                            "{\"command\":\"status\",\"description\":\"Answer device current status\"}" // no comma on last command
                            "]");
  bot.setMyCommands(commands);
  //bot.sendMessage("25235518", "Hola amigo!", "Markdown");
}

void actionBot() {
  if (millis() - bot_lasttime > BOT_MTBS)
  {
    int numNewMessages = bot.getUpdates(bot.last_message_received + 1);

    while (numNewMessages)
    {
      Serial.println("got response");
      handleNewMessages(numNewMessages);
      numNewMessages = bot.getUpdates(bot.last_message_received + 1);
    }

    bot_lasttime = millis();
  }
}

void setup() {
  Serial.begin(115200);
  lcd.init();
  sensors.begin();
  secured_client.setCACert(TELEGRAM_CERTIFICATE_ROOT);
  pinMode (sensorPinPh, INPUT);
  pinMode (sensorPinNTU, INPUT);
  WiFiManager wm;
  bool res;
  res = wm.autoConnect("iot-1221", "12345678");
  if (!res) {
    Serial.println("Failed to connect");
  }
  else {
    Serial.println("connected...yeey :)");
    Serial.print("\nWiFi connected. IP address: ");
    Serial.println(WiFi.localIP());
    lcd.backlight();
    lcd.clear();
    lcd.setCursor(3, 0);
    lcd.print("Wifi Connected");
    lcd.setCursor(0, 1);
    lcd.print(WiFi.localIP().toString());
  }

  Serial.print("Retrieving time: ");
  configTime(0, 0, "pool.ntp.org"); // get UTC time via NTP
  time_t now = time(nullptr);
  while (now < 24 * 3600)
  {
    Serial.print(".");
    delay(100);
    now = time(nullptr);
  }
  Serial.println(now);

  bot_setup();
  lcd.clear();

}

void loop() {
  actionBot();
  float valueNTU = SensorNTU();
  float valueSuhu = SensorSuhu();
  float valueKelembapan = SensorKelembapan();
  float valuePH = SensPH();

  lcd.setCursor(0, 0);
  lcd.print("Suhu");
  lcd.setCursor(10, 0);
  lcd.print(": " + String(valueSuhu) + " C");
  lcd.setCursor(0, 1);
  lcd.print("Kekeruhan");
  lcd.setCursor(10, 1);
  lcd.print(": " + String(valueNTU) + " NTU");
  lcd.setCursor(0, 2);
  lcd.print("Kelembapan");
  lcd.setCursor(10, 2);
  lcd.print(": " + String(valueKelembapan) );
  lcd.setCursor(0, 3);
  lcd.print("Level PH");
  lcd.setCursor(10, 3);
  lcd.print(": " + String(valuePH) );

  if ((millis() - lastTime) > timerDelay) {
    //Check WiFi connection status
    if (WiFi.status() == WL_CONNECTED) {
      WiFiClient client;
      HTTPClient http;
      http.begin(client, serverNameSave);
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");
      String httpRequestData = "suhu=" + String(valueSuhu) + "&ph=" + String(valuePH) + "&kelembapan=" + String(valueKelembapan) + "&kekeruhan=" + String(valueNTU);
      // Send HTTP POST request
      int httpResponseCode = http.POST(httpRequestData);
      http.end();
    }
    else {
      Serial.println("WiFi Disconnected");
    }
    lastTime = millis();
  }
}

float SensorNTU() {
  int sensorValue = analogRead(sensorPinNTU); // read the input on analog pin A0:
  float voltage = sensorValue * (3.3 / 4095.0);// Convert the analog reading (which goes from 0 - 4095.0) to a voltage (0 - 5V):
  float kekeruhan = map(voltage, 0.0, 3.3, 1000, 1); //memulai perhitungan nilai kekeruhan

  return kekeruhan;
}

float SensorSuhu() {
  sensors.requestTemperatures();
  float temperatureC = sensors.getTempCByIndex(0);

  return temperatureC;
}

float SensorKelembapan() {
  int nilaiDigital = analogRead(34); //membaca nilai tegangan dari sensor pada pin 34
  float kelembapanTanah = nilaiDigital / 4095.00 * 100.00; //nilai 0-100%

  return kelembapanTanah;
}

float SensPH() { //memulai fungsi untuk sensor ph
  int pengukuranPh = analogRead(sensorPinPh);  //menyimpan nilai analog sensor ph pada variabel pengukuran ph dengan nilai int
  float TeganganPh = 3.3 / 4095 * pengukuranPh; //untuk melakukan konversi nilai analog menjadi nilai tegangan
  ///Po = 7.00 + ((teganganPh7 - TeganganPh) / PhStep);
  Po = 7.00 + ((2.60 - TeganganPh) / 0.17); //untuk melakukan pengukuran nilai ph air
  return Po;
}

//void SendTelegram(String msg) {
//  if (WiFi.status() == WL_CONNECTED) {
//
//    sensorReadings = httpGETRequest(serverNameConfig);
//    JSONVar myObject = JSON.parse(sensorReadings);
//
//    if (JSON.typeof(myObject) == "undefined") {
//      Serial.println("Parsing input failed!");
//    }
//
//    const char* chatId = JSON.stringify(myObject["telegram"]["chatid"]).c_str();
//    const char* Token = JSON.stringify(myObject["telegram"]["token"]).c_str();
////    Token.remove('"');
////    chatId.remove('"');
//
//    Serial.println(String(Token));
//    Serial.println(String(chatId));
//    UniversalTelegramBot bot(String(Token), secured_client);
//    secured_client.setCACert(TELEGRAM_CERTIFICATE_ROOT);
//    bool messageSent = bot.sendSimpleMessage(String(chatId), msg, "");
//    if (messageSent) {
//      Serial.println("Message sent successfully");
//    } else {
//      Serial.println("Failed to send message");
//    }
//    Serial.println(msg);
//
//  }
//}

//String httpGETRequest(const char* serverName) {
//  WiFiClient client;
//  HTTPClient http;
//
//  // Your Domain name with URL path or IP address with path
//  http.begin(client, serverName);
//
//  // If you need Node-RED/server authentication, insert user and password below
//  //http.setAuthorization("REPLACE_WITH_SERVER_USERNAME", "REPLACE_WITH_SERVER_PASSWORD");
//
//  // Send HTTP POST request
//  int httpResponseCode = http.GET();
//
//  String payload = "{}";
//
//  if (httpResponseCode > 0) {
//    Serial.print("HTTP Response code: ");
//    Serial.println(httpResponseCode);
//    payload = http.getString();
//  }
//  else {
//    Serial.print("Error code: ");
//    Serial.println(httpResponseCode);
//  }
//  // Free resources
//  http.end();
//
//  return payload;
//}
//
//void removeDoubleQuotes(String &str) {
//  str.remove('"');
//}
