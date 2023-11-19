build:
	docker compose build
up:
	docker compose up -d
down:
	docker compose down
php-bash:
	docker compose exec php-mvc-blog bash
php-logs:
	docker compose logs php-mvc-blog
nginx-bash:
	docker compose exec nginx-mvc-blog bash
nginx-logs:
	docker compose logs nginx-mvc-blog
vendor:
	docker compose exec php-mvc-blog bash -c "composer install"
seed:
	docker compose exec php-mvc-blog bash -c "php ./database/Run.php seed $(name)"
migrate:
	docker compose exec php-mvc-blog bash -c "php ./database/Run.php migrate"