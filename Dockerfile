# Use uma imagem PHP com suporte ao Laravel
FROM php:8.1-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www

# Copiar o projeto Laravel
COPY . .

# Instalar dependências do Laravel
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Configurar permissões adequadas
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Copiar configuração do Nginx
COPY ./nginx.conf /etc/nginx/conf.d/default.conf

# Expor a porta do Nginx
EXPOSE 80

# Iniciar Nginx e PHP-FPM
CMD ["sh", "-c", "service nginx start && php-fpm"]
