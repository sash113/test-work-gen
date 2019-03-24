OS := $(shell uname)

build:
	sudo docker-compose build php
down:

ifeq ($(OS),Darwin)
	docker-sync-stack clean
else
	docker-compose down --remove-orphans
endif

up:
ifeq ($(OS),Darwin)
	docker-sync-stack start
else
	docker-compose up -d
	docker-compose logs -f
endif
clear:
	sudo rm -rf .docker/*/logs/*
	sudo rm -rf .docker/*/data/*
	sudo rm -rf var/*
	sudo rm -rf vendor/

test:
	sudo docker-compose exec php sh -c 'APP_ENV=test ./bin/phpunit tests'
