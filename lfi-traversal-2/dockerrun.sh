#!/bin/bash

docker run -d -t -p 3007:80 ctf101:${PWD##*/}
