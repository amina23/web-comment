# TEST Symfony web commentaires: (architecture hexagonal (api + twig) )
## Getting Started

1. Run `docker compose build --pull --no-cache` to build fresh images
2. Run `docker compose up` (the logs will be displayed in the current shell)
3. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
4. Run `docker compose down --remove-orphans` to stop the Docker containers.
5. RUN `docker-compose run --rm --no-deps  php sh -c "bin/console doctrine:migrations:migrate --no-interaction"` to create database
6. RUN `docker-compose run --rm --no-deps  php sh -c "bin/console hautelook:fixtures:load --no-interaction --no-bundles"` to Add data fixtures
