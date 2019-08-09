<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

- для автоматического заполнения БД(запуск UsersTableSeeder, WeightTableSeeder):
    php artisan db:seed 
-тесткейс на проверку регистрации пользователя:
    vendor/bin/phpunit tests/Feature/RegisterTest.php
-тесткейс на проверку авторизации пользователя:        
    vendor/bin/phpunit tests/Feature/LoginTest.php

1. регистрация пользователя:
  Postman endpoint: http://localhost:8000/auth/registration
boby: обязательные поля для заполения:
"name":"Vasya",
"email":"1@i.ua",
"password":"123456789"
ответ успешной регистрации: 'Successfully registration!', статус 201 CREATED.
ответ при неправило введенных данных: "message": "Invalid data, please, check your data", 
статус 422 Unprocessable_Entity.
2. авторизация пользователя:
Postman endpoint:http://localhost:8000/auth/login
boby: 
обязательные поля для заполения:
"email":"mose.okeefe@yahoo.com",
"password":"123456789"
ответ успешной авторизации:  
"access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXV0aFwvbG9naW4iLCJpYXQiOjE1NjUyNTk4MzEsImV4cCI6MTU2NTI2MzQzMSwibmJmIjoxNTY1MjU5ODMxLCJqdGkiOiJ4WDd4S2lDbVBERHhuY3N1Iiwic3ViIjozNywicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.ME9rNU8IJcejzTSB_CipsjL3ucFZygGGZwGHffPFt7w",
"token_type": "bearer",
"expires_in": 3600
ответ при неправило введенных данных:"message": 'error' => 'Unauthorized', статус 404 NOT_FOUND
        
3.посмотреть информацию по авторизированному пользователю:
Postman endpoint:http://localhost:8000/auth/me
ответ при правильно веденном ранее полученого access_token : 
"id": 37,
"name": "Moriah Beier",
"email": "mose.okeefe@yahoo.com",
"email_verified_at": null,
"created_at": "2019-08-05 08:15:09",
"updated_at": "2019-08-05 08:15:09"
ответ при неправильно введенным access_token: 'error' => 'Unauthorized'], статус 404 NOT_FOUND
       
4. ввод данных о весе зарегистрированого пользователя: 
Postman endpoint: POST http://localhost:8000/weights
boby:
обязательное поле для заполения: "value":"60", 
допустимо значение null :        "remark":"new weight" 
ответ при валидных данных: статус 201 CREATED
ответ при невалидных данных:
"message": "The given data was invalid.",
"errors": {
        "value": [
            "The value field is required."
        ]
    } 
    
5. отображение всех данных по весу зарегистрированого пользователя:
Postman endpoint: GET http://localhost:8000/weights
ответ при валидных данных: выведение данных, статус 200 ОК
        
6. поиск данных о весе по заданому id:
Postman endpoint: GET http://localhost:8000/weights/{id}
ответ при наличии указаного id:  выведение данных, статус 200 ОК
ответ при отсутствии указаного id:
"message": "The given data was invalid.",
    "errors": {
        "weightId": "such weightId couldn`t be found."
    }, статус 404 NOT_FOUND
            
7. редактирование данных о весе:
Postman endpoint: PUT http://localhost:8000/weights/{id}
ответ при наличии указаного id:  выведение измененных данных, статус 200 ОК
ответ при отсутствии указаного id:  
"message": "The given data was invalid.",
    "errors": {
        "weightId": "such weightId couldn`t be found.", статус 404 NOT_FOUND
                
8. удаление данных о весе:
Postman endpoint: DELETE http://localhost:8000/weights/{id}
ответ при наличии указаного id:статус 204 No Content 
ответ при отсутствии указаного id:  
"message": "The given data was invalid.",
    "errors": {
        "id": "such weightId couldn`t be found.",  статус 404 NOT_FOUND
                
9. получение данных о весе за период времени: 
Postman endpoint: GET http://localhost:8000/dates
boby:
"from":"2019-08-01",
"to":"2019-08-07"
ответ при валидных данных: выведение данных, статус 200 ОК    
ответ при невалидных данных: 
"message": "The given data was invalid.",
    "errors": {
        "to": [
            "The to field is required."
        ]
    }       
    
10. получение последних n замеров:
Postman endpoint: GET http://localhost:8000/number/{n}
ответ при наличии указаных n записей:  выведение данных, статус 200 ОК
ответ при отсутствии указаных n записей:
"message": "The given data was invalid.",
    "errors": {
        "number of weights": "such number of weights couldn`t be found." , статус 404 NOT_FOUND
