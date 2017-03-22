PWD = $(shell pwd)
BASENAME_LOWER = $(shell basename $(PWD) | tr '[:upper:]' '[:lower:]')

install: build up composer_install
	
build:
	docker-compose build
	
up:
	docker-compose up -d
	
composer_install: 
	docker run --rm -v $(shell pwd):/app composer/composer install

composer_update:
	docker run --rm -v $(shell pwd):/app composer/composer update
	
destroy: 
	docker-compose kill
	docker-compose rm -f
