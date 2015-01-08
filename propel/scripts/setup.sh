#!/bin/bash
SQ3_DB="../resource/db.sq3"
DOPROPEL="scripts/dopropel.sh"

if [ ! -e './schema.xml' ]; then
	echo "Run this script ini while pwd is the 'propel' directory"
	echo "Current pwd:$(pwd)"
	exit -1;
fi

rm "$SQ3_DB"
$DOPROPEL
curl 'http://codeshop.ch/en/populate' -H 'Host: codeshop.ch' -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:34.0) Gecko/20100101 Firefox/34.0' -H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8' -H 'Accept-Language: en-US,en;q=0.5' -H 'Accept-Encoding: gzip, deflate' -H 'Cookie: PHPSESSID=obq7m0c54vdpt68rbjcjtovbe6; Language=en; gtoken=eyJhbGciOiJSUzI1NiIsImtpZCI6InNGS1MxQSJ9.eyJpc3MiOiJodHRwczovL2lkZW50aXR5dG9vbGtpdC5nb29nbGUuY29tLyIsImF1ZCI6IjcwOTA4ODE0MDI5Mi1ucTByN3UyMW1uZ2V2czlhZ3RnYnNycmFxM21tZW5scC5hcHBzLmdvb2dsZXVzZXJjb250ZW50LmNvbSIsImlhdCI6MTQyMDY3MTY2MCwiZXhwIjoxNDIxODgxMjYwLCJ1c2VyX2lkIjoiMDU5NDk0OTQzNzQ4NjUwNzQ4MDAiLCJlbWFpbCI6Im1pc2NoYV9sZWhtYW5uMjAwM0B5YWhvby5kZSIsInZlcmlmaWVkIjpmYWxzZX0.No5j39eFvI3PHFs6r6eniNQjnzBv1c4HAh0ub56Qb5-77GY8_P5F6e0I_ANWFVJO7YtQ0J9fBAKASaez7nC5AZ2nomoaMfVY8oxhZF5DMo_C3ga1VA4pQeh8Ru-41yb4uVUaJG06Gw06c1YRJT4P6P6SKlmDSjmiBt1ctDQV2RYYCGZ227HPQ792OdpaJZ1Fu2SKwuWK4-3cwBDE1_ZSyVXSQlt7yzqR5THcb5SNTNklKNNb4iOLuIc7pPRsEdUv0HsPIXkWMqALy7u6xUrtnt3FLrGdTFxOx-effqU1MbjWnB-qz8huDPde5sByAeen1TH-Vq-AHQD2knu14RYqxg' -H 'Connection: keep-alive'
