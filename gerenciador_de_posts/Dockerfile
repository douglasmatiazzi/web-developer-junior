# Usa a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instala extensões e dependências necessárias
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    zip \
    libicu-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl

# Instala o Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copia os arquivos da aplicação
COPY . /var/www/html

# Define o diretório de trabalho
WORKDIR /var/www/html

# Instala as dependências do projeto, ignorando a dependência da extensão intl
RUN composer install --ignore-platform-req=ext-intl

# Ativa o módulo de rewrite do Apache
RUN a2enmod rewrite

# Define o diretório público como raiz do Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf

# Corrige permissões da pasta writable para evitar erro de cache do CodeIgniter
RUN chown -R www-data:www-data writable \
    && chmod -R 775 writable

# Expõe a porta padrão do Apache
EXPOSE 80
