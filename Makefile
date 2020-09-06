current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))
SHELL = /bin/sh
docker-container = kalendapp-php-fpm

#
# ❓ Help output
#
help: ## show make targets
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_\-\/]+:.*?## / {sub("\\\\n",sprintf("\n%22c"," "), $$2);printf " \033[36m%-20s\033[0m  %s\n", $$1, $$2}' $(MAKEFILE_LIST)

#
# 🐘 Build and run
#
run: ## run project
	docker-compose up -d

stop: ## stop project
	docker-compose down

#
# 🔬 Testing
#
test/all: ## execute all tests
	docker exec $(docker-container) ./vendor/bin/phpunit --testsuite Unit
	docker exec $(docker-container) ./vendor/bin/phpunit --testsuite Integration
	docker exec $(docker-container) ./vendor/bin/behat

test/unit: ## execute unit tests
	docker exec $(docker-container) ./vendor/bin/phpunit --testsuite Unit

test/integration: ## execute integration tests
	docker exec $(docker-container) ./vendor/bin/phpunit --testsuite Integration

test/functional: ## execute functional tests
	docker exec $(docker-container) ./vendor/bin/behat

#
# 💅 Style and errors
#
style/all: ## analyse code style and possible errors
	docker exec $(docker-container) ./vendor/bin/php-cs-fixer fix --dry-run --diff --config .php_cs.dist
	docker exec $(docker-container) ./vendor/bin/phpstan analyse -c phpstan.neon

style/code-style: ## analyse code style
	docker exec $(docker-container) ./vendor/bin/php-cs-fixer fix --dry-run --diff --config .php_cs.dist

style/static-analysis: ## find possible errors with static analysis
	docker exec $(docker-container) ./vendor/bin/phpstan analyse -c phpstan.neon

style/fix: ## fix code style
	docker exec $(docker-container) ./vendor/bin/php-cs-fixer fix --config .php_cs.dist