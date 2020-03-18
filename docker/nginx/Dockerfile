FROM nginx

COPY nginx.conf /etc/nginx/nginx.conf
COPY sites/default.conf /etc/nginx/sites-available/default.conf
COPY conf.d/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www
EXPOSE 80
