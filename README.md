To run this project:


    git clone https://github.com/szymonczopek/symfony-restapi.git

    cd symfony-restapi

    cd .docker

    docker-compose up -d

    docker exec -it php bash

    composer install

    php bin/console get-posts

    php bin/console doctrine:migrations:migrate

Once the server is running, the application will be accessible at http://localhost:80