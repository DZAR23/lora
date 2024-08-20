FROM bitnami/laravel:11

# Actualizar los repositorios e instalar herramientas necesarias
RUN apt-get update \
    && apt-get install -y gnupg2 apt-transport-https \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update \
    && ACCEPT_EULA=Y apt-get install -y msodbcsql17 unixodbc-dev \
    && apt-get install -y php-dev php-pear build-essential \
    && pecl install sqlsrv pdo_sqlsrv \
    && echo "extension=sqlsrv.so" > /opt/bitnami/php/etc/php.ini \
    && echo "extension=pdo_sqlsrv.so" >> /opt/bitnami/php/etc/php.ini

# Copiar el código de la aplicación
COPY ./src /app
# Establecer el directorio de trabajo
WORKDIR /app
# Exponer el puerto de la aplicación
EXPOSE 8000