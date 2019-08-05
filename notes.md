### Замечания

1) Использьзуй PSR2 оформление кода, я тебе установил пакет composer который поможет это сделать.
Запускать так `./vendor/bin/php-cs-fixer fix app/`

2) В app/Http/Controllers/WeightController.php строка 15 инъекцию следует делать через интерфейс
3)

1. Ргистрация
Выберите метод POST и в поле Url укажите:
http://localhost:8000/auth/registration

Откройте вкладку Headers и добавьте 2 поля:
Content-Type = application/json
Accept = application/json

Откройте вкладку Body и добавьте 3 поля:
{
 "name": "your_name",
 "password":"your_password",
 "email":"your_email"
}
Нажмите кнопку Send.
Данные должны отправиться на сервер и в базе данных в таблице users
должна быть создана запись с новым пользователем. В ответ получите сообщение: 
 "message": "Successfull registration!"

2. Авторизация
Выберите метод передачи данных POST и укажите Url:
http://localhost:8000/auth/login

Откройте вкладку Headers и добавьте 2 поля:
Content-Type = application/json
Accept = application/json

Откройте вкладку Body и выберите тип raw и добавьте 2 поля:
{
 "password":"your_password",
 "email":"your_email"
}

Нажмите кнопку Send. После чего данные авторизации будут отправлены на
сервер и в ответ должен придти access_token, token_type и expires_in.

3. узнать персональные данные пользователя данного аккаунта по его токену
Выберите POST метод передачи данных и в Url укажите:
http://localhost:8000/auth/me

Откройте вкладку Headers и добавьте 3 поля:
Content-Type = application/json
Accept = application/json
Authorization = Bearer (вставить полученный ранее access_token)
Откройте вкладку Authorization выберите
Type=Bearer Token
Token = вставить полученный ранее access_token

Нажмите на кнопку Send и получили ответ от Api сервера.
Ответ состоит из авторизационных данных пользователя.

4. Выход из учетной записи.
Выберите метод передачи данных POST и укажите Url:
http://localhost:8000/auth/logout

Откройте вкладку Headers и проверить 3 поля:
Content-Type = application/json
Accept = application/json
Authorization = Bearer (должен быть ранее указаный access_token, полученный при авторизации)
Откройте вкладку Authorization выберите
Type=Bearer Token
Token = должен быть ранее указаный access_token, полученный при авторизации.
При успешном выходе из учетной записи, получите сообщение:
 "message": "Successfully logged out"

5. Для обновления access_token:
Выберите метод передачи данных POST и укажите Url:
http://localhost:8000/auth/refresh
полученный заменяем access_token на только что полученный access_token:
Откройте вкладку Headers и проверить 3 поля:
Content-Type = application/json
Accept = application/json
Authorization = Bearer (заменяем ранее указаный access_token обновленный access_token)
Откройте вкладку Authorization выберите
Type=Bearer Token
Token = заменяем ранее указаный access_token обновленный access_token.
