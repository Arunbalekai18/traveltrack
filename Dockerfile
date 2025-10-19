# Use official PHP image with Apache
FROM php:8.2-apache

# Copy all files from your repo to Apache's web directory
COPY . /var/www/html/

# Expose the default Apache port
EXPOSE 8080

# Start Apache in the foreground
CMD ["apache2-foreground"]
