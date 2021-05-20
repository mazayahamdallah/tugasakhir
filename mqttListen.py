import MySQLdb
import datetime
import requests
import paho.mqtt.client as mqtt
from store_Sensor_Data_to_DB import sensor_Data_Handler #ini harus diganti sesuai dengan kebutuhan
#from store_Sensor_Data_to_DB import on_publish
# MQTT Settings 
MQTT_Broker = "localhost" #localhost
MQTT_Port = 1883
Keep_Alive_Interval = 10
MQTT_Topic = "application/+/device/+/rx" #sesuaikan

#Subscribe to all Sensors at Base Topic
def on_connect(self,mosq, obj, rc):
    self.subscribe(MQTT_Topic, 0)
mqtt.on_connect=on_connect

#Save Data into DB Table
def on_message(mosq, obj, msg): #menerima message dari broker
    # This is the Master Call for saving MQTT Data into DB
    # For details of "sensor_Data_Handler" function please refer "sensor_data_to_db.py"
    print "MQTT Data Received..."
    print "MQTT Topic: " + msg.topic  
    print "Data: " + msg.payload #valuenya dari si message 
    sensor_Data_Handler(msg.payload)
#    on_publish("testing",dataTemp)

def on_subscribe(mosq, obj, mid, granted_qos):
    pass

mqttc = mqtt.Client()

# Assign event callbacks
mqttc.on_message = on_message
mqttc.on_connect = on_connect
mqttc.on_subscribe = on_subscribe

# Connect
mqttc.connect(MQTT_Broker, int(MQTT_Port), int(Keep_Alive_Interval))

# SQL DB Name
db_database = "alpr"
db_hostname = "localhost"
db_username = "root"
db_password = "12345678"

def sensor_Data_Handler(jsonData):
     
    datav1 = float(jsonSensor['v1'])
    datav2 = float(jsonSensor['v2'])
    datav3 = float(jsonSensor['v3'])
    datac1 = float(jsonSensor['c1'])
    datac2 = float(jsonSensor['c2'])
    datac3 = float(jsonSensor['c3'])
  
    datalight = jsonSensor['r2']	 
    datanode = jsonSensor['r1']
    
 
    if datav1 == 0:
        datac1=0.0

    broker="localhost"
    port=9001
    pub_topic1= devicename+"/v1"
    pub_topic2= devicename+"/v2"
    pub_topic3= devicename+"/v3"
    pub_topic4= devicename+"/c1"
    pub_topic5= devicename+"/c2"
    pub_topic6= devicename+"/c3"
    pub_topic7= devicename+"/light"
    pub_topic8= devicename+"/off"
    pub_topic9= devicename+"/notif"
    
    client=mqtt.Client("client1",transport='websockets')
    #client=mqtt.Client("client1")
    client.on_publish = on_publish
    client.connect(broker,int(port))
    client.publish(pub_topic1,datav1)
    client.publish(pub_topic2,datav2)
    client.publish(pub_topic3,datav3)
    client.publish(pub_topic4,datac1)
    client.publish(pub_topic5,datac2)
    client.publish(pub_topic6,datac3)
    client.publish(pub_topic7,datalight)
    client.publish(pub_topic8,datanode)

    conn = MySQLdb.connect(db_hostname, db_username, db_password, db_database)
    cur = conn.cursor()
    #print ("terserah")
    try:
        cur.execute("SELECT v1 FROM " + devicename + " ORDER BY id DESC LIMIT 1")
    except (MySQLdb.Error, MySQLdb.Warning) as e:
        print(e)
        return None
    dts=cur.fetchone()
    print(dts[0])

# Continue the network loop
mqttc.loop_forever()