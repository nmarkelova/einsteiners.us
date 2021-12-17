#Клонирование репозитория в исходную папку
git clone https://github.com/einsteinersnet/einsteiners.net.git ./
#Копирование файла конфигурации
cp .env.example .env
#Экспрот необходимых переменых для Docker
export APP_SERVICE=${APP_SERVICE:-"laravel.test"}
export DB_PORT=${DB_PORT:-3306}
export WWWUSER=${WWWUSER:-$UID}
export WWWGROUP=${WWWGROUP:-$(id -g)}
#Сборка
docker-compose build
#Запуск Докер именно через помощника sail
bash vendor/bin/sail up
#Внутри контейнера: 
php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan log:clear
#Если первая установка - без бекапа базы данных
php artisan migrate