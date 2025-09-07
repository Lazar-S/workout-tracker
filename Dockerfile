FROM phpmyadmin:latest
RUN docker-php-ext-install pdo pdo_mysql
RUN pecl install xdebug-3.4.3 && docker-php-ext-enable xdebug
RUN cd /var/www/html && mkdir phpmyadmin && mv * .* phpmyadmin/ 2> /dev/null || true
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
