//-----------------------Callback function-------------------------------------//

void callback(char* topic, byte* payload, unsigned int length) {
 
  Serial.print("Message arrived in topic: ");
  Serial.println(topic);
  
//-------------------------------------Getting config data---------------------//

if(strcmp(topic, "dbox/reset") == 0){
  
  StaticJsonDocument<256> doc;
  deserializeJson(doc, payload, length);

  String devId = doc["did"];
  int cmd = doc["cmd"];
  Serial.println(devId);
  Serial.println(cmd);

  if( devId == did){
      if(cmd == 1){
        Serial.println("RESET");

        char buffer[256];
        doc["status"] = "success";
        size_t n = serializeJson(doc, buffer);
        client.publish("dbox/response",buffer, n);
        delay(2000);
        ESP.reset();
      }
      else{
        Serial.println("INVALID RESET COMMAND");

        char buffer[256];
        doc["status"] = "failed";
        size_t n = serializeJson(doc, buffer);
        client.publish("dbox/response",buffer, n);
        delay(2000);
      }
  }else if( did == "DB000" ){ //MAGIC CODE
      if(cmd == 1){
        Serial.println("RESET");

        char buffer[256];
        doc["status"] = "success";
        size_t n = serializeJson(doc, buffer);
        client.publish("dbox/response",buffer, n);
        delay(2000);
        ESP.reset();
      }
      else{
        Serial.println("INVALID RESET COMMAND");

        char buffer[256];
        doc["status"] = "failed";
        size_t n = serializeJson(doc, buffer);
        client.publish("dbox/response",buffer, n);
        delay(2000);
      }
  }else{
      //do nothing
  }
  
}//strcomp ends

  

  if(strcmp(topic, "dbox/sleep_time") == 0){
    
    StaticJsonDocument<256> doc;
    deserializeJson(doc, payload, length);
  
    String devId = doc["did"];
    int stime = doc["stime"];
    Serial.println(devId);
    Serial.println(stime);
   
      
    if( devId == did){
        if( stime >=5 && stime <= 7200){ //sleep time within 2 hours
          Serial.println("SLEEP TIME UPDATED");
          sleep_time = stime;
          delay(2000);
          char buffer[256];
          doc["status"] = "success";
          size_t n = serializeJson(doc, buffer);
          client.publish("dbox/response",buffer, n);
        }
        else{
          Serial.println("INVALID SLEEP TIME");
          char buffer[256];
          doc["status"] = "failed";
          size_t n = serializeJson(doc, buffer);
          client.publish("dbox/response",buffer, n);
          delay(1000);
        }
    }else if( did == "DB000" ){
        if(0 < stime < 7200){ //sleep time within 2 hours
          Serial.println("SLEEP TIME UPDATED");
          sleep_time = stime;
          delay(2000);
          char buffer[256];
          doc["status"] = "success";
          size_t n = serializeJson(doc, buffer);
          client.publish("dbox/response",buffer, n);
        }
        else{
          Serial.println("INVALID SLEEP TIME");
          char buffer[256];
          doc["status"] = "failed";
          size_t n = serializeJson(doc, buffer);
          client.publish("dbox/response",buffer, n);
          delay(1000);
        }
    }else{
         //do nothing
    }
 }//strcomp ends
     
}//Callback ends
