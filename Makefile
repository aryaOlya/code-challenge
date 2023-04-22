run:
	cp .env.example .env
	docker compose up -d --build --force-recreate
	docker exec -t code-challenge-php-1 bash -c "composer install;php artisan key:generate;php artisan migrate;php artisan db:seed;"
php:
	docker exec -it code-challenge-php-1 bash
