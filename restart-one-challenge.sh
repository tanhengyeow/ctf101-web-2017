#!/bin/bash

ID=`docker ps | grep $1 | awk '{print $1}'`
docker stop $ID
cd $1
./dockerbuild.sh
./dockerrun.sh
