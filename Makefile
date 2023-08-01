ifeq (,$(wildcard .env))
$(shell cp .env.example .env)
endif

include .env

devdown:
	docker compose down --remove-orphans

ifeq ($(OS),Windows_NT)
devup:
	docker compose up -d --remove-orphans

devinstall:
	@docker exec -it ${COMPOSE_PROJECT_NAME}-server-1 composer install
	@if not exist server\.env (copy server\.env.example server\.env && docker exec -it ${COMPOSE_PROJECT_NAME}-server-1 php artisan key:generate && docker exec -it ${COMPOSE_PROJECT_NAME}-server-1 php artisan jwt:secret)

devfresh:
	docker exec -it ${COMPOSE_PROJECT_NAME}-server-1 php artisan migrate:fresh --seed

else

devup:
	USER=$$(id -u):$$(id -g) docker compose up -d --remove-orphans

devinstall:
	@docker exec -it -u $$(id -u):$$(id -g) $(COMPOSE_PROJECT_NAME)-server-1 composer install
	@test -f server/.env || (cp server/.env.example server/.env && docker exec -it ${COMPOSE_PROJECT_NAME}-server-1 php artisan key:generate && docker exec -it ${COMPOSE_PROJECT_NAME}-server-1 php artisan jwt:secret)
	@docker exec -it $(COMPOSE_PROJECT_NAME)-server-1 sh -c "chown -R :www-data storage/* bootstrap/cache"
	
devmigrate:
	USER=$$(id -u):$$(id -g) docker exec -it $(COMPOSE_PROJECT_NAME)-server-1 php artisan migrate --seed

devfresh:
	USER=$$(id -u):$$(id -g) docker exec -it $(COMPOSE_PROJECT_NAME)-server-1 php artisan migrate:fresh --seed

devclean: devdown
	@docker rmi $$(docker images -a -q)
	@docker volume rm $$(docker volume ls -q)

endif