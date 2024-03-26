#---VARIABLES---------------------------------#
#---DOCKER---#
DOCKER = docker
DOCKER_RUN = $(DOCKER) run
#------------#

#---SYMFONY--#
SYMFONY = symfony
SYMFONY_SERVER_START = $(SYMFONY) serve -d
SYMFONY_SERVER_STOP = $(SYMFONY) server:stop
SYMFONY_CONSOLE = $(SYMFONY) console
#------------#

#---COMPOSER-#
COMPOSER = composer
COMPOSER_INSTALL = $(COMPOSER) install
#------------#

#---PHPQA---#
PHPQA = jakzal/phpqa
PHPQA_RUN = $(DOCKER_RUN) --init -it --rm -v $(PWD):/project -w /project $(PHPQA)
#------------#

## === 🆘  HELP ==================================================
help: ## Show this help.
	@echo "Symfony-And-Docker-Makefile"
	@echo "---------------------------"
	@echo "Usage: make [target]"
	@echo ""
	@echo "Targets:"
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
#---------------------------------------------#

## === 🎛️  SYMFONY ===============================================
sf: ## List and Use All Symfony commands (make sf command="commande-name").
	$(SYMFONY_CONSOLE) $(command)
.PHONY: sf

sf-ddc: ## Create symfony database.
	$(SYMFONY_CONSOLE) doctrine:database:create --if-not-exists
.PHONY: sf-ddc

sf-ddd: ## Drop symfony database.
	$(SYMFONY_CONSOLE) doctrine:database:drop --if-exists --force
.PHONY: sf-ddd


sf-dmm: ## Migrate.
	$(SYMFONY_CONSOLE) doctrine:migrations:migrate --no-interaction
.PHONY: sf-dmm

sf-install-dev: ## Install project in dev mode.
	$(COMPOSER_INSTALL); \
	$(SYMFONY_SERVER_START); \
	$(MAKE) sf-ddc; \
	$(MAKE) sf-dmm
.PHONY: sf-install-dev

sf-start: ## Start containers and server.
	$(SYMFONY_SERVER_START)
.PHONY: sf-start

sf-stop: ## Stop server and containers.
	$(SYMFONY_SERVER_STOP)
.PHONY: sf-restart

sf-restart: ## Restart server.
	$(SYMFONY_SERVER_STOP); \
	$(SYMFONY_SERVER_START)
.PHONY: sf-restart

sf-log: ## Show symfony logs.
	$(SYMFONY) server:log
.PHONY: sf-log

sf-build: ## Build assets.
	$(SYMFONY_CONSOLE) sass:build; \
	$(SYMFONY_CONSOLE) asset-map:compile
.PHONY: sf-build

#---------------------------------------------#

## === 🐛  PHPQA =================================================
qa-cs-fixer-dry-run: ## Run php-cs-fixer in dry-run mode. (Code Standard)
	$(PHPQA_RUN) php-cs-fixer fix ./src --rules=@Symfony --verbose --dry-run
.PHONY: qa-cs-fixer-dry-run

qa-phpstan: ## Run phpstan. (Static Analysis - Bug detector)
	$(PHPQA_RUN) phpstan analyse ./src --level=7
.PHONY: qa-phpstan

qa-php-metrics: ## Run php-metrics.
	$(PHPQA_RUN) phpmetrics --report-html=var/phpmetrics ./src
.PHONY: qa-php-metrics
#---------------------------------------------#
