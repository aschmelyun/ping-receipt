#!/bin/bash

docker run -d \
    -v $(pwd)/database/database.sqlite:/srv/database/database.sqlite \
    -v /dev/usb/lp0:/dev/usb/lp0 \
    -p 8000:8000 \
    ping-app:latest