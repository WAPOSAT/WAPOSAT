#include <SPI.h>
#include <Ethernet.h>

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
byte ip[] = { 172, 16, 13, 177 };
byte gateway[] = { 172, 16, 13, 254 };
byte server[] = { 54, 94, 138, 151 }; // waposat

EthernetClient client;

float value;
const int inPin = 0;

void setup()
{
  Ethernet.begin(mac, ip, dns, gateway);
  Serial.begin(9600);
  delay(1000);
}

void loop()

{
  value = analogRead(inPin);
  float celsius =  (value * 5.0) /1024.0;     // 10 mV por grado celsius
  //celsius = 7;
  //Serial.print(celsius); // Escribe en el puerto serial para monitorear
  //Serial.print(" grados Celsius");
  //Serial.println("connecting...");
  if (client.connect(server, 80)) {
    Serial.println("connected");
    client.print("GET /MAYQA/Template/InsertData.php?equipo=1&sensor=1&valor=");
    client.print(celsius);
    client.println(" HTTP/1.0");
    //client.println("User-Agent: Arduino 1.0");
    client.println();
    //Serial.println("Conexion exitosa");
    
  } else {
  //  Serial.println("connection failed");
  }
  if (client.available()) {
    char c = client.read();
  //  Serial.print(c);
  }

  if (!client.connected()) {
  //  Serial.println();
  //  Serial.println("disconnecting.");
    client.stop();
    //for(;;);
    delay(5000);
  }
  
}
