FROM nginx:1.15.5

RUN apt-get update -yq
RUN apt-get install -y wget apt-transport-https lsb-release ca-certificates
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list
RUN apt-get update -yq && apt-get install -yq \
    php7.2 \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libmcrypt-dev \
    apache2-bin \
    curl \
    git \
    vim \
    libxml2-dev \
    libicu-dev \
    elinks \
    openssh-server \
    unzip

RUN apt-get install php7.2-cli php7.2-common php7.2-curl php7.2-gd php7.2-json php7.2-mbstring php7.2-mysql php7.2-opcache php7.2-readline php7.2-xml -yq

