import requests


isine = {'id' : 1, 'relay_1' : 1}
r = requests.put("http://localhost/smarttrash/relay", data = isine)


print(r)
print(r.content)

