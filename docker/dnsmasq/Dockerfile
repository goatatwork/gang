FROM ubuntu:18.04

RUN export DEBIAN_FRONTEND=noninteractive \
    && apt-get update \
    && apt-get install -y git curl zip unzip dhcpdump dhcping software-properties-common iputils-ping nano tzdata build-essential \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    && rm -rf /etc/localtime \
    && ln -s /usr/share/zoneinfo/America/Chicago /etc/localtime \
    && dpkg-reconfigure -f noninteractive tzdata

RUN cd /opt \
    && git clone git://thekelleys.org.uk/dnsmasq.git \
    && cd dnsmasq \
    && make \
    && make install

EXPOSE 53 53/udp
EXPOSE 67 67/udp
EXPOSE 69 69/udp

ADD dnsmasq.conf /etc/dnsmasq/dnsmasq.conf

CMD ["dnsmasq", "-k", "--log-facility=-", "--conf-file=/etc/dnsmasq/dnsmasq.conf"]
ENTRYPOINT []
