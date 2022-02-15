# Product Category Api

# Setup

####  1. Kindly add following entry in your `/etc/hosts` file:

```bash
127.0.0.1 products_api.localhost
```

####  2. Create docker containers:

```bash
$ docker-compose up -d
```

#### 3. Confirm three running containers for php, nginx, & mysql:

```bash
$ docker-compose ps 
```

#### 4. Install composer packages:

```bash
$ docker-compose run php composer install 
```
#### 5. Create Database schema:

```bash
$ docker-compose run php php artisan migrate 

```

#### 6. Seed data is Database:

```bash
$ docker-compose run php php artisan db:seed
```

#### 7. Possible Optimisations:
- Authentication can be added.
- Unit and integration tests can be added. 

Application logs can be found on following locations:
```bash
  logs/nginx
  application/storage/logs
```
