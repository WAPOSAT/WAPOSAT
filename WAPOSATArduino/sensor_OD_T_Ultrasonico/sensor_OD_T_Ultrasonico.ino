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
int temp=40;             //entrada anlogica
int analogPin=A8;

//----------------------------comunicacion variables para sensor ultrasonico-----------------------------------
int rled = 7; // Pin PWN 11 para led rojo
int gled = 6; // Pin PWM 10 para led azul
int bled = 5;  // Pin PWM 9  para led verde
 
long distancia;
long d;
long tiempo;

int trig=3;
int echo=4;


//---------------------------datos de sensor----------------------------------------------------------
char sensordata[30];  //A 30 byte character array to hold incoming data from the sensors
byte sensor_bytes_received=0;       //We need to know how many characters bytes have been received


//----------------------------configuracion shell ethernet----------------------------------------------------------
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
byte ip[] = { 172, 16, 13, 177 };
byte gateway[] = { 172, 16, 13, 254 };
//byte server[] = { 45, 55, 150, 245 }; // IP Publico del servidor WAPOSAT
byte server[] = { 172, 16, 13, 1 }; // IP Servidor LAN

//unsigned long lastConnectionTime = 0;          // last time you connected to the server, in milliseconds
boolean lastConnected = false;                 // state of the connection last time through the main loop
//const unsigned long postingInterval = 60*1000;  // delay between updates, in milliseconds

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

//------------------------declaracion de pines entrada salida del sesnor ultrasonico------------------
  pinMode(trig, OUTPUT); /*activación del pin 9 como salida: para el pulso ultrasónico*/
  pinMode(echo, INPUT); /*activación del pin 8 como entrada: tiempo del rebote del ultrasonido*/

/*----- Se inicializan pines PWM como salida*/  
  pinMode(rled, OUTPUT);
  pinMode(bled, OUTPUT);
  pinMode(gled, OUTPUT);
  

//-----------------configuracion de serial pc---------------------------------------------------------  
  Ethernet.begin(mac, ip, dns, gateway); // inicializa ethernet shield
  //Ethernet.begin(mac); // inicializa ethernet shield
  Serial.begin(9600);
  Serial3.begin(9600);
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
    //Serial.print(c);
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
   //if (distancia < 50 ){ 
    httpRequest();
   //}
   /*
   else {
    // if you couldn't make a connection:
    Serial.println("connection failed");
    Serial.println("disconnecting.");
    client.stop();
  }*/
  }
  // store the state of the connection for next time through
  // the loop:
  lastConnected = client.connected();

}

//---------------funcion de sensor de temperatura-------------------------------------------------------------------
float read_temp(void){

float v_out;             //voltage output from temp sensor 
float tempC;              //the final temperature is stored here
digitalWrite(analogPin, LOW);   //set pull-up on analog pin
digitalWrite(temp, HIGH);   //set pin 2 high, this will turn on temp sensor
delay(2);                //wait 2 ms for temp to stabilize
v_out = analogRead(analogPin);   //read the input pin
digitalWrite(temp, LOW);    //set pin 2 low, this will turn off temp sensor
v_out*=.0048;            //convert ADC points to volts (we are using .0048 because this device is running at 5 volts)
v_out*=1000;             //convert volts to millivolts
tempC= 0.0512 * v_out -20.5128; //the equation from millivolts to temperature
tempC-=4.8;
return tempC;             //send back the temp

}

// this method makes a HTTP connection to the server:
void httpRequest() {
  // if there's a successful connection:
  if (client.connect(server, 80)) {
    //Serial.println("connecting...");
    LecturaSensores();
    // send the HTTP PUT request:
    client.print("GET /WAPOSAT3/Template/InsertData.php?equipo=3&sensor1=3&valor1=");
    //client.print("GET /WAPOSAT3/Template/InsertData3.php?equipo=3&sensor1=3&sensor2=2&sensor3=4&valor1="); // Envia los datos utilizando GET
    client.print(sensordata);
    //client.print("&valor2=");
    //client.print(T);
    //client.print("&valor3=");
    //client.print(d);
    client.println(" HTTP/1.0");
    client.println();

    // note the time that the connection was made:
    //lastConnectionTime = millis();
    delay(200);
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
        sensor_bytes_received=Serial3.readBytesUntil(13,sensordata,20); //we read the data sent from the Atlas Scientific device until we see a <CR>. We also count how many character have been received 
        sensordata[sensor_bytes_received]=0;            //we add a 0 to the spot in the array just after the last character we received. This will stop us from transmitting incorrect data that may have been left in the buffer
        Serial.println("finalizado lectura DO");
        Serial.println(sensordata);
      //}
/*
//------------------------sensor de temperatura-------------------------------------------------------
     Serial.println("iniciando lectura Temperatura");
     T = read_temp();       //call the function “read_temp” and return the temperature in C°
     Serial.println("finalizado lectura Temperatura");
     Serial.println(T);     //print the temperature data
     delay(1000);           //wait 1000ms before we do it again
//----------------------sesnor ultrasonico----------------------------------------------------------
*/
//      digitalWrite(trig,LOW); /* Por cuestión de estabilización del sensor*/
//        delayMicroseconds(5);
//        digitalWrite(trig, HIGH); /* envío del pulso ultrasónico*/
//        delayMicroseconds(10);
//        tiempo=pulseIn(echo, HIGH);
//        distancia= int(0.017*tiempo);
//        if(distancia<60)
//         {d=distancia;
//         }
//        else{
//          d=60;} 
//        digitalWrite(rled, LOW);
//        digitalWrite(gled, LOW); 
//        digitalWrite(bled, LOW);
//        
//      if(d>0 && d<20){
//       digitalWrite(rled, HIGH);
//       //delay(50);
//       //digitalWrite(rled, LOW);
//       }
//       else if(d>20 && d<40)
//      {
//       digitalWrite(gled, HIGH);
//       //delay(50);
//       //digitalWrite(gled, LOW); 
//      }
//      else if(d>40 && d<60)
//      {
//       digitalWrite(bled, HIGH);
//       //delay(50);
//       //digitalWrite(bled, LOW); 
//      
//      } 
//        Serial.println("Distancia ");
//        Serial.println(distancia);
//        Serial.println(" cm");
//        delay(1);
}
