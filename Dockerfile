# Use the official PHP image from the Docker Hub
FROM php:8.1-cli

# Set the working directory in the container
WORKDIR /var/www

# Copy the project files into the container's working directory
COPY . /var/www

# Install any PHP extensions or dependencies if needed
RUN docker-php-ext-install pdo pdo_mysql

# Expose port 8000
EXPOSE 8000

# Start the PHP built-in server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "."]
