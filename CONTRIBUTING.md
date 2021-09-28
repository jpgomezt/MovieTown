## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.
For contributing, the project uses a strategy based on a [forking workflow.](https://www.atlassian.com/git/tutorials/comparing-workflows/forking-workflow)

Here you can check out a full list of steps for you to contribute to this project: [GitHub Forking Workflow](https://gist.github.com/Chaser324/ce0505fbed06b947d962)

Before opening any **Pull Request** you must use the projects linters to check and apply the project style guide.
When you installed the dependencies with `composer install` both [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) and [TLINT](https://github.com/tighten/tlint) where installed in your `vendor` folder. You can run this linters by running:

```sh
vendor/squizlabs/php_codesniffer/bin/phpcs
```

```sh
vendor/tightenco/tlint/bin/tlint
```

or you can install them globally in your machine by running:

```sh
composer global require "squizlabs/php_codesniffer=*"
```

```sh
composer global require tightenco/tlint
```
