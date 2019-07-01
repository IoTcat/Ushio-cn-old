#!/bin/bash
yum update -y
yum install -y wget

# git
git config --global user.name iotcat
git config --global user.email i@iotcat.me

# nginx
yum install -y nginx
systemctl enable nginx
systemctl start nginx

# gcc
yum install -y gcc
yum install -y gcc-c++
yum install -y gdb
yum install -y openssl

# php
rpm -ivh http://dl.fedoraproject.org/pub/epel/7/x86_64/Packages/e/epel-release-7-11.noarch.rpm
rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
yum -y install php72w php72w-cli php72w-common php72w-devel php72w-embedded php72w-fpm php72w-gd php72w-mbstring php72w-mysqlnd php72w-opcache php72w-pdo php72w-xml
systemctl start php-fpm
systemctl enable php-fpm

# go
yum install -y golang

# nodejs
yum install -y nodejs
npm install -g n
npm install -g npm
npm install express-generator -g
npm i forever -g

# python
yum install epel-release -y
yum install https://centos7.iuscommunity.org/ius-release.rpm -y
yum install python36u -y
yum install python36u-devel -y
ln -s /bin/python3.6 /bin/python3
yum install python36u-pip -y
ln -s /bin/pip3.6 /bin/pip3
yum install -y python-pip
pip install --upgrade pip
pip3 install --upgrade pip

# docker
yum -y install docker
systemctl enable docker
systemctl start docker
pip install --upgrade backports.ssl_match_hostname
pip install docker-compose

# redis
yum -y install redis
systemctl enable redis
systemctl start redis

# bbr
wget -N --no-check-certificate https://github.com/teddysun/across/raw/master/bbr.sh
chmod +x bbr.sh
bash bbr.sh
rm -rf bbr.sh

# ss
wget --no-check-certificate -O shadowsocks-all.sh https://raw.githubusercontent.com/teddysun/shadowsocks_install/master/shadowsocks-all.sh
chmod +x shadowsocks-all.sh
./shadowsocks-all.sh 2>&1 | tee shadowsocks-all.log
ln -s /etc/init.d/shadowsocks-python /bin/shadowsocks
