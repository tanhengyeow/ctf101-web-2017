#!/bin/bash

docker stop `docker ps -q | tr '\n' ' '`
./start-all-challenges.sh
