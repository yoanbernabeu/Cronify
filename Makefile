SHELL := /bin/bash

install: export APP_ENV=dev
install:
	docker-compose up -d
	composer install
	npm install
	npm run build
	symfony console d:d:c
	symfony console d:m:m --no-interaction
.PHONY: install

start: export APP_ENV=dev
start:
	docker-compose up -d
	symfony serve -d
.PHONY: start

stop: export APP_ENV=dev
stop:
	docker-compose stop
	symfony server:stop
.PHONY: stop

tests: export APP_ENV=test
tests:
	symfony php bin/phpunit --testdox
.PHONY: tests

coverage: export APP_ENV=test
coverage:
	XDEBUG_MODE=coverage symfony php bin/phpunit --coverage-html var/coverage/test-coverage
.PHONY: coverage

reset: export APP_ENV=dev
reset:
	symfony console d:d:d --force
	symfony console d:d:c
	symfony console d:m:m --no-interaction
.PHONY: reset