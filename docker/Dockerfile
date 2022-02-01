FROM ubuntu:21.04

ARG BUILD_REPO
ARG GITHUB_REPOSITORY
ARG GIT_FOLDER=/var/www/html

LABEL maintainer="Laravel App"
LABEL org.opencontainers.image.source="https://github.com/${GITHUB_REPOSITORY}"

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update
RUN apt-get install -y php7.4 php7.4-fpm php7.4-mysql php7.4-mbstring php7.4-xml php7.4-bcmath
RUN apt-get update
RUN apt-get install -y gosu curl ca-certificates zip unzip git supervisor sqlite3 libcap2-bin libpng-dev python2

WORKDIR ${GIT_FOLDER}

#RUN git clone https://github.com/einsteinersnet/einsteiners.net.git ./
COPY . ${GIT_FOLDER}
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer update
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

#RUN cp .env.example .env
RUN mkdir config_env && cp .env.example config_env/.env && ln -s config_env/.env
RUN php artisan storage:link
RUN php artisan key:generate

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
