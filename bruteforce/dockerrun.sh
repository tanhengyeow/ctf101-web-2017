#!/bin/bash

docker run -d -t -p 3002:80 ctf101:${PWD##*/}
