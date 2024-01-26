FROM nginx:1.25

# Copy Nginx conf
COPY server/nginx/nginx-conf /etc/nginx