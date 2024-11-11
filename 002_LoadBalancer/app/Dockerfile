# Use Node.js base image
FROM node:14

# Set working directory
WORKDIR /app

# Copy application code
COPY . .

# Install dependencies
RUN npm install

# Start the app
CMD ["node", "server.js"]
