up:
	#docker network create dev-tools_proxy || true
	docker-compose up -d
	docker-compose exec -T fpm composer install --prefer-dist --no-interaction
	#docker-compose -f ./docker/graylog/docker-compose.yml up -d

down:
	docker-compose -f ./docker/graylog/docker-compose.yml down
	docker-compose down --remove-orphans

build: down
	#docker network create dev-tools_proxy || true
	docker-compose up -d --build
	docker-compose exec -T fpm composer install --prefer-dist --no-interaction
	#docker-compose -f ./docker/graylog/docker-compose.yml up -d
