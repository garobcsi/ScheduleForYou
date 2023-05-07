
<h1 align="center">Schedule For You</h1>
<p align="center">
  <a href="https://github.com/garobcsi/ScheduleForYou/actions/workflows/laravel.yml">
    <img alt="Click to see the source" src="https://github.com/garobcsi/ScheduleForYou/actions/workflows/laravel.yml/badge.svg" />
  </a>
</p>

### Quick Navigation
* **[:black_nib: About The Project](#black_nib-about-the-project)**
* **[:building_construction: Building the application](#building_construction-building-the-application)**
  * [Prerequisites](#prerequisites)
  * [Building For Development](#building-for-development)
  * [Building Manually For Development](#building-manually-for-development)
  * [Building For Production](#building-for-production)
  * [Building Manually For Production](#building-manually-for-production)
  * [Having troubles?](#having-troubles)
* **[:open_file_folder: Application ports](#open_file_folder-application-ports)**
* **[:keyboard: Useful Commands](#keyboard-useful-commands)**
* **[:open_book: Documentation](#open_book-documentation)**
  * [Functional specification (WIP)](#functional-specification-wip)
  * [Swagger (API Docs)(WIP)](#swagger-api-docswip)


# :black_nib: About The Project

Schedule For You is a versatile and user-friendly application designed to simplify your daily scheduling needs. The application is built to provide users with an easy-to-use platform to manage their schedules effectively. With Schedule For You, you can easily organize your personal and professional appointments in one convenient location.

# :toolbox: What technologies that we used

# :building_construction: Building the application

### Prerequisites

* [Docker](https://www.docker.com/) & [Docker-Compose](https://docs.docker.com/compose/)

### Building For Development
1. Make sure the project is not running in the `docker`
2. Navigate to `src/laravel-vue`
3. Run `./start-dev.sh`
### Building Manually For Development
1. Make sure the project is not running in the `docker`
2. Navigate to `src/laravel-vue`
3. Start the application `docker-compose -f docker-compose.yml -f docker-compose.dev.yml up -d --build`
4. Log into fish shell `docker-compose exec app fish`
5. Install `composer install`
6. Generate key `php artisan key:generate`
7. Migrate the database `php artisan migrate:fresh --seed`
8. Install node packages `npm i`
9. Start Vite dev mode `npm run dev`
### Building For Production
1. Make sure the project is not running in the `docker`
2. Navigate to `src/laravel-vue`
3. Run `./start-prod.sh`
### Building Manually For Production
1. Make sure the project is not running in the `docker`
2. Navigate to `src/laravel-vue`
3. Start the application `docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d --build`
4. Log into fish shell `docker-compose exec app fish`
5. Install composer `install``
6. Generate key `php artisan key:generate`
7. Migrate the database `php artisan migrate:fresh --seed`
8. Install node packages `npm i`
9. Build the application `npm run build`
### Having troubles?

# :open_file_folder: Application ports
- Website: `80`
- Vite: `5000` (development only, In production doesn't work/used)
- PhpMyAdmin: `5001`
- DB (MySql): `33061`
# :keyboard: Useful Commands

# :open_book: Documentation
### Functional specification (WIP)
[Open Google Docs](https://docs.google.com/document/d/1ShLbxv7K0FDphoZtEsumG2i_mhR7eEySRCVUruQ7b8s/edit?usp=sharing)
### Swagger (API Docs)(WIP)
1. Build the application
2. Build swagger docs `docker-compose exec app php artisan l5-swagger:generate`
3. Navigate to `<your ip>:80/api/docs` Example `localhost/api/docs`

# :speaking_head: Collaboration tools

# :hammer_and_wrench: Development Tools

# :busts_in_silhouette: Made By
- Gáspár Róbert
- Palánki Szűcs Donát
- Balázs Bence
<!-- ## LINKEK -->

<!-- Trello (done): https://trello.com/b/k4g2bpTB/vizsgaremek-naptár

Figma: (done) https://www.figma.com/file/qlWjgsmqi6hjBC6cHR09qB/Vizsgaremek?node-id=0%3A1&t=ZHQlMKRc6BF3in2D-1

Funkcionális specifikáció (done): https://docs.google.com/document/d/1ShLbxv7K0FDphoZtEsumG2i_mhR7eEySRCVUruQ7b8s/edit?usp=sharing -->
