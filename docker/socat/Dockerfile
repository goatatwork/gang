FROM alpine:3.10

LABEL maintainer="goat <ryantgray@gmail.com>"

RUN apk --update add socat

EXPOSE 2375

ENTRYPOINT ["socat"]

CMD ["TCP4-LISTEN:2375,fork,reuseaddr,fork UNIX-CONNECT:/var/run/docker.sock"]
