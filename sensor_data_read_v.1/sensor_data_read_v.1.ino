#include <ESP8266WiFi.h>
//#include <ESP8266WebServer.h>
#include <WiFiManager.h>  
#include <DNSServer.h>
#include <PubSubClient.h>
#include <SparkFunCCS811.h>
#include <ArduinoJson.h>

#include <ClosedCube_HDC1080.h>
#define CCS811_ADDR 0x5A    //Alternate I2C Address

// Ticker for watchdog

#include <Ticker.h>
Ticker secondTick;

CCS811 myCCS811(CCS811_ADDR);
ClosedCube_HDC1080 myHDC1080;


//MQTT  credentials
const char *mqtt_server = "broker.hivemq.com";
//const char *mqtt_server = "182.163.112.219";
const int mqttPort = 1883;
int mqttTryCounter=0;

WiFiClient espClient;
PubSubClient client(espClient);

unsigned long previousMillis = 0;
long publish_interval = 50000;

unsigned long previousMillis2 = 0;
long deep_sleep_interval = 65000;

unsigned long previousMillis3 = 0;
long wifi_check_interval = 5000;

//char sleep_time[] = "20";
int sleep_time = 20; //in seconds



//---------------Difining Sensor Pin----------------------------------------------//
int analogPin = A0;
int sensorValue;
int Temperature = 0;
int Humidity = 0;
int carbon_dioxide = 0;
int total_voc = 0;
int methane = 0;
//int D4 = 2;

//-------------------------Variable to store sensor data----------------------------//
int data1 = 0;
int data2 = 0;
int data3 = 0;
int data4 = 0;
int data5 = 0;
String did = "1001";

String data = "";
//char topic[50] = "DSBD/iot2020/weather_station";

//int D8=0;
//int D7=0;
volatile int watchdogCount = 0;
char sensorData[68];


extern "C" {
#include "user_interface.h"
}



//--------------------Watchdog----------------------//

void ISRwatchdog() {
  watchdogCount++;
  if (watchdogCount == 180) {
    Serial.println("Watchdog bites!!");
    ESP.reset();
  }
}




//--------------------------------Main Setup----------------------------------------------------//

void setup() {

  pinMode(D4, OUTPUT);
  secondTick.attach(1, ISRwatchdog);// Attaching ISRwatchdog function
  Serial.begin(115200);
  myHDC1080.begin(0x40);
  delay(10);

  //It is recommended to check return status on .begin(), but it is not required.
  CCS811Core::status returnCode = myCCS811.begin();
  delay(10);
  if (returnCode != CCS811Core::SENSOR_SUCCESS)
  {
    Serial.println(".begin() returned with an error.");
    while (1);      //No reason to go further
  }
  pinMode(analogPin, INPUT);
 
  
  client.setServer(mqtt_server,mqttPort);//Connecting to broker
 
  client.setCallback(callback); // Attaching callback for subscribe mode
}//setup ends




//------------------------------------Main Loop--------------------------------------------------//
void loop(){

    watchdogCount = 0;
    
    if (myCCS811.dataAvailable()) {
      myCCS811.readAlgorithmResults();
    }
    
  unsigned long currentMillis = millis();
//  wifi_manager();
  if(currentMillis - previousMillis3 > wifi_check_interval) {
    previousMillis3 = currentMillis;
    
    Serial.println(previousMillis3); 
    
    if (WiFi.status() != WL_CONNECTED){ 
      //  set_wifi();
        wifi_manager();
    }
    else {
      Serial.println(" Wifi already connected");
    }
}

  if (!client.connected() && (WiFi.status() == WL_CONNECTED)){

    reconnect();
  }

   client.loop();

    //need to work here  
    data = sensor_data();
    
    
    data.toCharArray(sensorData,68);
    Serial.println("Sendor data: " + data);
//    client.publish("DSBD/iot2020/weather_station",sensorData); 
    
    
//    Serial.println("Current Millis");
//    Serial.println(currentMillis);
    
    if(currentMillis - previousMillis > publish_interval) {
    
        previousMillis = currentMillis;
        Serial.println("Ticking every 50 seconds"); 
//        Serial.println(previousMillis);
        Serial.println("Inside sensor data publish");
        
        if (!client.connected()){ reconnect();}
        
        int result = client.publish("digibox/savedhaka",sensorData); 
//        Serial.println(result);
        if (result ==1){
          Serial.println("Pulished successfully");
        }else{
            Serial.println("Unable to publish");
        }
    }// Timer ends


  if(currentMillis - previousMillis2 > deep_sleep_interval) {
    previousMillis2 = currentMillis;
    
//    Serial.println(previousMillis2);
    //Serial.println("Inside deep_sleep");
    //deep_sleep_new(sleep_time); 
  }
  
}//LOOP ENDS



//---------------------------------------Read Sensor Data---------------------------------------//
String sensor_data()
{ 
  Serial.println("Inside Sensor data read");
  data1 = temp(); 
  data2 = hum(); 
  data3 = co2();
  data4 = tvoc();
  data5 = tgsVal();


  

  String msg2 = "";
  msg2 = msg2 + "{\"DID\":" + did + "," + "\"TMP\":" + data1 + "," + "\"HUM\":" + data2 + "," + "\"CO2\":" + data3 + "," + "\"VOC\":" + data4 + "," + "\"CH4\":" + data5 + "}";

  
  delay(200);       //........ 0.2 sec delay...........//
  return msg2;

}



//void deep_sleep(){
//Serial.println("Device is going into DEEEEEEEP_Sleep");
//  Serial.print("Sleep Time:");
//  Serial.println(atoi(sleep_time));
//  ESP.deepSleep(atoi(sleep_time) * 1000000); //sleep for 10 seconds
//  delay (500);
//}


void deep_sleep_new(int stime){
Serial.println("Device is going into DEEEEEEEP_Sleep");
  Serial.print("Sleep Time(second):");
  Serial.println(stime);
//  ESP.deepSleep(stime * 1000000); //sleep for 10 seconds
  delay (500);
}

void set_wifi() {
  delay(250);
  int tryCount = 0;
  Serial.println("");
  Serial.println("Connecting to WiFi");
  WiFi.begin("DataSoft_WiFi", "support123");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(1000);        //........ 1 sec delay
    Serial.print(".");
    tryCount++;
    if (tryCount == 10) return loop(); //exiting loop after trying 10 times
  }
  Serial.println("");
  Serial.println("Connected");
  Serial.println(WiFi.localIP());
  delay(250);
  }
