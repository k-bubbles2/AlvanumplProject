# AlvanumplProject

**installation**

git clone https://github.com/k-bubbles2/AlvanumplProject.git

**Usage:**

cd AlvanumplProject

Поднять с пересборкой:
make build (или docker-compose up -d --build)

Поднять:
make up

Погасить:
make down

тесты: 
docker-compose exec -T fpm vendor/bin/codecept run

API:
http://localhost:8080/search

RESOURCE: POST /search?[weights]
PAYLOAD:
{
    "color":"green|red|blue",
    "size":15,
    "wool":true,
    "horn":"straight|spiral"
}
