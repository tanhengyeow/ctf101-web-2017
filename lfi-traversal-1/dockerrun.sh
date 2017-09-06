#!/bin/bash

docker run -d -t -p 3006:80 ctf101:${PWD##*/}
