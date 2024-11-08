# HELP
.PHONY: help

help: ## Makefile help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-15s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help

up: ## Start local cluster.
	@$(MAKE) -s env
	docker-compose up -d
	symfony server:start

ps: ## Start local cluster.
	@$(MAKE) -s env
	docker-compose ps --all

myCompanyApiDb:
	@$(MAKE) -s env
	docker-compose up my_company_api_db -d

bash: ## Access php container command line.
	@$(MAKE) -s up
	docker-compose exec php bash

env: ## Confirm that .env file exists (internal).
	@test -s .env || cp .env.dist .env