import requests
import json


r = requests.get("http://localhost/smarttrash/relay")
data = r.json()

# print(data)
print(data[0]['lokasi']) #mengambil data dari json