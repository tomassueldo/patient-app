# Patient App

Patient App is an API that has the following endpoints for a CRUD of patients:

```diff
# API:
 # GET|HEAD /api/v1/patients patients.index
 # GET|HEAD /api/v1/patients/{patient} patients.show
 # POST /api/v1/patients patients.store
 # PUT|PATCH /api/v1/patients/{patient} patients.update
 # DELETE /api/v1/patients/{patient} patients.destroy
 # POST /api/v1/send-sms/{idpatient}
- And this one web for the email verification:
 - PATCH /verify-email/{token} verify-email
```
## Requirments
- [Docker](https://docs.docker.com/desktop/windows/install/)
- [Docker compose](https://docs.docker.com/compose/install/) (just for users with Linux, because for the mac and Windows, it comes with the desktop app)

## Installation
Once inside the directory execute the following commands:
```
$ cp .env.develop .env
$ docker-compose up --build -d
```
Once finish the process of building the docker app, just in case, install all the dependencies with composer:
```
$ docker exec my_app_container composer install
```
The last one is for the Laravel migrations:
```
$ docker exec my_app_container php artisan migrate
```

## Usage

Now that we have our docker app running, with the Apache server with PHP, MySQL, and phpMyAdmin for management we can access the following endpoints:
* [phpMyAdmin](http://localhost:9002/)
    * Server: **my_db_container**
    * Username: **root**
    * Password: **root**
* [Api Docs](http://localhost:9009/request-docs/)
    * Here you will have all the endpoints available for consumption, all you have to do is complete the request body parameters and the path parameters when it's necessary.

### A short video of the process of the store endpoint:







## License

