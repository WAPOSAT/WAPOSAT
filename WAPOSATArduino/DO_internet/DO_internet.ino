//--------------------------------------------WAPOSAT----------------------------------------------------
#include <SPI.h>
#include <Ethernet.h>
#include <SoftwareSerial.h>         //Include the software serial library 
#define rx 2                        //define what pin rx is going to be
#define tx 3                        //define what pin tx is going to be
#include <stdio.h>
#include <math.h>

//---------------------------comunicacion serial con sensor-------------------------------------------
SoftwareSerial myserial(rx, tx);    //define how the soft serial port is going to work.

//-----------------------------------datos de sensor de temperatura--------------------------------------------------
float T;                //where the final temperature data is stored
int temp=6;             //entrada anlogica

int analogPin=0;   // entrada del voltaje de sensor
float Vin=5.0;     // [V]      
float R1=10000;    // [ohm]      resistencia fija en el circuito
float R0=10000;    // [ohm]      valor de resistencia del NCT a 25°C
float T0=298.15;   // [K]        (25ºC) la temperatura en Kelvin

float Vout=0.0;    // [V]        valor del voltaje en el sensor
float Rout=0.0;    // [ohm]      valor de la resistensia del sensor

float T2=372.15;   // [K]        medida sel sensor a 100°C
float RT2=690;     // [ohms]     valor de la resistencia a  373.15K (100ºC)

float beta=0.0;    // [K]        Beta 
float Rinf=0.0;    // [ohm]      Rinf 
float TempK=0.0;   // [K]        temperatura de salida en Kelvin
float TempC=0.0;   // [ºC]       temperatura de salida en Celsius

//---------------------------datos de sensor----------------------------------------------------------
char sensordata[30];  //A 30 byte character array to hold incoming data from the sensors
byte sensor_bytes_received=0;       //We need to know how many characters bytes have been received


//----------------------------configuracion shell ethernet----------------------------------------------------------
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
//byte ip[] = { 172, 16, 13, 177 };
//byte gateway[] = { 172, 16, 13, 254 };
byte server[] = { 45, 55, 150, 245 }; // IP Publico del servidor WAPOSAT
//byte server[] = { 172, 16, 13, 1 }; // IPServidor LAN

//unsigned long lastConnectionTime = 0;          // last time you connected to the server, in milliseconds
boolean lastConnected = false;                 // state of the connection last time through the main loop
//const unsigned long postingInterval = 30;  // delay between updates, in milliseconds

EthernetClient client;
//----------------------------------------------------------------------------------------------------

float value;
// Definicion de variable ph
//char  Ph;
//float Ph;

//----------------------------------------------------------------------------------------------------
void setup()
{

//------------------------entrada analogica y alimentacion 5v--------------------------------------------------------------
  pinMode(temp,OUTPUT); 
  pinMode(analogPin, INPUT);    // configurando al puesto A0 como entrada analogica
  //hallando los parametros de la temperatura
  beta=(log(RT2/R0))/((1/T2)-(1/T0));
  Rinf=R0*exp(-beta/T0);
//-----------------configuracion de serial pc---------------------------------------------------------  
  //Ethernet.begin(mac, ip, dns, gateway); // inicializa ethernet shield
  Ethernet.begin(mac); // inicializa ethernet shield
  Serial.begin(9600);
  delay(1000); // espera 1 segundo despues de inicializar
//-----------------configuracion de serial sensor-----------------------------------------------------
  //pinMode(Pin_x, OUTPUT);           //Set the digital pin as output.
  //pinMode(Pin_y, OUTPUT);          //Set the digital pin as output.
  myserial.begin(9600);             //Set the soft serial port to 9600
}

void loop()
{
      
//-----------------------conectando al servidor--------------------------------------------------------  
  //Serial.println("Conectando...");
  // if there's incoming data from the net connection.
  // send it out the serial port.  This is for debugging
  // purposes only:
  if (client.available()) {
    char c = client.read();
    Serial.print(c);
  }
  // if there's no net connection, but there was one last time
  // through the loop, then stop the client:
  if (!client.connected() && lastConnected) {
    Serial.println();
    Serial.println("disconnecting.");
    client.stop();
  }
  // if you're not connected, and ten seconds have passed since
  // your last connection, then connect again and send data:
  //if(!client.connected() && (millis() - lastConnectionTime > postingInterval)) {
  if(!client.connected()) {
    httpRequest();
  }
  // store the state of the connection for next time through
  // the loop:
  lastConnected = client.connected();

}

//---------------funcion de sensor de temperatura-------------------------------------------------------------------
float read_temp(void){

float vout;
float v_out;             //voltage output from temp sensor 
digitalWrite(A0, LOW);   //set pull-up on analog pin
digitalWrite(temp, HIGH);   //set pin 6 high, this will turn on temp sensor
delay(2);                //wait 2 ms for temp to stabilize
v_out = analogRead(0);   //read the input pin
digitalWrite(temp, LOW);    //set pin 6 low, this will turn off temp sensor
Vout=Vin*((float)(v_out)/1024.0);
Rout=(R1*Vout/(Vin-Vout));  // valor de la resistencia del sensor de temperatura

//calculando la temperatura
TempK=(beta/log(Rout/Rinf));
TempC=TempK-273.15;
return TempC;             //send back the temp
}

// this method makes a HTTP connection to the server:
void httpRequest() {
  // if there's a successful connection:
  if (client.connect(server, 80)) {
    Serial.println("connecting...");
    LecturaSensores();
    // send the HTTP PUT request:
    client.print("GET /WAPOSAT3/Template/InsertData2.php?equipo=1&sensor1=1&sensor2=2&valor1="); // Envia los datos utilizando GET
    client.print(sensordata);
    client.print("&valor2=");
    client.print(T);
    client.println(" HTTP/1.0");
    client.println();

    // note the time that the connection was made:
    //lastConnectionTime = millis()/1000;
    delay(60000);
  } 
  else {
    // if you couldn't make a connection:
    Serial.println("connection failed");
    Serial.println("disconnecting.");
    client.stop();
  }
}

void LecturaSensores() {
  //-----------------------sensor de pH------------------------------------------------------------------  
      //if(myserial.available() > 0){
        Serial.println("iniciando lectura DO");
        sensor_bytes_received=myserial.readBytesUntil(13,sensordata,20); //we read the data sent from the Atlas Scientific device until we see a <CR>. We also count how many character have been received 
        sensordata[sensor_bytes_received]=0;            //we add a 0 to the spot in the array just after the last character we received. This will stop us from transmitting incorrect data that may have been left in the buffer
        Serial.println("finalizado lectura DO");
        Serial.println(sensordata);
      //}
//------------------------sensor de temperatura-------------------------------------------------------
     Serial.println("iniciando lectura Temperatura");
     T = read_temp();       //call the function “read_temp” and return the temperature in C°
     Serial.println("finalizado lectura Temperatura");
     Serial.println(T);     //print the temperature data
     delay(1000);           //wait 1000ms before we do it again
}
