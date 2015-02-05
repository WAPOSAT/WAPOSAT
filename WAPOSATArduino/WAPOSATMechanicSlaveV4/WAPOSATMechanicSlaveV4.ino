//**************************************
// PROGRAMA DEL ARDUINO ESCLAVO V4.0
//**************************************

// Motores
const int Pin_MV1 = 7;  // Pin del Motor Vertical
const int Pin_MV2 = 6;  // Pin del Motor Vertical
const int Pin_MH1 = 5;  // Pin del Motor Horizontal
const int Pin_MH2 = 4;  // Pin del Motor Horizontal
const int Pin_M3 = 12;  // Motor para lavado de sensores


// Topes
const int Pin_T1 = 8;   // Pin del Switch del Tope 1
int Estate_T1;          // Estado del Tope 1
const int Pin_T2 = 9;   // Pin del Switch del Tope 2
int Estate_T2;          // Estado del Tope 2
const int Pin_T3 = 10;  // Pin del Switch del Tope 3
int Estate_T3;          // Estado del Tope 3

// Tiempos
const int Tl = 5000;      // Tiempo de lavado de sensores
const int Ts = 1200000;      // Tiempo sumergido de los sensores en .....
const int T = 5000;  // Tiempo de estabilizacion de los sensores

// Otros
const int valvula = 11;
const int bomba = 13;

//Comunicacion Master Slave
const int PinM2S = 2;
const int PinS2M = 3;
int Estate_M2S;

void setup()
{
  // Configuracion de los motores
  pinMode(Pin_MV1, OUTPUT);
  pinMode(Pin_MV2, OUTPUT);
  pinMode(Pin_MH1, OUTPUT);
  pinMode(Pin_MH2, OUTPUT);
  pinMode(Pin_M3,OUTPUT);
  
  // Configuracion de los Topes
  pinMode(Pin_T3, INPUT);
  pinMode(Pin_T1, INPUT);
  pinMode(Pin_T2, INPUT);
  
  // Otros
  pinMode(valvula,OUTPUT);
  pinMode(bomba,OUTPUT);
  
  // Comunicacion
  pinMode(PinM2S, INPUT);
  pinMode(PinS2M, OUTPUT);
  digitalWrite(PinS2M,LOW);
  
  Serial.begin(9600);
}

// ***********************************
// PROGRAMA
// ***********************************

void loop()
{
  // Secuencia para identificar la posicion del sistema
  Leer_Topes();
  Parar_Motor_Hor();
  Parar_Motor_Ver();
  
  Serial.println(Estate_T3);
  Bajar_Base();
  delay(500);
  Subir_Base();
  // Mueve a la Izquierda hasta chocar con T2
  Mover_Mecanismo_Izq();
  delay(500);
  Bajar_Base();
  Lavar_Sensores();
  Subir_Base();

  // Mueve el mecanismo a la Derecha hasta chocar con T1
  Mover_Mecanismo_Der();
  delay(500);
  
  // Comienzo del ciclo normal desde la posicin inicial
  while (true)
  {
    Leer_Topes();
  
    if (Estate_T1 == HIGH && Estate_T2 == LOW)  // Si esta pegado a la derecha (posicion inicial)
    {
      Bajar_Base();
      EnviarMaster_SensorGuardado();  // Indica al Arduino Maestro que el sensor esta en posicion inicial
      EsperarMaster_ColocarSensor();  // Esperando a que el Arduino Maestro pida la lectura
      //delay(Ts);  // Sensores sumergidos un tiempo Ts
      Subir_Base();
    }
    // Mueve a la izquierda hasta cambiar de estado en T1 y T2
    Mover_Mecanismo_Izq();
    delay(500);
  
    // Si esta pegado a la izquierda
    if (Estate_T1 == LOW && Estate_T2 == HIGH)  
    {
      if (Estate_T3 == LOW)  
      {
        Bajar_Base();
        //
        prender_bomba();
        delay(40000);      // Lavado de las tuberias
        prender_valvula();
        delay(24000);      // Llenado del tanque
        apagar_valvula();
        delay(T);         // Estabilizar los sensores
        EnviarMaster_SensorListo(); // Avisar al Arduino Maestro que debe tomar el valor de los sensores
        EsperarMaster_GuardarSensor();  // Espera a que el Arduino Maestro pida el guardado de sensores
        apagar_bomba();
        prender_valvula();
        delay(40000);     // Vaceado del tanque
        apagar_valvula();
        delay(5000);
        //
      }
      Lavar_Sensores();  // Lavar sensores luego de tomar los datos
      Subir_Base();
      // Mueve a la derecha hasta chocar en T1 (Vuelve a la posicion inicial)
      Mover_Mecanismo_Der();
      delay(1000);
      }
  }
}

// ************************************************
// FUNCIONES
// ************************************************

