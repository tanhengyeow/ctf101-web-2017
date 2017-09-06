#!/bin/bash

docker run -d -t -p 3005:80 ctf101:${PWD##*/}
