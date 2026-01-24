FROM node:18-alpine

WORKDIR /app

COPY package*.json ./

RUN npm install 2>&1 || npm install --legacy-peer-deps

COPY . .

EXPOSE 5174

CMD ["npm", "run", "dev"]
