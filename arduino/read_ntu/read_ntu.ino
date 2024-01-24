const int sensorPinNTU  = 35;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  pinMode (sensorPinNTU, INPUT);
  Serial.println("Test Turbidity sensor by Duy Huynh");  
}

void loop() { 
  // put your main code here, to run repeatedly:
  int sensorValue = analogRead(sensorPinNTU); // read the input on analog pin A0:
  float voltage = sensorValue * (3.3 / 4095.0);// Convert the analog reading (which goes from 0 - 4095.0) to a voltage (0 - 5V):
  float kekeruhan = map(voltage, 0.0, 3.3, 100, 0.0); //memulai perhitungan nilai kekeruhan
  Serial.println("===========================================");
  Serial.print("ADC :");
  Serial.print(sensorValue);
  Serial.print(" ");
  Serial.print("Volt :");
  Serial.print(voltage); // print out the value you read:
  Serial.print("    ");
  Serial.print("Nilai Kekeruhan = ");
  Serial.print(kekeruhan);
  Serial.println(" NTU");
  Serial.println("===========================================");
  Serial.println("");
  delay(1000);
}
