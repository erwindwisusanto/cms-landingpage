<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

### CMS Landing Page


``` docker run --name my-postgres -e POSTGRES_USER=myuser -e POSTGRES_PASSWORD=mypassword -e POSTGRES_DB=mydatabase -p 5432:5432 -d postgres:12.19-alpine ```

```sql -h localhost -p 8080 -U myuser -d mydatabase```

```\d```


``` docker run --name my-mysql -e MYSQL_ROOT_PASSWORD=rootpassword -e MYSQL_DATABASE=laravel -e MYSQL_USER=laraveluser -e MYSQL_PASSWORD=secret -p 3306:3306 -d mysql:8.4.0 ```


``` mysql -u root -p ```

``` ALTER USER 'laraveluser'@'%' IDENTIFIED WITH mysql_native_password BY 'secret'; ```
