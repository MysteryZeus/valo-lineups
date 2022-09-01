start /B httpd -f "%cd%/app/conf/httpd.conf"
start /B mysqld --defaults-file=C:\xampp\mysql\bin\my.ini --standalone