void Print_Estados()
{
  Serial.println("ESTADO T1: ");
  Serial.print(Estate_T1);
  Serial.println("ESTADO T2: ");
  Serial.print(Estate_T2);
  Serial.println("ESTADO T3: ");
  Serial.print(Estate_T3);
}

void Leer_Topes()
{
  Serial.println("LEYENDO LOS ESTADOS");
  Estate_T1 = digitalRead(Pin_T1);  // Lectura del T1
  Estate_T2 = digitalRead(Pin_T2);  // Lectura del T2
  Estate_T3 = digitalRead(Pin_T3);  // Lectura del T3
  Print_Estados();
}

void Subir_Base()
{
  digitalWrite(Pin_MV1, LOW);
  digitalWrite(Pin_MV2, HIGH);
  Serial.println("SUBE LA BASE");
  delay(45000); // Espera a subir 45 seg
  Parar_Motor_Ver();
  Serial.println("LA BASE SE ENCUENTRA ARRIBA");
  delay(1000);
}

void Bajar_Base()
{
  Serial.println("BAJA LA BASE");
  while (Estate_T3 == LOW)  // Baja la base para lavar los sensores
  {
    digitalWrite(Pin_MV1, HIGH);
    digitalWrite(Pin_MV2, LOW);
    Leer_Topes();
  }
  Leer_Topes();
  Parar_Motor_Ver();
  Serial.println("LA BASE SE ENCUENTRA ABAJO");
}

void Mover_Mecanismo_Izq()
{
  Serial.println("MUEVE EL MECANISMO A LA IZQUIERDA");
  while (Estate_T2 == LOW)
  {
    digitalWrite(Pin_MH1, HIGH);
    digitalWrite(Pin_MH2, LOW);
    Leer_Topes();
  }
  Leer_Topes();
  if (Estate_T1 == LOW && Estate_T2 == HIGH)
  {
    Parar_Motor_Hor();  // El mecanismo se encuentra en su posicion inicial
  }
  Serial.println("EL MECANISMO SE ENCUENTRA A LA IZQUIERDA");
}

void Mover_Mecanismo_Der()
{
  Serial.println("MUEVE EL MECANISMO A LA DERECHA");
  while(Estate_T1 == LOW)
  {  
    digitalWrite(Pin_MH1, LOW);
    digitalWrite(Pin_MH2, HIGH);
    Leer_Topes();
  }
  Leer_Topes();
  if (Estate_T1 == HIGH && Estate_T2 == LOW)
  {
    Parar_Motor_Hor();  // El mecanismo se encuentra en su posicion inicial
  }
  Serial.println("EL MECANISMO SE ENCUENTRA A LA DERECHA");
}

void Parar_Motor_Hor()
{
  digitalWrite(Pin_MH1, LOW);
  digitalWrite(Pin_MH2, LOW);
  Serial.println("MOTOR HORIZONTAL DETENIDO");
}

void Parar_Motor_Ver()
{
  digitalWrite(Pin_MV1, LOW);
  digitalWrite(Pin_MV2, LOW);
  Serial.println("MOTOR VERTICAL DETENIDO");
}

void Lavar_Sensores()
{
  digitalWrite(Pin_M3, HIGH);
  Serial.println("LAVANDO SENSORES");
  delay(Tl);
  digitalWrite(Pin_M3, LOW);
  Serial.println("TERMINO DE LAVAR SENSORES");
}

void prender_bomba()
{
  digitalWrite(bomba,HIGH);
  Serial.println("PRENDE LA BOMBA");
}

void apagar_bomba()
{
  digitalWrite(bomba,LOW);
  Serial.println("APAGA LA BOMBA");
}

void prender_valvula()
{
  digitalWrite(valvula,HIGH);
  Serial.println("PRENDE LA VALVULA");
}

void apagar_valvula()
{
  digitalWrite(valvula,LOW);
  Serial.println("APAGA LA VALVULA");
}

void EsperarMaster_ColocarSensor()
{
  Estate_M2S = digitalRead(PinM2S);  // Lectura Esperando permiso del Master
  while(Estate_M2S == LOW)
  {
    delay(30000);
    Estate_M2S = digitalRead(PinM2S);  // Lectura Esperando permiso del Master    
  }
}

void EsperarMaster_GuardarSensor()
{
  Estate_M2S = digitalRead(PinM2S);  // Lectura Esperando permiso del Master
  while(Estate_M2S == HIGH)
  {
    delay(1000);
    Estate_M2S = digitalRead(PinM2S);  // Lectura Esperando permiso del Master    
  }
}

void EnviarMaster_SensorListo()
{
  digitalWrite(PinS2M,HIGH);
}

void EnviarMaster_SensorGuardado()
{
  digitalWrite(PinS2M,LOW);
}
