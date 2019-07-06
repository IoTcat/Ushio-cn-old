#!/bin/bash
forever start /home/yimian/iot/mqtt/smartfarm/index.js
forever start /home/yimian/www/smartfarm/bin/www
forever start /home/ushio/www/session/bin/www
