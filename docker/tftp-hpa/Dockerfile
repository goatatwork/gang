FROM alpine:3.11
LABEL maintainer="goat <ryantgray@gmail.com>"
RUN apk add --no-cache tftp-hpa
VOLUME /tftpboot
EXPOSE 69/udp
ENTRYPOINT ["in.tftpd"]
CMD ["-L", "--secure", "/tftpboot", "--create"]
