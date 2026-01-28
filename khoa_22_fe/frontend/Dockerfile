FROM node:18-alpine

WORKDIR /app

# Copy package files first for better caching
COPY package*.json ./

# Install dependencies
RUN npm ci --prefer-offline --no-audit 2>&1 || npm install --legacy-peer-deps

# Copy application code
COPY . .

# Build for production (if needed for faster dev server)
# This helps with faster startup and better performance
RUN npm run build 2>/dev/null || true

EXPOSE 5174

CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0", "--port", "5174"]
