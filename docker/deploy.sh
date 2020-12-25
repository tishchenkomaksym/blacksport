
cd /var/www/

# Correct server configuration

echo $"ServerName $1" > /etc/apache2/domain.conf

a2enmod rewrite
service apache2 restart

# Install PHP extensions, incl. xdebug

{
  apt-get update
  apt-get install -y git
  apt-get install -y zip
} >> ./docker/logs/apt.log

#apt-get update && apt-get install -y \
#        libfreetype6-dev \
#        libjpeg62-turbo-dev \
#        libpng-dev \
#    && docker-php-ext-configure gd --with-freetype --with-jpeg \
#    && docker-php-ext-install -j$(nproc) gd
#docker-php-ext-install exif

printf "Installing extensions. This may take some time...\n"
#{
  docker-php-ext-install mysqli pdo_mysql bcmath gd xml openssl zip
  pecl install xdebug
  docker-php-ext-enable xdebug
#}  >> ./docker/logs/apt.log

service apache2 restart


# Install dependencies

printf "Installing composer dependencies!\n"

#bash -c "curl -sS https://getcomposer.org/installer | php"

./composer.phar config -g github-oauth.github.com "$2"

chmod -R 777 .
chmod -R 755 ./docker

#./composer.phar install --no-interaction


# Configure SSH for xdebug

apt-get install -y openssh-server >> ./docker/logs/apt.log

echo "root:T653@2eyY@7er6@upX4" | chpasswd
echo "StrictHostKeyChecking=no" >> /etc/ssh/ssh_config
echo "PermitRootLogin yes" >> /etc/ssh/sshd_config
service ssh start

echo "Success"


## Install PDO sqlsrv
#
#apt-get install -y unixodbc-dev
#pecl install sqlsrv
#pecl install pdo_sqlsrv
#
#cd /usr/local/etc/php
#echo "extension=sqlsrv.so" >> php.ini
#echo "extension=pdo_sqlsrv.so" >> php.ini
#service apache2 restart
#
#apt install -y gnupg
#curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
#curl https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list
#apt-get update
#ACCEPT_EULA=Y apt-get install -y msodbcsql17 mssql-tools
#echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bash_profile
#echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc
#source ~/.bashrc
#apt-get install -y unixodbc-dev
#
#apt-get install -y --no-install-recommends openssl
#sed -i 's,^\(MinProtocol[ ]*=\).*,\1'TLSv1.0',g' /etc/ssl/openssl.cnf
#sed -i 's,^\(CipherString[ ]*=\).*,\1'DEFAULT@SECLEVEL=1',g' /etc/ssl/openssl.cnf
#rm -rf /var/lib/apt/lists/*
