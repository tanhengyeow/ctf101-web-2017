#!/bin/bash

docker run -d -t -p 3000:80 ctf101:${PWD##*/}
