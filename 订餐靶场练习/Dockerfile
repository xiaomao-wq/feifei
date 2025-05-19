FROM harbor.gxalabs.com/php/lnmp:v3.0
WORKDIR /startlamp/
COPY *.sql /startlamp/
ADD --chown=www:www ./ /usr/share/nginx/html/
CMD /startlamp/run.sh