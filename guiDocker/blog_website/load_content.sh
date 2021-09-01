#!/bin/bash
sudo docker-compose up -d
### import table to mysql
containerid=`sudo -S docker ps -q  --filter ancestor=mysql:5.7`
sudo docker exec -it $containerid bin/bash  -c "mysql -uroot -p <  docker-entrypoint-initdb.d/contentdb.sql"
sudo docker exec -it $containerid mysql -uroot -p -e "use contentdb;LOAD DATA LOCAL INFILE 'docker-entrypoint-initdb.d/blog_content.csv' INTO TABLE posts FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 ROWS (id, user_id,  title, image, body,published,created_at);"


