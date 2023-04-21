# Birthday Greetings kata in PHP fully dockerized and kubernetes ready

This is a simple refactoring exercise that is meant to teach something about dependency inversion and dependency injection.

This is the initial code for this kata written in PHP.

The documentation: http://matteo.vaccari.name/blog/archives/154

The video playlist of the original conference: https://www.youtube.com/watch?v=hHbDkrM_jGg&list=PLKZb1ig-R56J_aIWVC2XuwsJ3laUrsy7q

## How to get started

### Requirements

In order to use this Kata boilerplate you need to have installed Docker. Also you need to have installed `make` and `git`.

The kata is ready to run in Docker compose and Kubernetes. You don't need to have both, just one of them. You'll need to run a copy the Makefile you need depending of witch one you have installed.


### Run it

```bash
git clone git@github.com:bytaj/birthday-greetings.git
cd birthday-greetings-kata
```

#### Docker compose

```bash
cp Makefile.docker-compose.dist Makefile
docker-compose up -d
make init
```

#### Kubernetes

That should be executed in the root of the project.

```bash
cp Makefile.kubernetes.dist Makefile
./kubernetes/deploy.sh
make init
```

To check that all the tests are passing just execute PHPUnit

```bash
make test
```


### When you finish

For Kubernetes, you can delete the deployment with:

```bash
helm uninstall birthday-greetings-kata
```