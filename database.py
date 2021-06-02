import pymysql
import pymysql.cursors
import time
import datetime
import Main

# Connect to the database
def data(insertdata):
    print(insertdata)

    connection = pymysql.connect(host= 'kantong-parkir.cnfp38hsrtd7.us-east-1.rds.amazonaws.com',
                                 user='admin_parkir',
                                 password='sukses.2020',
                                 db='parkir',
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor,
                                 )
    # host, user, password sesuaikan dengan localhost
    print(connection)

    try:
        with connection.cursor() as cursor:
            # Create a new record
            ceksql= "SELECT COUNT(plat_no) AS cekplat FROM `track_plat` WHERE plat_no=%s AND DATE(`waktu_datang`) = DATE(CURDATE())"
            cursor.execute(ceksql, (insertdata))
            checking = cursor.fetchone()
            print(checking)
    # set berapa kali plat yang sudah terdaftar dapat masuk kedalam database
            if checking.get('cekplat') <2:
                sql = "INSERT INTO `track_plat`(`plat_no`) SELECT text_plat FROM plat_nomor WHERE plat_nomor.text_plat=%s"
                cursor.execute(sql, (insertdata))

        connection.commit()
        # return True
        print('Data sudah masuk')

    finally:
        connection.close()

# update data baru yaitu data waktu keluar, fungsi ini digunakan di main2.py
def updatetime(insertdata):
    connection = pymysql.connect(host= 'kantong-parkir.cnfp38hsrtd7.us-east-1.rds.amazonaws.com',
                                 user='admin_parkir',
                                 password='sukses.2020',
                                 db='parkir',
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor,
                                 )
    try:
        with connection.cursor() as cursor:
            ts = time.time()
            timestamp = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')
            ceksql= "UPDATE `track_plat` SET waktu_pergi=%s WHERE plat_no=%s"
            print("rararararararararararar")
            print(ceksql)
            cursor.execute(ceksql, (timestamp,insertdata))

        connection.commit()
        return True

    finally:
        connection.close()

# insert data waktu masuk
def check(insertdata):
    connection = pymysql.connect(host= 'kantong-parkir.cnfp38hsrtd7.us-east-1.rds.amazonaws.com',
                                 user='admin_parkir',
                                 password='sukses.2020',
                                 db='parkir',
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor,
                                 )
    with connection.cursor() as cursor:
        # Create a new record
        ceksql= "SELECT COUNT(plat_no) AS cekplat FROM `track_plat` WHERE plat_no=%s AND DATE(`waktu_datang`) = DATE(CURDATE())"
        cursor.execute(ceksql, (insertdata))
        checking = cursor.fetchone()
        print(checking)
        if checking.get('cekplat')==1:
            return True
