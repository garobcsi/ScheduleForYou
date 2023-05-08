<h1 align="center">Schedule For You</h1>
<p align="center">
  <a href="https://github.com/garobcsi/ScheduleForYou/actions/workflows/laravel.yml">
    <img alt="Click to see the source" src="https://github.com/garobcsi/ScheduleForYou/actions/workflows/laravel.yml/badge.svg" />
  </a>
</p>

> **Warning** <br>
> This Project is intended to run on linux. [See Why]()

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

## :keyboard: Useful Commands

### Log Into Fish Shell

1. Initialize the project
2. Run `docker-compose exec app fish`

### Save Database tables to the seeder

1. Initialize the project
2. Log Into Fish shell `docker-compose exec app fish`
3. Run `php artisan iseed <table name 1>,<table name 2>,<table name 3>` <br>
Example `php artisan iseed users,personal_access_tokens`

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

## :bust_in_silhouette: PhpMyAdmin Users

### Root user
- Username: root
- Password: root_password

### Simple user
- Username: laravel
- Password: laravel

### Change user/password

1. Initialize the project
2. Open `.env` file 
3. Change `DB_USERNAME=<simple username>`
4. Change `DB_PASSWORD=<simple user password>`
5. Change `MYSQL_ROOT_PASSWORD=<root passowrd>`

## :warning: Running the Application On Windows

Our applications use [docker volumes](https://docs.docker.com/storage/volumes/) to save changes. Because the application uses many small files the coping between the Windows filesystem (NTFS) and Dockers filesystem (ext4) makes it run slower. By making the os filesystem and the Dockers filesystem the same the application will run much quicker.

For example, when we used [Wsl](https://learn.microsoft.com/en-us/windows/wsl/install) on Windows we saw the same speed difference as a proper Linux installation

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

[Open Google Docs](https://docs.google.com/document/d/1ShLbxv7K0FDphoZtEsumG2i_mhR7eEySRCVUruQ7b8s/edit?usp=sharing)

### Swagger (API Docs)(WIP)

1. Initialize the project
2. Build swagger docs `docker-compose exec app php artisan l5-swagger:generate`
3. Navigate to site `<your ip>:80/api/docs` Example `localhost/api/docs`

## :hammer_and_wrench: Development Tools Used

### Idea's

- [PhpStorm](https://www.jetbrains.com/phpstorm/)
- [VsCode](https://code.visualstudio.com/)
 
### Programs

- [DataGrip](https://www.jetbrains.com/datagrip/)
- [Postman](https://www.postman.com/)
- [Virtualbox](https://www.virtualbox.org/)

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