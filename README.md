## 🛠️ Установка

### Предварительные требования

* [PHP ^8.1](https://www.php.net/manual/ru/install.php)
* [Composer (v2+)](https://getcomposer.org/doc/00-intro.md)
* [Node.js (v16+)](https://nodejs.org/en) & [NPM (9+)](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm)
* SQLite for local

### Локальная установка

1. Склонируйте репозиторий проекта
```sh
git clone https://github.com/AsylKydraliev/daily_grow_test
```

2. Перейдите в директорию проекта
```sh
cd daily_grow_test
```

3. Скопируйте файл .env.example и переименуйте его в .env
```sh
cp .env.example .env
```

4. Укажите параметры подключения к БД в файле .env
```sh
DB_CONNECTION=sqlite
```

5. Установите зависимости, используя Composer
```sh
composer install
```

6. Установите зависимости, используя Npm
```sh
npm install
```

7. Запустите сборку фронтенд-ресурсов в режиме разработки
```sh
npm run dev
```

8. Сгенерируйте ключ приложения
```sh
php artisan key:generate
```

9. Примените миграции и заполнените данные сидерами
```sh
php artisan migrate --seed
```

10. Запустите локальный сервер разработки
```sh
php artisan serve --port=9876
```

11. Запуск планировщика на сервере
```sh
sudo crontab -e
* * * * * cd /daily_grow_test && php artisan schedule:run >> /dev/null 2>&1
```

11. Локальный запуск планировщика
```sh
php artisan app:sms-send
```

-----

## 🖥️ Руководство пользователя

Чтобы загрузить список клиентов, выполните следующие действия:
* Перейдите на страницу "Клиенты".
* На странице "Клиенты" найдите раздел "Загрузка клиентов".
* В разделе "Загрузка клиентов" нажмите на кнопку "Скачать шаблон".

Для отправки рассылки выполните следующие шаги:
* Перейдите в раздел "Рассылки".
* Выберите необходимую рассылку, сделав ее активной.

-----
