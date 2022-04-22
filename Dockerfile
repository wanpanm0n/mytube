FROM php:apache
#RUN apt-get update && apt-get install -y vi
COPY . /var/www/html/mytube/
#WORKDIR /usr/src/myapp
#CMD ["php","/usr/src/myapp/index.php"]
