## setup project
- cloning repo
- run command cp `cp .env.example .env`
- if you have php v8 run commmand `composer install` or run this command
`docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs`
- run `./vendor/bin/sail up` to build containers
- run command touch database/database.sqlite
- go to localhost to run application