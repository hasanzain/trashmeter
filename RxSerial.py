#!/usr/bin/env python3
import serial
import requests

if __name__ == '__main__':
    ser = serial.Serial('/dev/ttyACM0', 9600, timeout=1)
    ser.flush()

    while True:
        if ser.in_waiting > 0:
            line = ser.readline().decode('utf-8').rstrip()
            data=line.split(",")
            if(data[0] == "TX1"):
                isine = {'nomor_tps' : 10,'lokasi' : 'Surabaya', 'status' : 'full', 'value' : data[1]}
                r = requests.post("http://192.168.2.3/smarttrash/data_tps", data = isine)
                print(r.content)
                # print (data[1])
                
            else:
                isine = {'nomor_tps' : 20,'lokasi' : 'mMlang', 'status' : 'full', 'value' : data[1]}
                r = requests.post("http://192.168.2.3/smarttrash/data_tps", data = isine)
                print(r.content)
                # print (data[1])


