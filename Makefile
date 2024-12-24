start:
	docker-compose build
	docker-compose up -d
	docker exec -it script_app bash -c "cd app && composer install"
	docker cp ./db_backup.sql db:/tmp/db_backup.sql
