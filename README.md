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
 - GET /verify-email/{token} verify-email
```
## Requirments
- [Docker](https://docs.docker.com/desktop/windows/install/)
- [Docker compose](https://docs.docker.com/compose/install/) (just for users with Linux, because for the mac and Windows, it comes with the desktop app)

## Installation
Once inside the directory execute the following commands:
```
cp .env.develop .env
docker-compose up --build -d
```
Once you finish the process of building the Docker app, install all the dependencies with Composer::
```
docker exec my_app_container composer install
```
The last one is for the Laravel migrations:
```
docker exec my_app_container php artisan migrate
```

## Usage

Now that we have our docker app running, with the Apache server with PHP, MySQL, and phpMyAdmin for management we can access the following endpoints:
* [phpMyAdmin](http://localhost:9002/)
    * Server: **my_db_container**
    * Username: **root**
    * Password: **root**
* [Api Docs](http://localhost:9009/request-docs/)
    * Here you will have all the endpoints available for consumption, all you have to do is complete the request body parameters and the path parameters when it's necessary.
* Postman Repository: Additionally, if you prefer, you can try the API with Postman by downloading the collection from the folder /storage/attachments.

## Testing
You can test the patient endpoints with the PestPHP tool by running this command:
```
docker exec my_app_container ./vendor/bin/pest --group=patient
```

### A short video of the process of the store endpoint:
![chrome_EGiKW6T59Z](https://github.com/tomassueldo/patient-app/assets/84208722/3b630368-66fa-4bdb-92f0-56e43bff3b5c)





## License

