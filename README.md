# 📡 Calendapp Api

## 🧪 Testing

We have two test suits: one for unit testing and another to feature test with datebase integration and no mocks. You can run each testsuite together or isolated with:

```bash
# PHP Unit suits or all
vendor/bin/phpunit --testsuite Unit
vendor/bin/phpunit --testsuite Integration
vendor/bin/phpunit

# Behat feature tests
vendor/bin/behat
```

### Find possible errors
You can use PHP Stan to check to find possible errors in you code without actually running it. It's move PHP closer to a compiled language so you can avoid some errors without throwing them. To run PHPStan you just need to `vendor/bin/phpstan analyse -c phpstan.neon`.

### Coding style
Also you can check you codding style usign PHP Fixer to check if you have something wrong. With `vendor/bin/php-cs-fixer fix --dry-run --diff --config .php_cs.php` you can see a diff without making any change.

To fix all files automatically you must use `vendor/bin/php-cs-fixer fix --config .php_cs.php`.
