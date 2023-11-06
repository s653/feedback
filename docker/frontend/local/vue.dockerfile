FROM node:16-alpine as base

RUN mkdir -p /var/www/html/feedback/frontend

# Create app directory
WORKDIR /var/www/html/feedback/frontend

CMD ["sh", "-c", "npm install && npm run dev"]
