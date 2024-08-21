UID=`id -u`
GID=`id -g`

print_vars:
	echo $(UID) && echo $(GID)

up:
	UID=$(UID) GID=$(GID) docker compose up

up-build:
	UID=$(UID) GID=$(GID) docker compose up --build

down:
	docker compose down --remove-orphans

bash:
	UID=$(UID) GID=$(GID) docker compose exec cli bash

clear-cache:
	UID=$(UID) GID=$(GID) docker compose exec cli php artisan cache:clear

mysql:
	docker compose exec db mysql -hdb -uroot -pdbroot

mysql-bash:
	docker compose exec db bash

create_db:
	docker compose exec db mysql -hdb -uroot -pdbroot -e "CREATE DATABASE ID NOT EXISTS events_experiments_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

drop_db:
	docker compose exec db mysql -hdb -uroot -pdbroot -e "DROP DATABASE IF EXISTS events_experiments_db;"

create_db:
	UID=$(UID) GID=$(GID) docker compose exec cli php artisan migrate --force

seeds:
	UID=$(UID) GID=$(GID) docker compose exec cli php artisan db:seed

install:
	UID=$(UID) GID=$(GID) docker compose exec cli composer install

run-migrations:
	UID=$(UID) GID=$(GID) docker compose exec cli php artisan migrate:fresh


do-test-all:
	UID=$(UID) GID=$(GID) docker compose exec cli php ./vendor/bin/pest

test-units:
	UID=$(UID) GID=$(GID) docker compose exec cli php ./vendor/bin/pest --filter '/Unit/'

do-test-integration:
	UID=$(UID) GID=$(GID) docker compose exec cli php ./vendor/bin/pest --filter '/Integration/'

do-test-api:
	UID=$(UID) GID=$(GID) docker compose exec cli php ./vendor/bin/pest --filter '/Api/'

cs-fixer:
	UID=$(UID) GID=$(GID) docker compose exec cli php ./vendor/bin/php-cs-fixer fix --allow-risky=yes

psalm:
	UID=$(UID) GID=$(GID) docker compose exec cli ./vendor/bin/psalm

clear-log:
	UID=$(UID) GID=$(GID) docker compose exec cli truncate -s 0 ./storage/logs/laravel.log

recreate-db: drop_db create_db seeds

test-integration: clear-log drop_db create_db seeds do-test-integration

test-api: clear-log drop_db create_db seeds do-test-api

test-all: clear-log drop_db create_db seeds do-test-all
