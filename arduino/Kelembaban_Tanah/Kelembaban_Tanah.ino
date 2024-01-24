int nilaiDigital;
float kelembapanTanah;
void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  Serial.println("ESP32 dengan sensor kelembaban tanah");

}

void loop() {
  nilaiDigital = analogRead(34); //membaca nilai tegangan dari sensor pada pin 34
  kelembapanTanah = nilaiDigital / 4095.00 * 100.00; //nilai 0-100%
  Serial.print("Nilai digital = ");
  Serial.print(nilaiDigital);
  Serial.print(", Kelembaban tanah = ");
  Serial.print(kelembapanTanah);
  Serial.println(" %");

  delay(1000);
}
