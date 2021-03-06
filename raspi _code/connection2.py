#exit gate
import RPi.GPIO as GPIO
import mysql.connector
import threading
import time
from mfrc522 import SimpleMFRC522
from time import sleep
from datetime import datetime

reader = SimpleMFRC522()
#ts = time.time()
tanggal = datetime.now().strftime('%Y-%m-%d %H:%M:%S')

try:
  id, text = reader.read()

finally:
	GPIO.cleanup()

mydb = mysql.connector.connect(
  host="kantong-parkir.cnfp38hsrtd7.us-east-1.rds.amazonaws.com",
  user="admin_parkir",
  password="sukses.2020",
  database="parkir"
)

mycursor=mydb.cursor()

updatesql = "UPDATE card SET waktu_out=%s WHERE uid=%s"
updateval = (tanggal, id)
try:
    mycursor.execute(updatesql, updateval)
    mydb.commit()
    print ("Data Updated")

except:
  print ("Data not Updated")


GPIO.setmode(GPIO.BCM)
GPIO.setup(12,GPIO.IN)
servoPIN = 17
GPIO.setup(servoPIN, GPIO.OUT)
p = GPIO.PWM(servoPIN, 50) # GPIO 17 for PWM with 50Hz
p.start(2.5) # Initialization

#try:
while True:
    sensor=GPIO.input(12)

    if mydb.commit():
        p.ChangeDutyCycle(10)
        mydb.close()
    elif sensor==0:
        p.ChangeDutyCycle(5)
        time.sleep(2)
        break

print("Operation Finished")

GPIO.cleanup()