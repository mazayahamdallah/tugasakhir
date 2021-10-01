#mqtt

import paho.mqtt.client as mqtt
import RPi.GPIO as GPIO

GPIO.setmode(GPIO.BCM)
GPIO.setup(12,GPIO.IN)
servoPIN = 17
GPIO.setup(servoPIN, GPIO.OUT)
p = GPIO.PWM(servoPIN, 50)
p.start(0)

#The callback for when the client receives a CONNACK response from server.
def on_connect(client, userdata, flags, rc):
		print("Connected with result code "+str(rc))
		
		#subscribing in on_connect() = if we lose connection and
		#reconnect then subscriptions will be removed
		client.subscribe("gerbang/masuk")

#the callback for when PUBLISH message is received from the server
def on_message(client, userdata, msg):
		print(msg.topic+" "+str(msg.payload.decode('utf-8)))
		
		if msg.payload.decode('utf-8') == "1":
		p.ChangeDutyCycle(10)
		
		if msg.payload.decode('utf-8') == "0":
		p.ChangeDutyCycle(0)
		
#create an MQTT client and attach out routines to it
client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message

client.connect("broker.hivemq.com", 1883, 60)

client.loop_forever()
GPIO.cleanup()