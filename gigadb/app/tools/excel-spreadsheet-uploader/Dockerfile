FROM openjdk:8

RUN apt-get update -yq && \
    apt-get install -y --no-install-recommends \
        libreoffice \
        libarchive-tools && \
        apt-get clean

VOLUME ["/tool"]
WORKDIR /tool
