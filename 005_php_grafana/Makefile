
build:
	docker-compose build --no-cache
	
up:
	docker-compose up -d
	
up-with-logs:
	docker-compose up

stop:
	docker-compose stop

down:
	docker-compose down

restart_php_app:
	docker-compose restart php-app
	
rebuild:
	$(MAKE) down
	$(MAKE) build
	$(MAKE) up
   