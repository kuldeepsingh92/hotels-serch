How to setup

>git clone https://github.com/kuldeepsingh92/hotels-serch.git project-name<br/>
>cd project-name<br/>
>composer install<br/>
<br/>
you will be asked to add database detils (you need to create empty database manually)<br/>
<br/>
after this run following command to generate entity in database<br/>
<br/>
>php bin/console doctrine:schema:update --force<br/>
<br/>
cheers :) setup is complete<br/>
<br/>
#to add a property visit below link (currently no login required)<br/>
http://localhost/project-name/web/admin/property/<br/>
<br/>
#to search hotels or location visit below link<br/>
http://localhost/project-name/web/<br/>
