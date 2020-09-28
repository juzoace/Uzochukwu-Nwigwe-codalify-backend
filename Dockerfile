FROM joselfonsecadt/nginx-php7.4:latest

MAINTAINER Jose Fonseca <jose@ditecnologia.com>

WORKDIR /var/www/html/

COPY . /var/www/html/

EXPOSE 80

CMD ["/usr/bin/supervisord"]