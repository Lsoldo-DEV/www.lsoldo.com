symfony console doctrine:migrations:migrate

docker-compose up --d
php/bin server:start

# Getting Started with the Symfony Project

This guide will walk you through setting up and running the Symfony project on your local environment. Follow the steps below to get the project up and running.

## Prerequisites

Ensure that you have the following installed on your machine:

1. **Docker** - Used to containerize the environment.
2. **Docker Compose** - To orchestrate multi-container Docker applications.
3. **PHP** - Required for running Symfony.
4. **Composer** - PHP dependency manager.
5. **Symfony CLI** (optional but recommended) - For easier management of your Symfony projects.

## Project Setup

### 1. Clone the Repository

If you haven't cloned the project repository yet, do so by running the following command in your terminal:

```bash
git clone <repository-url>
cd <project-directory>
composer install
cp .env.example .env
docker-compose up -d
```
6. Start the Symfony Server
To start the Symfony server locally, use the Symfony CLI or PHP's built-in server:

Using Symfony CLI (if installed):