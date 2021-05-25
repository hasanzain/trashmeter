import requests


isine = {'nomor_tps' : 10,'lokasi' : 'malang', 'status' : 'full', 'value' : 45}
r = requests.post("http://192.168.2.3/smarttrash/data_tps", data = isine)


print(r)
print(r.content)

