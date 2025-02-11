
start:
	docker-compose up -d --remove-orphans

build:
	docker-compose up -d --remove-orphans --build

stop:
	docker-compose down --remove-orphans

ssh:
	docker-compose run --rm php-8-0 bash
	
composer-i:
	docker-compose run php-8-0 composer install
	
composer-up:
	docker-compose run php-8-0 composer update