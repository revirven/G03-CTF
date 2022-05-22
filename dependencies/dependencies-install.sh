#!/bin/bash

sudo apt update -y

# Install MySQL Server
sudo apt install mysql-server -y

# Install PHP
sudo apt install php libapache2-mod-php -y
sudo apt install php-cli -y
sudo apt install php-cgi -y
sudo apt install php-mysql -y

# Install Composer
chmod +x composer-install.sh
./composer-install.sh
sudo mv composer.phar /usr/local/bin/composer

# Install Laravel
composer global require laravel/installer