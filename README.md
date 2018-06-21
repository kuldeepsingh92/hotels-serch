How to setup

>git clone https://github.com/kuldeepsingh92/hotels-serch.git project-name
>cd project-name
>composer install

you will be asked to add database detils (you need to create empty database manually)

after this run following command to generate entity in database

>php bin/console doctrine:schema:update --force

cheers :) setup is complete

#to add a property visit below link (currently no login required)
http://localhost/project-name/web/admin/property/

#to search hotels or location visit below link
http://localhost/project-name/web/
