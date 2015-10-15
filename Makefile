vendor/autoload.php:
	composer install --no-interaction --prefer-dist

.PHONY: sniff
sniff: vendor/autoload.php
	vendor/bin/phpcs --standard=PSR2 src -n

.PHONY: sniff-tests
sniff-tests: vendor/autoload.php
	vendor/bin/phpcs --standard=PSR2 tests -n

.PHONY: fix
fix: vendor/autoload.php
	vendor/bin/phpcbf --standard=PSR2 src -n

.PHONY: fix-tests
fix-tests: vendor/autoload.php
	vendor/bin/phpcbf --standard=PSR2 tests -n

.PHONY: test
test: vendor/autoload.php
	vendor/bin/phpunit --verbose --bootstrap=src/Format.php tests/