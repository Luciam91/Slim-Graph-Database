# Slim Framework 3 Skeleton with Docker-Compose

This is a simple skeleton application for the Slim3 Framework with support for Doctrine, Redis and environment aware config from the get-go.

## Getting Started

To get started create a new project using Composer

`composer create-project luciam91/slim3-skeleton PROJECT -s dev`

Your project will now be set up in the PROJECT directory specified in the above command.

## Docker

For your convenience I have provided a sample docker-compose file for development, ensure you have Docker installed and run the following commands to get a development environment running on your localhost

```shell
docker-compose up -d database; sleep 30
docker-compose up
```

This will create and provision the database container first and then create an application container.