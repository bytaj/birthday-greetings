init:
	docker-compose exec app composer install

test:
	docker-compose exec app bin/phpunit
