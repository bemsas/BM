ENV_FILE=.env

ifneq ("$(wildcard $(ENV_FILE))","")
	include .env
	export
else
    $(error ENV_FILE Not Found. Enter the command: `cp .env.example .env`)
endif

ifeq ($(YII_ENV), dev)
	COMPOSE_FILE=docker-compose.$(YII_ENV).yml
else
	COMPOSE_FILE=docker-compose.yml
endif

bash:
	docker-compose -f ${COMPOSE_FILE} exec --user=www-data belief-map-php-fpm bash

up:
	docker-compose -f ${COMPOSE_FILE} up -d

down:
	docker-compose -f ${COMPOSE_FILE} down --remove-orphans

down-clear:
	docker-compose -f ${COMPOSE_FILE} down -v --remove-orphans

restart: down up

migrate:
	docker-compose -f ${COMPOSE_FILE} exec --user=www-data belief-map-php-fpm php yii migrate --interactive=0

install-dependencies:
	docker-compose -f ${COMPOSE_FILE} exec --user=www-data belief-map-php-fpm composer install --no-dev

install-dependencies-dev:
	docker-compose -f ${COMPOSE_FILE} exec --user=www-data belief-map-php-fpm composer install

update-dependencies:
	docker-compose -f ${COMPOSE_FILE} exec --user=www-data belief-map-php-fpm composer update

status:
	docker-compose -f ${COMPOSE_FILE} ps -a

create-admin:
	docker-compose -f ${COMPOSE_FILE} exec --user=www-data belief-map-php-fpm php yii command/create-user admin@test.org,test123,Admin,Admin 1

pull-changes:
	git pull

deploy: pull-changes install-dependencies migrate

deploy-dev: pull-changes install-dependencies-dev migrate
