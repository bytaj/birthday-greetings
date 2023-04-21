#!/bin/bash
docker build . -t localhost:32000/birthday-greetings-kata
docker push localhost:32000/birthday-greetings-kata

# mailhog
helm upgrade --install birthday-greetings-kata kubernetes --set path=$PWD