import MySQLdb
import datetime
import requests
import Main
import paho.mqtt.client as mqtt

broker_address="54.234.148.72" #alamat ip broker
pub_topic1="plat_no"

print("creating new instance")
client = mqtt.Client("pi_connection") #create new instance

print("connecting to broker")
client.connect(broker_address) #connect to broker

print("Subscribing to topic", pub_topic1)
client.subscribe(pub_topic1)

print("Publishing message to topic ", pub_topic1)
client.publish(pub_topic1, insertdata) #topic yang dipublish pub_topic1 ngambil variabel insertdata dari program Main