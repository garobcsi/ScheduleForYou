<h1 align="center">
Budapesti Műszaki Szakképzési Centrum <br>
Neumann János Informatikai Technikum <br>
Szakképesítés neve: Szoftverfejlesztő és -tesztelő <br>
Száma: 5-0613-12-03
</h1>
<h1 align="center">
  VIZSGAREMEK <br><br>
  Schedule For You

</h1>
<p align="center">
  <a href="https://github.com/garobcsi/ScheduleForYou/actions/workflows/laravel.yml">
    <img alt="Click to see the source" src="https://github.com/garobcsi/ScheduleForYou/actions/workflows/laravel.yml/badge.svg" />
  </a>
</p>

> **Warning** <br>
> This Project is intended to run on linux. [See Why](#warning-running-the-application-on-windows)

## Quick Navigation

* **[:black_nib: About The Project](#black_nib-about-the-project)**
* **[:toolbox: Technologies that we used](#toolbox-technologies-that-we-used)**
* **[:building_construction: Building the application](#building_construction-building-the-application)**
  * [Prerequisites](#prerequisites)
  * [Building For Development](#building-for-development)
  * [Building Manually For Development](#building-manually-for-development)
  * [Building For Production](#building-for-production)
  * [Building Manually For Production](#building-manually-for-production)
  * [Having troubles?](#having-troubles)
    * [Are you trying to run it on an ARM CPU?](#are-you-trying-to-run-it-on-an-arm-cpu)
    * [Having permission problems?](#having-permission-problems)
    * [Did you rename app container?](#did-you-rename-app-container)
    * [Did you rename db (database) container?](#did-you-rename-db-database-container)
    * [Do you want frontend to load assets from a different URL?](#do-you-want-frontend-to-load-assets-from-a-different-url)
    * [Did you get the error `Permission denied`?](#did-you-get-the-error-permission-denied)
* **[:keyboard: Useful Commands](#keyboard-useful-commands)**
  * [Log Into Fish Shell](#log-into-fish-shell)
  * [Save Database tables to the seeder](#save-database-tables-to-the-seeder)
  * [Export a Postman collection](#export-a-postman-collection)
  * [Register an Account on the terminal](#register-an-account-on-the-terminal)
    * [Create Admin account](#create-admin-account)
    * [Create User account](#create-user-account)
* **[:open_file_folder: Application ports](#open_file_folder-application-ports)**
* **[:bust_in_silhouette: PhpMyAdmin Users](#bust_in_silhouette-phpmyadmin-users)**
  * [Root user](#root-user)
  * [Simple user](#simple-user)
  * [Change user/password](#change-userpassword)
* **[:warning: Running the Application On Windows](#warning-running-the-application-on-windows)**
* **[:test_tube: Run Unit Tests](#test_tube-run-unit-tests)**
  * [PHPUnit (Laravel tests)](#phpunit-laravel-tests)
    * [Unit test](#unit-test)
  * [Vitest (Vue tests)(WIP)](#vitest-vue-testswip)
    * [Unit test](#unit-test-1)
    * [Coverage test](#coverage-test)
* **[:open_book: Documentation](#open_book-documentation)**
  * [Functional specification (WIP)](#functional-specification-wip)
  * [Swagger (API Docs)(WIP)](#swagger-api-docswip)
* **[:hammer_and_wrench: Development Tools Used](#hammer_and_wrench-development-tools-used)**
  * [Idea's](#ideas)
  * [Programs](#programs)
  * [Os](#os)
* **[:speaking_head: Collaboration tools](#speaking_head-collaboration-tools)**
* **[:busts_in_silhouette: Made By](#busts_in_silhouette-made-by)**

## :black_nib: About The Project

Schedule For You is a versatile and user-friendly application designed to simplify your daily scheduling needs. The application is built to provide users with an easy-to-use platform to manage their schedules effectively. With Schedule For You, you can easily organize your personal and professional appointments in one convenient location.

## :toolbox: Technologies that we used

- [Vue 3.2](https://vuejs.org/)
- [Laravel 9.36.2](https://laravel.com/)
- [Mysql 8.0.30](https://www.mysql.com/)
- [Phpmyadmin 5.1-apache](https://www.phpmyadmin.net/)
- [Nginx 1.23-alpine](https://www.nginx.com/)

## :building_construction: Building the application

### Prerequisites

* [Docker](https://www.docker.com/) & [Docker-Compose](https://docs.docker.com/compose/)

### Building For Development

1. Make sure the project is not running in the `docker`
2. Navigate to `src/laravel-vue`
3. Run `./start-dev.sh`

### Building Manually For Development

1. Make sure the project is not running in the `docker`
2. Navigate to `src/laravel-vue`
3. Copy `.env.example` to `.env`
4. Start the application `docker-compose -f docker-compose.yml -f docker-compose.dev.yml up -d --build`
5. Log into fish shell `docker-compose exec app fish`
6. Install `composer install`
7. Generate key `php artisan key:generate`
8. Migrate the database `php artisan migrate:fresh --seed`
9. Install node packages `npm i`
10. Start Vite dev mode `npm run dev`

### Building For Production

1. Make sure the project is not running in the `docker`
2. Navigate to `src/laravel-vue`
3. Run `./start-prod.sh`

### Building Manually For Production

1. Make sure the project is not running in the `docker`
2. Navigate to `src/laravel-vue`
3. Copy `.env.example` to `.env`
4. Start the application `docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d --build`
5. Log into fish shell `docker-compose exec app fish`
6. Install `composer install`
7. Generate key `php artisan key:generate`
8. Migrate the database `php artisan migrate:fresh --seed`
9. Install node packages `npm i`
10. Build the application `npm run build`

### Having troubles?

#### Are you trying to run it on an ARM CPU?

1. Remove Project Containers from docker `docker-compose down`
2. Go to `src/laravel-vue/docker-compose.yml` file
3. Uncomment [this](https://github.com/garobcsi/ScheduleForYou/blob/main/src/laravel-vue/docker-compose.yml#L26.L28) part of the code
4. Try again

#### Having permission problems?

1. Remove Project Containers from docker `docker-compose down`
2. Remove Mysql Folder `src/laravel-vue/docker/mysql`
3. Change the user ownership for the whole project `chown -R 1000:1000 <project name>` <br> Example `chown -R 1000:1000 ScheduleForYou/`
4. Try Again

#### Did you rename app container?

1. Remove Project Containers from docker `docker-compose down`
2. Go to `src/laravel-vue/docker/nginx/conf.d/default.conf` file
3. Go to [this](https://github.com/garobcsi/ScheduleForYou/blob/main/src/laravel-vue/docker/nginx/conf.d/default.conf#L50) line and rename app container name to your container name. <br> Example From `fastcgi_pass  app:9000` To `fastcgi_pass  my_app_name:9000`
4. Try again

#### Did you rename db (database) container?

1. Remove Project Containers from docker `docker-compose down`
2. Go to `src/laravel-vue/.env` file
3. Go to [this](https://github.com/garobcsi/ScheduleForYou/blob/main/src/laravel-vue/.env.example#L28) line and rename db container name to your container name. <br> Example From `DB_HOST=db` To `DB_HOST=my_db_name`
4. Try again

#### Do you want frontend to load assets from a different URL?

1. Remove Project Containers from docker `docker-compose down`
2. Go to `src/laravel-vue/.env` file
3. Add a new line `ASSET_URL=<your URL>` <br> Example `ASSET_URL=https://example.com`
4. Try again

#### Did you get the error `Permission denied`?

1. Login to Fish as root `docker-compose exec -u root app fish`
2. Try again

## :keyboard: Useful Commands

### Log Into Fish Shell

1. Initialize the project
2. Run `docker-compose exec app fish`

### Save Database tables to the seeder

1. Initialize the project
2. Log Into Fish shell `docker-compose exec app fish`
3. Run `php artisan iseed <table name 1>,<table name 2>,<table name 3>` <br> Example `php artisan iseed users,personal_access_tokens`

### Export a Postman collection

1. Initialize the project
2. Log Into Fish shell `docker-compose exec app fish`
3. Export `php artisan export:postman`
4. Import collection into Postman

### Register an Account on the terminal

#### Create Admin account

1. Initialize the project
2. Log Into Fish shell `docker-compose exec app fish`
3. Run `php artisan register:admin`
```
Usage:
  register:admin [options]

Options:
  -u, --username[=USERNAME]  
  -e, --email[=EMAIL]        
  -p, --password[=PASSWORD]  
```

#### Create User account

1. Initialize the project
2. Log Into Fish shell `docker-compose exec app fish`
3. Run `php artisan register:user`
```
Usage:
  register:user [options]

Options:
  -u, --username[=USERNAME]  
  -e, --email[=EMAIL]        
  -p, --password[=PASSWORD]  
```

## :open_file_folder: Application ports

- Website: `80`
- Vite: `5000` (development only, In production doesn't work/used)
- PhpMyAdmin: `5001`
- DB (MySql): `33061`

> **Warning** <br>
> If these ports already in use on your machine then change them in [.env](https://github.com/garobcsi/ScheduleForYou/blob/main/src/laravel-vue/.env.example#L2..L5) file

## :bust_in_silhouette: PhpMyAdmin Users

### Root user
- Username: `root`
- Password: `root_password`

### Simple user
- Username: `laravel`
- Password: `laravel`

### Change user/password

1. Initialize the project
2. Open `.env` file 
3. Change `DB_USERNAME=<simple username>`
4. Change `DB_PASSWORD=<simple user password>`
5. Change `MYSQL_ROOT_PASSWORD=<root passowrd>`

## :warning: Running the Application On Windows

Because the application uses many small files the coping between the Windows filesystem (NTFS) and Docker container filesystem (ext4) makes it run slower. By making the Os filesystem and the Docker containers filesystem the same the application will run much quicker.

For example, when we used [wsl](https://learn.microsoft.com/en-us/windows/wsl/install) on Windows. We saw a speedup difference. Because wsl uses ext4 filesystem.

## :test_tube: Run Unit Tests

### PHPUnit (Laravel tests)

#### Unit test

1. Initialize the project
2. Login To Fish shell `docker-compose exec app fish`
3. Run `php artisan test`

##### Did the test fail?

1. In Fish shell run `npm run dev` (Keep it running)
2. Try again

### Vitest (Vue tests)(WIP)

#### Unit test

1. Initialize the project
2. Login To Fish shell as root `docker-compose exec -u root app fish`
3. Run `npm run test`

#### Coverage test

1. Initialize the project
2. Login To Fish shell as root `docker-compose exec -u root app fish`
3. Run `npm run test:coverage`

## :open_book: Documentation

### Functional specification (WIP)

[Open Docs](./documentation/Functional%20specification.docx)
> Download and view file.

### Swagger (API Docs)(WIP)

1. Initialize the project
2. Build swagger docs `docker-compose exec -u root app php artisan l5-swagger:generate`
3. Navigate to site `<your ip>:<WEB_PORT>/api/docs` <br> Example `localhost:80/api/docs`

## :hammer_and_wrench: Development Tools Used

### Idea's

- [PhpStorm](https://www.jetbrains.com/phpstorm/)
- [VsCode](https://code.visualstudio.com/)
 
### Programs

- [DataGrip](https://www.jetbrains.com/datagrip/)
- [Postman](https://www.postman.com/)
- [Virtualbox](https://www.virtualbox.org/)
- [Docker Desktop](https://www.docker.com/products/docker-desktop/)

### Os

- [Wsl Ubuntu](https://learn.microsoft.com/en-us/windows/wsl/install)
- [Windows 11](https://www.microsoft.com/hu-hu/software-download/windows11)
- [Windows 10](https://www.microsoft.com/hu-hu/software-download/windows10)
- [Debian](https://www.debian.org/)
- [Linux mint](https://linuxmint.com/)
- [Ubuntu](https://ubuntu.com/)

## :speaking_head: Collaboration tools

- [Trello](https://trello.com/b/k4g2bpTB/vizsgaremek-naptár)
- [Figma](https://www.figma.com/file/qlWjgsmqi6hjBC6cHR09qB/Vizsgaremek?node-id=0%3A1&t=ZHQlMKRc6BF3in2D-1)
- [GitHub](https://github.com/)
- [Git](https://git-scm.com/)

## :busts_in_silhouette: Made By

- Gáspár Róbert
- Palánki Szűcs Donát
- Balázs Bence