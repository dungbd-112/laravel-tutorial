# Angular + Laravel project

## Features

- Client side with angular, Server stde with laravel
- Tailwind CSS and Ant Design for UI design

## Requirement

- Docker >= 20.10
- Docker compose plugin
- NodeJS 18

## How to use it

Run the following command in the root directory of project:

```bash
make devup
```

This will create a `.env` file in the root directory. You can configure environment variables in this file according to your needs.

Install require dependencies for both client and server:

```bash
make devinstall
```

Migrate and seed dummy data:

```bash
make devmigrate
make devfresh
```

The application will be accessible at:

- Client: [http://project.localhost:3000](http://project.localhost:3000)
- Server: [http://project.localhost:3000/api/](http://project.localhost:3000/api/)
- Phpmyadmin: [http://phpmyadmin.localhost:3000](http://phpmyadmin.localhost:3000)
- Traefik: [http://traefik.localhost:3000](http://traefik.localhost:3000)

Stop the application:

```bash
make devdown
```
