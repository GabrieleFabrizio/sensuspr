FROM php:8.3-apache

# Align www-data's uid/gid with the host user that owns the bind-mounted
# project files (docker-compose.yml mounts ".:/var/www/html"), otherwise
# Apache can read but not write/overwrite files such as img/blog uploads.
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

RUN docker-php-ext-install mysqli && \
    docker-php-ext-enable mysqli && \
    a2enmod rewrite

# Install msmtp as a sendmail drop-in for PHP mail()
RUN apt-get update && apt-get install -y --no-install-recommends msmtp ca-certificates && \
    rm -rf /var/lib/apt/lists/*

# Point PHP mail() at msmtp
RUN echo 'sendmail_path = "/usr/bin/msmtp -t --read-envelope-from"' \
    > /usr/local/etc/php/conf.d/mail.ini

COPY apache.conf /etc/apache2/sites-available/000-default.conf
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

WORKDIR /var/www/html

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["apache2-foreground"]
