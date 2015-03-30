// www.internetdelascosas.cl

//

// Sketch mide la temperatura con un sensor LM35

// y la envia a un servidor remoto

//

// contacto@internetdelascosas.cl

//



#include <SPI.h>

#include <Ethernet.h>



byte mac[] = { 0x00, 0xE0, 0x7D, 0xE2, 0x77, 0xC1 };

byte ip[] = { 172, 16, 13, 69 }; // Change this parameters to reflect your network values

byte gateway[] = { 172, 16, 13, 254 };

byte server[] = { 54, 94, 151, 115 };

int PinDigital;

byte estate;



EthernetClient client;



//float value;



// Definicion de pines

const int inPin0 = 0;  // sensor conectado a la entrada analoga 0

const int inPin1 = 1;  // sensor conectado a la entrada analoga 1

const int inPin2 = 2;  // sensor conectado a la entrada analoga 2

const int inPin3 = 3;  // sensor conectado a la entrada analoga 3

const int inPin4 = 4;  // sensor conectado a la entrada analoga 4



// Tabla de Id's

//  Ideq: Id del equipo

//  Id0: Id del sensor colocado en inPin0

//  Id1: Id del sensor colocado en inPin1

//  Id2: Id del sensor colocado en inPin2

//  Id3: Id del sensor colocado en inPin3

//  Id4: Id del sensor colocado en inPin4



const short Ideq = 1;   // El "1" representa al equipo ...

const short Id0 = 1;    // El "0" representa al sensor ...

const short Id1 = 2;    // El "1" representa al sensor ...

const short Id2 = 3;    // El "2" representa al sensor ...

const short Id3 = 4;    // El "3" representa al sensor ...

const short Id4 = 5;    // El "4" representa al sensor ...



char DatoG[33]; // Variable General de sensores



void setup()

{

  Serial.begin(9600);

  Ethernet.begin(mac, ip, dns, gateway);

  for (PinDigital=2;PinDigital<7;PinDigital++)

  {

    pinMode(PinDigital,INPUT);

  }

  // Limpiamos el dato de estados

  estate = 0x00;

  // Realiza la lectura de las entradas digitales

  for (PinDigital=2;PinDigital<7;PinDigital++)

  {

    // En el caso de sensor activado

    if (digitalRead(PinDigital) == HIGH)

    {

      estate = (estate<<1) | 0x01;

      Serial.println("corre y agrega 1");

      Serial.println(estate,BIN);

      delay(50);

    }

    // En el caso de sensor desactivado

    else

    {

      estate = (estate<<1) | 0x00;

      Serial.println("corre y agrega 0");

      Serial.println(estate,BIN);

      delay(50);

    }

    delay(50);

  }

  Serial.println("corre y agrega 000 para completar el byte");

  estate = estate<<3; // Se usan 5 sensores, los {ultimos 3 bits se colocan en 0

  Serial.println(estate,BIN); // Imprime el byte de estados de los sensores conectados

  delay(1000); // espera 1 segundo despues de inicializar

}



void loop()

{

  int valueS0 = analogRead(inPin0);  // Lectura del sensor 0 (0 - 5V)

  int valueS1 = analogRead(inPin1);  // Lectura del sensor 1 (0 - 5V)

  int valueS2 = analogRead(inPin2);  // Lectura del sensor 2 (0 - 5V)

  int valueS3 = analogRead(inPin3);  // Lectura del sensor 3 (0 - 5V)

  int valueS4 = analogRead(inPin4);  // Lectura del sensor 4 (0 - 5V)

  

  // SE PROCESARÁ EN LA BASE DE DATOS!!!

//  float Sensor0 =  (valueS0 * 500L) /1024.0;     // Valor leido por el sensor 0

//  float Sensor1 =  (valueS1 * 500L) /1024.0;     // Valor leido por el sensor 1

//  float Sensor2 =  (valueS2 * 500L) /1024.0;     // Valor leido por el sensor 2

//  float Sensor3 =  (valueS3 * 500L) /1024.0;     // Valor leido por el sensor 3

//  float Sensor4 =  (valueS4 * 500L) /1024.0;     // Valor leido por el sensor 4

  

  // Imprime en el serial monitor los datos procesador

  Serial.println("Valor medido en el Pin0:");

  Serial.println(valueS0); // Escribe en el puerto serial para monitorear el valor leido por el sensor 0

  Serial.println("Valor medido en el Pin1:");

  Serial.println(valueS1); // Escribe en el puerto serial para monitorear el valor leido por el sensor 1

  Serial.println("Valor medido en el Pin2:");

  Serial.println(valueS2); // Escribe en el puerto serial para monitorear el valor leido por el sensor 2

  Serial.println("Valor medido en el Pin3:");

  Serial.println(valueS3); // Escribe en el puerto serial para monitorear el valor leido por el sensor 3

  Serial.println("Valor medido en el Pin4:");

  Serial.println(valueS4); // Escribe en el puerto serial para monitorear el valor leido por el sensor 4

  Serial.println("");



  // Juntamos los valores en una cadena

  sprintf(DatoG,"%s%s%s%s%s%s%s%s%s%s%s%s",(char*)&Ideq,estate,(char*)&Id0,(char*)&valueS0,(char*)&Id1,

  (char*)&valueS1,(char*)&Id2,(char*)&valueS2,(char*)&Id3,(char*)&valueS3,(char*)&Id4,(char*)&valueS4);

  

  // Imprimimos la cadena que se enviará en el monitor serial

  Serial.println(DatoG);

  

  // Inicia la conexión

  Serial.println("Conectando..");



  if (client.connect(server,80)) {  // Se conecta al servidor

    client.print("GET /MonitoringSystem/Templates/recibir5.php?DATO_GLOBAL="); // Envia los datos utilizando GET

    client.print(DatoG);

    /*

    client.print("&Id0=");

    client.print(Id0);

    client.print("&Sensor0=");

    client.print(Sensor0);

    client.print("&Id1=");

    client.print(Id1);

    client.print("&Sensor1=");

    client.print(Sensor1);

    client.print("&Id2=");

    client.print(Id2);

    client.print("&Sensor2=");

    client.print(Sensor2);

    client.print("&Id3=");

    client.print(Id3);

    client.print("&Sensor3=");

    client.print(Sensor3);

    client.print("&Id4=");

    client.print(Id4);

    client.print("&Sensor4=");

    client.print(Sensor4);

    */

    client.println(" HTTP/1.0");

    client.println();

    Serial.println("Conexion exitosa");

  }

  else

  {

    Serial.println("Falla en la conexion");

  }

  if (client.available()) {

char c = client.read();

Serial.print(c);

}



if (!client.connected()) {

Serial.println();

Serial.println("disconnecting.");

}



delay(120000); // espera 5 minutos antes de volver a sensar

}
