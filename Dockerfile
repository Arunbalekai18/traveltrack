# Use official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies and enable mysqli + SSL
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libssl-dev \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

# Copy all files to Apache web directory
COPY . /var/www/html/

# Expose port for Render
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]
