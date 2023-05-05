[![Laravel & PHP](https://github.com/garobcsi/ScheduleForYou/actions/workflows/laravel.yml/badge.svg)](https://github.com/garobcsi/ScheduleForYou/actions/workflows/laravel.yml)

# Schedule For You

### Quick navigation
* **[:black_nib: About The Project](#black_nib-about-the-project)**
* **[:building_construction: Building the application](#building_construction-building-the-application)**
  * [Prerequisites](#prerequisites)
  * [Building For Development](#building-for-development)
  * [Building Manually For Development](#building-manually-for-development)
  * [Building For Production](#building-for-production)
  * [Building Manually For Production](#building-manually-for-production)
  * [Having troubles ?](#having-troubles)
* **[:open_file_folder: Application ports](#open_file_folder-application-ports)**
* **[:keyboard: Useful Commands](#keyboard-useful-commands)**


# :black_nib: About The Project

Schedule For You is a versatile and user-friendly application designed to simplify your daily scheduling needs. The application is built with the goal of providing users with an easy-to-use platform to manage their schedules effectively. With Schedule For You, you can easily organize your personal and professional appointments in one convenient location.

# :building_construction: Building the application

### Prerequisites

* [Docker](https://www.docker.com/) & [Docker-Compose](https://docs.docker.com/compose/)

### Building For Development
1. Make sure project is not running in `docker`
2. Navigate to `src/laravel-vue`
3. Run `./start-dev.sh`
### Building Manually For Development
1. Make sure project is not running in `docker`
2. Navigate to `src/laravel-vue`
3. Start the application `docker compose -f docker-compose.yml -f docker-compose.dev.yml up -d --build`
4. Log into fish shell `docker compose exec app fish`
5. Install composer `composer install`
6. Generate key `php artisan key:generate`
7. Migrate the database `php artisan migrate:fresh --seed`
8. Install node packages `npm i`
9. Start Vite dev mode `npm run dev`
### Building For Production
1. Make sure project is not running in `docker`
2. Navigate to `src/laravel-vue`
3. Run `./start-prod.sh`
### Building Manually For Production
1. Make sure project is not running in `docker`
2. Navigate to `src/laravel-vue`
3. Start the application `docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d --build`
4. Log into fish shell `docker compose exec app fish`
5. Install composer `composer install`
6. Generate key `php artisan key:generate`
7. Migrate the database `php artisan migrate:fresh --seed`
8. Install node packages `npm i`
9. Build the application `npm run build`
### Having troubles ?

# :open_file_folder: Application ports
- Website: `80`
- Vite: `5000` (development only, In prodoction dosen't work/used)
- PhpMyAdmin: `5001`
- DB (MySql): `33061`
# :keyboard: Useful Commands
<!-- ## LINKEK -->

<!-- Trello (done): https://trello.com/b/k4g2bpTB/vizsgaremek-naptár

Figma: (done) https://www.figma.com/file/qlWjgsmqi6hjBC6cHR09qB/Vizsgaremek?node-id=0%3A1&t=ZHQlMKRc6BF3in2D-1

Funkcionális specifikáció (done): https://docs.google.com/document/d/1ShLbxv7K0FDphoZtEsumG2i_mhR7eEySRCVUruQ7b8s/edit?usp=sharing -->
