current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))
SHELL = /bin/sh
docker-container = kalendapp-php-fpm

#
# ❓ Help output
#
help: ## Show make targets
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_\-\/]+:.*?## / {sub("\\\\n",sprintf("\n%22c"," "), $$2);printf " \033[36m%-24s\033[0m  %s\n", $$1, $$2}' $(MAKEFILE_LIST)

#
# 🐘 Build and run
#
start: ## Start and run project
	docker-compose up -d

stop: ## Stop project
	docker-compose down

#
# 🔬 Testing
#
test/all: ## Execute all tests
	docker exec $(docker-container) ./vendor/bin/phpunit --testsuite Unit
	docker exec $(docker-container) ./vendor/bin/phpunit --testsuite Integration
	docker exec $(docker-container) ./vendor/bin/behat

test/unit: ## Execute unit tests
	docker exec $(docker-container) ./vendor/bin/phpunit --testsuite Unit

test/integration: ## Execute integration tests
	docker exec $(docker-container) ./vendor/bin/phpunit --testsuite Integration

test/functional: ## Execute functional tests
	docker exec $(docker-container) ./vendor/bin/behat

#
# 💅 Style and errors
#
style/all: ## Analyse code style and possible errors
	docker exec $(docker-container) ./vendor/bin/php-cs-fixer fix --dry-run --diff --config .php_cs.dist
	docker exec $(docker-container) ./vendor/bin/phpstan analyse -c phpstan.neon

style/code-style: ## Analyse code style
	docker exec $(docker-container) ./vendor/bin/php-cs-fixer fix --dry-run --diff --config .php_cs.dist

style/static-analysis: ## Find possible errors with static analysis
	docker exec $(docker-container) ./vendor/bin/phpstan analyse -c phpstan.neon

style/fix: ## Fix code style
	docker exec $(docker-container) ./vendor/bin/php-cs-fixer fix --config .php_cs.dist