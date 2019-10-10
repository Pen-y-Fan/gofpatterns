# GoFPatterns

## Introduction

This project is based on the The GoF patterns course website, it is separated into modules for each subject:

- [Design Patterns](https://www.gofpatterns.com/design-patterns/module1/intro-design-patterns.php) - module 1
- [Defining Patterns](https://www.gofpatterns.com/design-patterns/module2/intro-defining-design-patterns.php) - module 2
- [Singleton Patterns](https://www.gofpatterns.com/design-patterns/module3/intro-singleton-design-pattern.php) - module 3
- [Creational Patterns](https://www.gofpatterns.com/design-patterns/module4/intro-creational-patterns.php) - module 4
- [Structural Patterns](https://www.gofpatterns.com/design-patterns/module5/intro-structural-designPatterns.php) - module 5
- [Behavioral Patterns](https://www.gofpatterns.com/design-patterns/module6/intro-behavioral-designPatterns.php) - module 6
- [Designing Software](https://www.gofpatterns.com/design-patterns/module7/intro-designPattern-softwareDesign.php) - module 7

The purpose of this project is to compliment the GoFPatterns website, while working through the course. The GoFPatterns site provided code in Java and C#, whenever possible the code from the website has been re-written into PHP

Each module has a separated namespace within the App folder. Each course project (design pattern) is tested using PHPUnit.

The website's core course material has note been copied, only an explanation of the project, which is a mark down file in the same module as the course project.

## Installation

This is a personal project, however if anyone is interested in learning about design patterns in PHP, this project can be cloned as follows:

T&D method:

1\. Clone the project using git:

```sh
md gofpatterns
cd gofpatterns
git clone https://github.com/pen-y-fan/gofpatterns
```

2\. Install with composer:

```sh
composer install
```

3\. Test:

Windows:

```sh
composer test
```

Mac/Linux:

```sh
./vendor/bin/phpunit
```

### Requirements

- PHP 7.2 or higher
- Composer
- git (optional but recommended)

### 1. Clone the project

See [Cloning a repository](https://help.github.com/en/articles/cloning-a-repository) for details on how to create a local copy on your computer.

### 2. Install dependencies

The project uses PHPUnit for tests, which has a requirement for PHP 7.2 or higher.

Once the project has been cloned, change directory to the project folder (normally gofpatterns or gofpatterns-master) and run composer install

```sh
cd gofpatterns
composer install
```

### 3. Testing

PHPUnit is used to run tests, from the root of the project, run:

**Windows OS**:

```sh
composer test
```

**Mac or Linux OS**:

```sh
./vendor/bin/phpunit
```

## Errors and Omissions (E&O)

As I am learning patterns and programming there may be some errors and omissions. Feel free to post details of any

## Licence

MIT
