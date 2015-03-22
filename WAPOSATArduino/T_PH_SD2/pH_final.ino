
//--------------------------------------------WAPOSAT----------------------------------------------------
#include <SPI.h>
#include <Ethernet.h>
#include <SoftwareSerial.h>         //Include the software serial library 
#include <LiquidCrystal.h>          //libreria para el LCD
#include <SD.h>                     //libreria para la tarjeta SD
#define rx 2                        //define what pin rx is going to be
#define tx 3                        //define what pin tx is going to be
#include <stdio.h>
#include <math.h>
//---------------------------tarjeta SD---------------------------------------------------------------
//Guardamos en que entrada de Arduino esta conectado el pin CS del modulo.
const int chipSelect = 4;
//---------------------------LCD----------------------------------------------------------------------
LiquidCrystal lcd(12, 11, 10, 9, 8, 7);
//---------------------------comunicacion serial con sensor-------------------------------------------
SoftwareSerial myserial(rx, tx);    //define how the soft serial port is going to work.
int Pin_x = 5;                      //Arduino pin 5 to control pin X
int Pin_y = 6;                      //Arduino pin 4 to control pin Y
//-----------------------------------datos de sensor--------------------------------------------------
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
//----------------------------shell ethernet----------------------------------------------------------
/*
byte mac[] = {  0x90, 0xA2, 0xDA, 0x0E, 0x08, 0x82 }; // MAC de la tarjeta ethernet shield
byte ip[] = { 192,168,1,250 }; // Direccion ip local
byte server[] = { 192,168,1,1}; // Direccion ip del servidor*/
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
byte ip[] = { 172, 16, 13, 177 };
byte gateway[] = { 172, 16, 13, 254 };
byte server[] = { 54, 94, 138, 151 }; // waposat

EthernetClient client;
float value;
// Definicion de variable ph
//char  Ph;
float Ph;
//----------------------------------------------------------------------------------------------------
void setup()
{
//----------------donfiguracion lcd-------------------------------------------------------------------
  lcd.begin(16, 2);
  lcd.print("WAPOSAT");
  lcd.setCursor(0, 1);
  lcd.print("Midiendo Ph Y T");
  delay(2000);
//------------------------entrada analogica y alimentacion 5v--------------------------------------------------------------
  pinMode(temp,OUTPUT); 
  pinMode(analogPin, INPUT);    // configurando al puesto A0 como entrada analogica
  //hallando los parametros de la temperatura
  beta=(log(RT2/R0))/((1/T2)-(1/T0));
  Rinf=R0*exp(-beta/T0);
//-----------------configuracion de serial sensor-----------------------------------------------------
  pinMode(Pin_x, OUTPUT);           //Set the digital pin as output.
  pinMode(Pin_y, OUTPUT);          //Set the digital pin as output.
  myserial.begin(9600);             //Set the soft serial port to 9600
//-----------------configuracion de serial pc---------------------------------------------------------
  Serial.begin(9600);  
  //Ethernet.begin(mac, ip); // inicializa ethernet shield
  Ethernet.begin(mac, ip, dns, gateway);
  delay(1000); // espera 1 segundo despues de inicializar
// Si ha habido error al leer la tarjeta informamos por el puerto serie.
  if (!SD.begin(chipSelect)){
    Serial.println("Error al leer la tarjeta.");
    return;
     }
}

void loop()
{
//-----------------------sensor de pH------------------------------------------------------------------  
      open_channel();                            //Call the function "open_channel" to open the correct data path
      myserial.print('r');                      //Send the command from the computer to the Atlas Scientific device using the softserial port                                     
      myserial.print("\r");
       
      sensor_bytes_received=myserial.readBytesUntil(13,sensordata,30); //we read the data sent from the Atlas Scientific device until we see a <CR>. We also count how many character have been received 
      sensordata[sensor_bytes_received]=0;            //we add a 0 to the spot in the array just after the last character we received. This will stop us from transmitting incorrect data that may have been left in the buffer
      Serial.println(sensordata); 
//------------------------sensor de temperatura-------------------------------------------------------
     T = read_temp();       //call the function “read_temp” and return the temperature in C°
     Serial.println(T);     //print the temperature data
     delay(1000);           //wait 1000ms before we do it again
//-----------------------Guardado de informacion en tarjeta SD--------------------------------------------
   // Abrimos el fichero donde vamos a guardar los datos 
   // (Si no existe se crea automaticamente).
   
   
  File dataFile = SD.open("WAPOSAT.txt", FILE_WRITE);
    
  // Si el fichero es correcto escribimos en el.
  if (dataFile) {
    // Escribimos en el fichero "POT: "
    dataFile.println("Ph:T");
    // A continuacion escribimos el valor de la variable pot y saltamos a la linea siguiente.
    dataFile.print(sensordata);
    dataFile.println(T);
    dataFile.println("----------");
    // Cerramos el archivo.
    dataFile.close();  
    // Avisamos de que se ha podido escribir correctamente.
    Serial.println("impresion correcta");   
    // Si no pudimos escribir en el fichero avisamos por el puerto serie.
  }else{
    Serial.println("Error al escribir en valorpot.txt");
  }    
//--------------------------LCD------------------------------------------------ 
  //Ph = 7;
  
  lcd.setCursor(0,0);
  lcd.print("Ph:");
  lcd.setCursor(0, 1);
  lcd.print(T);
  lcd.print(" Ph");
  delay(1000);
  borrar_lcd();
 
  
//------------------------Comunicacion con internet------------------------------------------------------
  
  Serial.println("Conectando..");

  if (client.connect(server,80)>0) {  // Se conecta al servidor
    client.print("GET /WAPOSAT3/Template/InsertData2.php?sensor1=1&equipo=1&sensor2=2&valor1="); // Envia los datos utilizando GET
    client.print(sensordata);
    client.print("&valor2=");
    client.print(T);
    client.println(" HTTP/1.0");
    client.println("User-Agent: Arduino 1.0");
    client.println();
    Serial.println("Conexion exitosa");
  }
  else
  {
    //Serial.println("Falla en la conexion");
  }
  if (client.connected()) {}
  else {
    //Serial.println("Desconectado");
    client.stop();
    //for(;;);
    delay(60000);
  }
  //client.stop();
  //client.flush();
  //delay(5000); // espera 5 minutos antes de volver a sensar la temperatura

 //------------------------resetea el buffer serial---------------------------------------- 
  myserial.flush();
}

//----------------funcion de coneccion al canal 1------------------------------------------------------------------
void open_channel(){                                  //This function controls what UART port is opened.                                                      //If *channel==1 then we open channel 1     
         digitalWrite(Pin_x, LOW);                   //Pin_x and pin_y control what channel opens 
         digitalWrite(Pin_y, LOW);                   //Pin_x and pin_y control what channel opens 
      }
//----------------borrar lcd---------------------------------------------------------------------------------------

void borrar_lcd()
{
  delay(2000);
  lcd.setCursor(0,0);
  lcd.print("                ");
  lcd.setCursor(0, 1);
  lcd.print("                ");
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
//---------------------------------------------------------------------------------------------------------------------
