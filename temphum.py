#!/usr/bin/env python

import mysql.connector
from datetime import datetime

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="C4n4r10.",
  database="dashboard"
)

mycursor = mydb.cursor()

now = datetime.now()
formatted_date = now.strftime('%Y-%m-%d %H:%M:%S')

sql = "INSERT INTO tyh (registro, temperatura, humedad) VALUES (%s, %s, %s)"
val = (formatted_date,"80","100")
mycursor.execute(sql, val)

mydb.commit()

print(mycursor.rowcount, "record inserted.")
