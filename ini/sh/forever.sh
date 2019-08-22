#!/bin/bash
cd /home/yimian/iot/mqtt/smartfarm/
forever start index.js
cd /home/yimian/www/smartfarm/
forever start bin/www
cd /home/ushio/www/session/
forever start bin/www
