<p align="center"><img height="188" width="198" src="https://thumb.cloud.mail.ru/weblink/thumb/xw1/3yQ4/5g3m662FE/telegram_bot_avatar.jpg?x-email=ilias555%40mail.ru"></p>
<h1 align="center">Bot for Shkola Samodiscipline</h1>

## About Bot of Shkola Samodiscipline

This bot is ordered by www.shkolasamodiscipline.com
This solution is help use Telegram Bot and Online Web Resource to Control Group of people to be better.

## Which patform, applications, libraries used in this project
**the list of applications:**

- Laravel Framework, https://laravel.com/
- Botman, https://botman.io/
- Bootstrap, https://getbootstrap.com/
- JQuery, https://jquery.com/
- ChartJS, https://jquery.com/

## Application Live URL

**BOT 1**
Web: https://bot1.shkolasamodiscipline.com/
Telegram Bot: @shkolasamodiscipline_bot1_bot

**BOT 2**
Web: https://bot2.shkolasamodiscipline.com/
Telegram Bot: @shkolasamodiscipline_bot2_bot

**BOT 3**
Web: https://bot3.shkolasamodiscipline.com/
Telegram Bot: @shkolasamodiscipline_bot3_bot

**BOT Free**
Web: https://botfree.shkolasamodiscipline.com/
Telegram Bot: @shkolasamodiscipline_botfree_bot


## How to install application

**Telegram**
Find BotFather Bot and create the bot by following command:

```
/newbot
```
During setup you have to enter Bot name, possible use name with spaces, and enter Username without spaces and _bot at the end
It will generate Telegram API Key which you can use in future in env file.

Set the Description to the bot:
```
/setdesctiption
```
Sample for description:
```
Бот создан для сбора отчетов от участников Школы Самодисциплины.

Для участия в увлектальном соревновании жизни, вам необходимо обратится к менеджерам Школы Самодисциплины.

С правилами сдачи отчетов можно узнать через меню в боте.

URL онлайн отчетов: https://boturl.shkolasamodiscipline.com

Желаем вам успехов и плодотворной работы надс собой!
```

**Configre Web Server**
In my case I am used Nginx Web Server and sample of config is following:

In your case it can be optimize as you desire )
```
server {
    server_name boturl.shkolasamodiscipline.com;
    charset utf-8;

    root   /var/www/samo/boturl.shkolasamodiscipline.com/public_html/public/;
    index index.php index.html index.htm;

    error_log /var/www/samo/boturl.shkolasamodiscipline.com/logs/error.log error;
    access_log /var/www/samo/boturl.shkolasamodiscipline.com/logs/access.log combined;

gzip on;
    gzip_vary on;
    gzip_disable "msie6";
    gzip_comp_level 6;
    gzip_min_length 1100;
    gzip_buffers 16 8k;
    gzip_proxied any;
    gzip_types
        text/plain
        text/css
        text/js
        text/xml
        text/javascript
        application/javascript
        application/x-javascript
        application/json
        application/xml
        application/xml+rss;


location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    error_page 404 /404.html;
    error_page 500 502 503 504 /50x.html;
    location = /50x.html {
        root /usr/share/nginx/html;
    }

    location ~ .php$ {
        try_files $uri =404;
        fastcgi_pass unix:/var/run/php-fpm/php-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/boturl.shkolasamodiscipline.com/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/boturl.shkolasamodiscipline.com/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot
}server {
    if ($host = boturl.shkolasamodiscipline.com) {
        return 301 https://$host$request_uri;
    } # managed by Certbot

    listen 80;
    server_name boturl.shkolasamodiscipline.com;
    return 404; # managed by Certbot
}
```

**Create MySql Database for Project**

By following command create database and user, assign user for access to the Dtaabase:

```
CREATE DATABASE `samo_bot1`;
CREATE USER 'samo_bot1'@'localhost' IDENTIFIED BY 'yourpassword';
GRANT USAGE ON *.* TO 'samo_bot1'@'localhost';
GRANT EXECUTE, SELECT, SHOW VIEW, ALTER, ALTER ROUTINE, CREATE, CREATE ROUTINE, CREATE TEMPORARY TABLES, CREATE VIEW, DELETE, DROP, EVENT, INDEX, INSERT, REFERENCES, TRIGGER, UPDATE, LOCK TABLES  ON `samo_bot1`.* TO 'samo_bot1'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;
SHOW GRANTS FOR 'samo_bot1'@'localhost';
```
Note: here some bug in sql code, I am usually create it by GUI - HeidiSql

**Install Source Code**

By following code pull the source code from GitHub:
```
git clone git@github.com:ilianapro/bot_shkolasamodiscipline.git
```

Move Source Code from subdirectory to the root folder of webroot
```
mv bot_shkolasamodiscipline/* ./
mv bot_shkolasamodiscipline/.* ./
```

Rename Environment file:
```
mv .env.example .env
```

**Pull all application dependencies**
```
composer update
```

**Edit Environment File**

```
vi .env
```

Update following keys:
```
APP_URL=http://example.com
APP_TIMEZONE=

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

TELEGRAM_TOKEN=

ADMIN1_NAME=
ADMIN1_EMAIL=
ADMIN1_PASSWORD=

ADMIN2_NAME=
ADMIN2_EMAIL=
ADMIN2_PASSWORD=
```

**Update Application Key**
```
php artisan key:generate
```


**Generate SSL Certificate from Let's Encrypt Service**
```
sudo certbot -d bot1.shkolasamodiscipline.com --nginx
```

**Migrate Database**
```
php artisan migrate
```

**Seed Database**
Create Auth Users
```
php artisan db:seed --class=UsersTableSeeder
```

Create Initial Motivation Data
```
php artisan db:seed --class=MotivatorsTableSeeder
```

Create Initial Groups Data
```
php artisan db:seed --class=GroupsSeeder
```

**Register Telegram**
```
php artisan botman:telegram:register
```
When ask the URL, enter by following format: 
```
https://boturl.shkolasamodiscipline.com/botman
```

**How to check if all works**

Onlinse resource is availbale by following URL:
https://boturl.shkolasamodiscipline.com/

Control Admin Panel is available by following URL: 
https://boturl.shkolasamodiscipline.com/admin/

Telegram should be available by following resource:
https://t.me/yourtelegrambotname_bot



**Fix Folder Permission Issue**
```
sudo chmod -R 775 storage
sudo chown -R nginx. storage
```

**DONE**

## License

This application was ordered by www.shkolasamodiscipline.com, If you wish to use in your project, please contact with them.