# Sources
https://www.section.io/engineering-education/dockerized-php-apache-and-mysql-container-development-environment/

https://www.pascallandau.com/blog/docker-from-scratch-for-php-applications-in-2022/

http://blog.adnansiddiqi.me/create-your-first-php-mysql-application-in-docker/

https://dockerlabs.collabnix.com/

https://medium.com/@chrischuck35/how-to-create-a-mysql-instance-with-docker-compose-1598f3cc1bee

https://gist.github.com/jcavat/2ed51c6371b9b488d6a940ba1049189b

```
docker-compose up --build -d
docker compose up -d
docker-compose down

docker exec -it c-001-db  bash -l
docker exec -it db bash -l
docker exec -it docker_db_1 bash -l
```

# Troubleshooting

## 1. Permission denied while docker stop or kill

```
ERROR: for yattyadocker_web_1  cannot stop container: ... permission denied
```

```
sudo aa-remove-unknown
```
