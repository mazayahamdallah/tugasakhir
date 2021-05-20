#import json
import MySQLdb
#import base64
import datetime
import requests
#import smtplib 
#from email.mime.multipart import MIMEMultipart
#from email.mime.text import MIMEText
import paho.mqtt.client as mqtt

# SQL DB Name
db_database = "alpr"
db_hostname = "localhost"
db_username = "root"
db_password = ""

# URL
# url = 'http://192.168.43.229/api/v1/notifikasi'
#url1= 'http://192.168.43.229/api/v1/devices/node'
#url2= 'http://192.168.43.229/api/v1/devices/node2'
#url3= 'http://192.168.43.229/api/v1/devices/node3'
#===============================================================
#===============================================================
# Functions to push Sensor Data into Database

def on_publish(client,userdata,result):             #create function for callback
    print("data published \n")
    pass
  
def sensor_Data_Handler(jsonData): 
    #Parse Data 
    Data = base64.b64decode(json.loads(jsonData.decode())['data'])
    print(Data)
    rxdata = json.loads(jsonData.decode())['rxInfo']
    rssi = rxdata[0]['rssi']
    snr = rxdata[0]['loRaSNR']
    fcnt = json.loads(jsonData.decode())['fCnt']
    devicename = json.loads(jsonData.decode())['deviceName']
    print(devicename)
    print(snr)
    print(fcnt)
    
    #jsonLoc=rxdata[0]['location']
    #dataLoc = json.loads(jsonData.decode())['jsonLoc']
    #dataLatitude = float(dataLoc['latitude'])
    #print (dataLatitude)
    jsonSensor = json.loads(base64.b64decode(json.loads(jsonData.decode())['data']))
    #print(jsonSensor['temp'])
    #dataTemp = float(jsonSensor['t'])
    
    datav1 = float(jsonSensor['v1']) #diganti dengan variabel data plat nomor
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
    pub_topic1= devicename+"/v1" #"/v1" diganti dengan nama tabel
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

    try:
        cur.execute("SELECT email FROM users")
    except (MySQLdb.Error, MySQLdb.Warning) as e:
        print(e)
        return None
    tenti=cur.fetchall()
    # print(tenti[0][0])
    email_recepients=[]
    for siapa in tenti:
        email_recepients.append(siapa[0])
        # print (siapa[0])

    print (email_recepients)

    if datav1 == 0 and dts[0] > 11:
        myobj = {'node': devicename, 'condition': 'novoltage'}
        x = requests.post(url, data = myobj)
        client.publish(pub_topic9,'1')
        dts=datav1
        print("Mengirim Notifikasi Ga Ada Voltage ")

        #Email Content

        email_subject = "Notifikasi"
        email_body = "Tidak ada Voltase terdeteksi di "+devicename
 
        #For loop, sending emails to all email recipients
        for recipient in email_recepients:
            print("Sending email to {}".format(recipient))
            message = MIMEMultipart('alternative')
            message['From'] = email_sender_account
            message['To'] = recipient
            message['Subject'] = email_subject
            message.attach(MIMEText(email_body, 'html'))
            text = message.as_string()
            server.sendmail(email_sender_account,recipient,text)

        #All emails sent, log out.

        # #For loop, sending emails to all email recipients
        # for recipient in email_receivers:
        #     print(f"Sending email to {recipient}")
        #     message = MIMEMultipart('alternative')
        #     message['From'] = email_sender_account
        #     message['To'] = recipient
        #     message['Subject'] = email_subject
        #     message.attach(MIMEText(email_body, 'html'))
        #     text = message.as_string()
        # server.sendmail(email_sender_account,recipient,text)
    
        # #All emails sent, log out.
        # server.quit()
           
    if datav1 > 11 and dts[0] == 0:
        myobj = {'node': devicename, 'condition': 'adavoltage'}
        x = requests.post(url, data = myobj)
        client.publish(pub_topic9,'1')
        print("Mengirim Notifikasi Ada Voltage") 

        #Email Content
        email_subject = "Notifikasi"
        email_body1 = "Voltase terdeteksi di "+devicename

        #For loop, sending emails to all email recipients
        for recipient in email_recepients:
            print("Sending email to {}".format(recipient))
            message = MIMEMultipart('alternative')
            message['From'] = email_sender_account
            message['To'] = recipient
            message['Subject'] = email_subject
            message.attach(MIMEText(email_body1, 'html'))
            text = message.as_string()
            server.sendmail(email_sender_account,recipient,text)

        #All emails sent, log out.

    try:
        cur.execute("insert into " + devicename + " (v1, v2, v3, c1, c2, c3) values (%s, %s, %s, %s, %s, %s)", ([datav1], [datav2], [datav3], [datac1], [datac2], [datac3]))
    except (MySQLdb.Error, MySQLdb.Warning) as e:
        print(e)
        return None
    conn.commit()
    print ("Inserted Data " + devicename + " into Database.")
    print ("")

    print("status node:"+datanode)
   
    if datanode== "on":
        myobj = {'status': 1}
        if devicename== "node1":
            x = requests.put(url1, data = myobj)
            print("Mengirim status on ke node1")
        elif devicename== "node2":
            x = requests.put(url2, data = myobj)
            print("Mengirim status on ke node2")
        elif devicename== "node3":
            x = requests.put(url3, data = myobj)
            print("Mengirim status on ke node3")