# Use the base image
FROM docker.io/bitpoke/wordpress-runtime:bedrock

# Set environment variables for WordPress
# ENV DB_HOST=mariadb:3306 \
# 	DB_USER=root \
# 	DB_PASSWORD=mariadb \
# 	DB_NAME=mariadb \
# 	MEMCACHED_HOST=memcached:11211 \
# 	WP_HOME=http://localhost:8088 \
# 	WP_SITEURL=http://localhost:8088/wp \
# 	WP_ENV=development

# Copy your local Bedrock setup into the container
COPY ./website/bedrock /app

