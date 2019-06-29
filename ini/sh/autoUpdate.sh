#!/bin/bash
#
# Update
sh /home/ini/sh/update/updateConf.sh
sh /home/ini/sh/update/updateCron.sh
#
# git
cd /home
git pull
git add .
git commit -m "auto update"
git push
