#!/bin/bash

CHALLENGES=`ls -l --time-style="long-iso" . | egrep '^d' | awk '{print $8}'`
for CHALLENGE in $CHALLENGES; do
	cd $CHALLENGE
	echo "[+] Building challenge $CHALLENGE"
	./dockerbuild.sh
	echo "[+] Done building challenge $CHALLENGE"

	echo "[+] Running challenge $CHALLENGE"
	./dockerrun.sh
	echo "[+] Done running challenge $CHALLENGE"
	cd ..
done
