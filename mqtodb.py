import paho.mqtt.client as mqtt
from threading import Timer
import time
import json
import pymysql
import datetime

client =mqtt.Client("digibox")
#broker= "182.163.112.219"
broker="broker.hivemq.com"
port=1883

def insert(DeviceId, current_data):
    pass

def on_connect(client, userdata, flags, rc):
	print("Connected with result code "+str(rc))

def on_message(client, userdata, message):
	print("topic: "+message.topic+"	"+"payload: "+str(message.payload.decode()))
	print('\n')
	dataJson = json.loads(message.payload)
	device_id_val =dataJson["DID"]
	device_id_val1 =dataJson["TMP"]
	device_id_val2 =dataJson["HUM"]
	device_id_val3 =dataJson["CO2"]
	device_id_val4=dataJson["VOC"]
	device_id_val5=dataJson["CH4"]

	
	conn = pymysql.connect("localhost","root","","dtbox")
	cursor = conn.cursor()

	sql = "INSERT INTO dbox(DID,TMP,HUM,CO2,VOC,CH4) VALUES (%s,%s,%s,%s,%s,%s)"
	
	cursor.execute(sql, (device_id_val,device_id_val1,device_id_val2,device_id_val3,device_id_val4,device_id_val5) )
	print("Inserted to dB")


	current_time = datetime.datetime.now() 
	print(current_time)
	conn.commit()


client.on_connect = on_connect  #attach the callback function to the client object
client.on_message = on_message	#attach the callback function to the client object


client.connect(broker, port, 60)
print ("connecting to broker")

# client.loop_start() #start the loop

#client.subscribe("DSBD/iot2020/weather_station")
client.subscribe("digibox/savedhaka")

print ("subscribed")

# time.sleep(4) # wait
# client.loop_stop() #stop the loop
client.loop_forever() # to maintain continuous network traffic flow with the broker
