# yii2-test-rest-api

Start - 

docker-compose up -d

docker-compose exec app php yii migrate

Open api.http in PHPStorm


Routes

GET http://localhost/v1/leads

GET http://localhost/v1/leads/<id>

POST http://localhost/v1/leads

PUT http://localhost/v1/leads/<id>/update

DELETE http://localhost/v1/leads/<id>


POST http://localhost/v1/sources


POST http://localhost/v1/auth
