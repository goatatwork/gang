FROM node:13-alpine

LABEL maintainer="goat <ryantgray@gmail.com>"

RUN apk add --update --no-cache bash \
    && apk add --update --no-cache -t .build-deps python make g++ gcc git yarn \
    && apk del .build-deps \
    && npm i -g laravel-echo-server

WORKDIR /var/www/html

EXPOSE "6001"

ENTRYPOINT ["laravel-echo-server"]
CMD ["start"]
