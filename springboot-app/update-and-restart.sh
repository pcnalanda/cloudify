#!/bin/bash

# Define paths and container name
DOCKER_COMPOSE_PATH="/home/prafull/docker"
SPRINGBOOT_SERVICE_NAME="springboot"

# Navigate to the Docker Compose directory
cd $DOCKER_COMPOSE_PATH || { echo "Docker Compose directory not found"; exit 1; }

# Stop the specific Spring Boot container if it exists
echo "Stopping the Spring Boot container..."
docker compose stop $SPRINGBOOT_SERVICE_NAME

# Navigate to the Spring Boot application directory
cd $DOCKER_COMPOSE_PATH/springboot-app || { echo "Spring Boot application directory not found"; exit 1; }

# Compile the application using Maven
echo "Compiling the application..."
./mvnw clean compile

# Navigate back to the Docker Compose directory
cd $DOCKER_COMPOSE_PATH || { echo "Docker Compose directory not found"; exit 1; }

# Build the Docker image for the Spring Boot service
echo "Building the Docker image for the Spring Boot service..."
docker compose build $SPRINGBOOT_SERVICE_NAME

# Start the Spring Boot container with the updated image
echo "Starting the Spring Boot container..."
docker compose up -d $SPRINGBOOT_SERVICE_NAME

echo "Done. Your Spring Boot application has been updated and the container has been restarted."
