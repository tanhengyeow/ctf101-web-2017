#!/bin/bash

docker run -d -t -p 3004:80 ctf101:${PWD##*/}