// www.internetdelascosas.cl
//
// Sketch mide la temperatura con un sensor LM35
// y la envia a un servidor remoto
//
// contacto@internetdelascosas.cl
//

#include <SPI.h>
#include <Ethernet.h>

byte mac[] = {  0x90, 0xA2, 0xDA, 0x0E, 0x08, 0x82 }; // MAC de la tarjeta ethernet shield
byte ip[] = { 192,168,1,250 }; // Direccion ip local
byte server[] = { 192,168,1,1}; // Direccion ip del servidor

EthernetClient client;

float value;

// Definicion de pines

const int inPin = 0;  // sensor conectado a la entrada analoga 0

void setup()
{
  Serial.begin(9600);
  Ethernet.begin(mac, ip); // inicializa ethernet shield
  delay(1000); // espera 1 segundo despues de inicializar
}

void loop()
{
  int value = analogRead(inPin);
  float celsius =  (value * 500L) /1024.0;     // 10 mV por grado celsius
  Serial.print(celsius); // Escribe en el puerto serial para monitorear
  Serial.print(" grados Celsius");

  Serial.println("Conectando..");

  if (client.connect(server,80)>0) {  // Se conecta al servidor
    client.print("GET /MonitoringSystem/Templates/arduino.php?sensor=1&equipo=1&valor="); // Envia los datos utilizando GET
    client.print(celsius);
    client.println(" HTTP/1.0");
    client.println("User-Agent: Arduino 1.0");
    client.println();
    Serial.println("Conexion exitosa");
  }
  else
  {
    Serial.println("Falla en la conexion");
  }
  if (client.connected()) {}
  else {
    Serial.println("Desconectado");
  }
  client.stop();
  client.flush();
  delay(60000); // espera 5 minutos antes de volver a sensar la temperatura
}
