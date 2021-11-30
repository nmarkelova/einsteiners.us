---
CONSOLE RUN
---

git clone https://github.com/einsteinersnet/einsteiners.net.git
cd einsteiners.net
cp .env.example .env

--- 
COPY AND REPLACE TO .env
---

APP_URL= [... https://domains.com/ ...]

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=einsteiners
DB_USERNAME=root
DB_PASSWORD=root

MAIL_MAILER=smtp
MAIL_HOST= [... smtp host ...]
MAIL_PORT=465
MAIL_USERNAME= [... login ...]
MAIL_PASSWORD= [... pass ...]
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS= [... mail ...]
MAIL_FROM_NAME="${APP_NAME}"

---
CONSOLE RUN
---

php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan log:clear
php artisan key:generate
php artisan storage:link
php artisan migrate