// www.internetdelascosas.cl
//
// Sketch mide la temperatura con un sensor LM35
// y la envia a un servidor remoto
//
// contacto@internetdelascosas.cl
//
//---------------------------------------------------------------------------------------------------
#include <SPI.h>
#include <Ethernet.h>
#include <SoftwareSerial.h>         //Include the software serial library  
#define rx 2                        //define what pin rx is going to be
#define tx 3                        //define what pin tx is going to be
//---------------------------comunicacion serial con sensor-------------------------------------------
SoftwareSerial myserial(rx, tx);    //define how the soft serial port is going to work.
int Pin_x = 5;                      //Arduino pin 5 to control pin X
int Pin_y = 4;                      //Arduino pin 4 to control pin Y
//---------------------------datos de sensor----------------------------------------------------------
char sensordata[30];  //A 30 byte character array to hold incoming data from the sensors
byte sensor_bytes_received=0;       //We need to know how many characters bytes have been received
//----------------------------shell ethernet----------------------------------------------------------
byte mac[] = {  0x90, 0xA2, 0xDA, 0x0E, 0x08, 0x82 }; // MAC de la tarjeta ethernet shield
byte ip[] = { 192,168,1,250 }; // Direccion ip local
byte server[] = { 192,168,1,1}; // Direccion ip del servidor
EthernetClient client;
float value;
// Definicion de pines
const int inPin = 0;  // sensor conectado a la entrada analoga 0
//----------------------------------------------------------------------------------------------------
void setup()
{
//-----------------configuracion de serial sensor-----------------------------------------------------
  pinMode(Pin_x, OUTPUT);           //Set the digital pin as output.
  pinMode(Pin_y, OUTPUT);          //Set the digital pin as output.
  myserial.begin(9600);             //Set the soft serial port to 9600
//-----------------configuracion de serial pc---------------------------------------------------------
  Serial.begin(9600);  
  Ethernet.begin(mac, ip); // inicializa ethernet shield
  delay(1000); // espera 1 segundo despues de inicializar
}

void loop()
{
      open_channel();                            //Call the function "open_channel" to open the correct data path
      myserial.print('r');                      //Send the command from the computer to the Atlas Scientific device using the softserial port                                     
      myserial.print("\r");
       
      sensor_bytes_received=myserial.readBytesUntil(13,sensordata,30); //we read the data sent from the Atlas Scientific device until we see a <CR>. We also count how many character have been received 
      sensordata[sensor_bytes_received]=0;            //we add a 0 to the spot in the array just after the last character we received. This will stop us from transmitting incorrect data that may have been left in the buffer
      Serial.println(sensordata); 
     // myserial.flush();
  
  /*
  int value = analogRead(inPin);
  float celsius =  (value * 500L) /1024.0;     // 10 mV por grado celsius
  Serial.print(celsius); // Escribe en el puerto serial para monitorear
  Serial.print(" grados Celsius");
*/
  Serial.println("Conectando..");

  if (client.connect(server,80)>0) {  // Se conecta al servidor
    client.print("GET /WAPOSAT3/Template/InsertData.php?sensor=1&equipo=1&valor="); // Envia los datos utilizando GET
    client.print(sensordata);
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
  delay(5000); // espera 5 minutos antes de volver a sensar la temperatura
  myserial.flush();
}

//----------------funcion de coneccion al canal 1------------------------------------------------------------------
void open_channel(){                                  //This function controls what UART port is opened.                                                      //If *channel==1 then we open channel 1     
         digitalWrite(Pin_x, LOW);                   //Pin_x and pin_y control what channel opens 
         digitalWrite(Pin_y, LOW);                   //Pin_x and pin_y control what channel opens 
      }

