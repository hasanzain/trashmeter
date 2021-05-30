import requests
import json


# r = requests.get("http://localhost/smarttrash/relay")
r = requests.get("http://localhost/webbali/data_sensor?limit=1&order=desc")
data = r.json()

# print(data)
print(data[0]['lokasi']) #mengambil data dari json
print(data) #mengambil data dari json