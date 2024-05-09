FROM php:8.0-fpm
# Arguments defined in docker-compose.yml
RUN chmod 1777 /tmp
# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    unzip \
    mysql-common \
    default-mysql-client \
    cron \
    nano \
    libpq-dev
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_pgsql
RUN docker-php-ext-install sockets
# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
# Install PHP extensions
RUN docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath gd
# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# Set working directory
WORKDIR /var/www/bitcoin-exchange-app

RUN echo "* 1 * * *       root    /usr/local/bin/php /var/www/bitcoin-exchange-app/bin/console import:bitcoin-exchange-rate USD EUR GBP 2>&1" >> /etc/crontab
RUN touch /var/log/cron.log

CMD bash -c "cron && php-fpm"