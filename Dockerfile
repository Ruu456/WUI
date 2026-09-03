# Simple Dockerfile to run the PHP built-in server for the site
FROM php:8.1-cli
WORKDIR /app
COPY . /app
EXPOSE 8080
# Serve the provided document root. Update the path if your index.php location changes.
CMD ["/bin/sh", "-c", "php -S 0.0.0.0:$PORT -t web/www/upm_informatika"]
