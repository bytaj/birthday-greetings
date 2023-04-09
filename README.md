# Birthday Greetings kata in PHP fully dockerized

This is a simple refactoring exercise that is meant to teach something about dependency inversion and dependency injection.

This is the initial code for this kata written in PHP.

The documentation: http://matteo.vaccari.name/blog/archives/154

The video playlist of the original conference: https://www.youtube.com/watch?v=hHbDkrM_jGg&list=PLKZb1ig-R56J_aIWVC2XuwsJ3laUrsy7q

## How to get started

### Requirements

In order to use this Kata boilerplate you need to have installed Docker and Docker Compose. Also you need to have installed `make` and `git`.

### Run it

```bash
git clone git@github.com:bytaj/birthday-greetings.git
cd birthday-greetings-kata
```

To check that all the tests are passing just execute PHPUnit

```bash
docker-compose up -d
cp phpunit.xml.dist phpunit.xml
make init
make test
```

For the rest running of the tests you can just execute

```bash
make test
```