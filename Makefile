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
	sudo rm -rf app/build/*/data/*
	sudo rm -rf app/vendor/
	sudo rm -rf app/cache.properties
	sudo rm -rf app/storage/runtime/log/*
	sudo rm -rf app/storage/runtime/cache/*
	sudo rm -rf app/storage/runtime/aspect/*
	sudo rm -rf app/storage/runtime/debug/*
	sudo rm -rf app/storage/runtime/html/*
	sudo rm -rf app/src/Modules/Database/Mysql/*

fix-permission:
#	find .docker/ -type f -print0 | xargs -0 dos2unix
	sudo chown -R $(shell whoami):$(shell whoami) *
#	sudo chown -R $(shell whoami):$(shell whoami) .docker/*/data/*
	sudo chown -R $(shell whoami):$(shell whoami) .docker/*/logs/*

test:
#	sudo docker-compose exec php vendor/bin/codecept run

