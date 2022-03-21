## TODO: add phpunit reporting options


.PHONY: help
## help: prints this help message
help:
	@echo "Usage:"
	@sed -n 's/^##//p' ${MAKEFILE_LIST} | column -t -s ':' |  sed -e 's/^/ /'

.PHONY: devenv-setup
## devenv: starts the development environment and fetch dependencies
devenv-setup:
	@echo "Starting development environment ~"
	@docker-compose up -d
	@docker-compose exec -T fpm composer install

.PHONY: logs
## logs: follow the logs from the fpm container
logs:
	@docker-compose logs -f fpm

.PHONY: phpunit
## phpunit: run test suite inside the fpm container. To get a test report in the build/ folder set COVREPORT=true - EG COVREPORT=true make phpunit
phpunit:
	@docker-compose exec -T fpm ./vendor/bin/phpunit $(PHPUNITFLAGS)

.PHONY: shell
## shell: opens a shell in the fpm container
shell:
	@docker-compose exec fpm sh