#!/bin/bash

docker run -d -t -p 3001:80 ctf101:${PWD##*/}
