DC = docker compose

build:
	$(DC) build --no-cache

up:
	$(DC) up -d

exec:
	$(DC) exec app sh

logs:
	$(DC) logs --follow