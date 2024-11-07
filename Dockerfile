FROM php:8.2-apache

# Establecer la zona horaria
RUN echo "America/Argentina/Buenos_Aires" > /etc/timezone

# Instalar dependencias
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    zip \
    curl \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo_mysql zip gd && \
    pecl install redis && \
    docker-php-ext-enable redis && \
    rm -rf /var/lib/apt/lists/*

RUN echo "memory_limit=1024M" >> /usr/local/etc/php/conf.d/memory-limit.ini

# Habilitar mod_rewrite
RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiar el código de la aplicación
COPY . /var/www/html

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer permisos y ejecutar composer install
RUN chown -R www-data:www-data /var/www/html && \
    chmod 777 -R storage && \
    composer install
