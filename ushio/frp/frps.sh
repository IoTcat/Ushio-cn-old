#!/bin/bash
cd /home/ushio/frp/
nohup ./frps -c ./frps.ini > /var/log/frp/nohup.log 2>&1 &
