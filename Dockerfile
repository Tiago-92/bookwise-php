# Use a imagem base do PHP
FROM php:8.2-fpm

# Instale dependências do Symfony e do PHP necessárias (como extensões do PHP, etc.)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    && docker-php-ext-install pdo_mysql intl

# Defina o diretório de trabalho
WORKDIR /app

# Copie os arquivos do seu aplicativo para o contêiner
COPY . .

# Instale o Composer e verifique se foi instalado corretamente
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Instale as dependências do Symfony com o Composer
RUN composer install

ENV COMPOSER_ALLOW_SUPERUSER 1
# Instale a CLI do Symfony globalmente usando o Composer
RUN composer global require symfony/console

# Exponha a porta usada pelo Symfony
EXPOSE 8000

# Comando para iniciar o servidor Symfony
CMD ["symfony", "serve", "--no-tls", "--allow-http", "0.0.0.0:8000"]

