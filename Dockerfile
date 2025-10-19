# Use official PHP 8.2 image with Apache
FROM php:8.2-apache

# Install system dependencies and enable mysqli + SSL
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libssl-dev \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

# Copy project files into Apache web root
COPY . /var/www/html/

# Expose port 8080 for Render
EXPOSE 8080

# Start Apache server
CMD ["apache2-foreground"]
