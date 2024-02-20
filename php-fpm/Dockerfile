FROM phpdockerio/php80-fpm:latest

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install php8.0-cli php8.0-pgsql php8.0-intl php8.0-mbstring php8.0-sqlite3 git golang\
    && apt-get -y install php8.0-redis\
    && phpenmod redis\
    && service php8.0-fpm restart\
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*\
    && export GOPATH="$HOME/go" \
    && go get github.com/mailhog/mhsendmail && cp ~/go/bin/mhsendmail /usr/local/bin/mhsendmail



WORKDIR "/var/www/localhost"
