# users

## ddl

```
create table users
(
    id         int unsigned primary key not null auto_increment,
    first_name varchar(255) not null,
    last_name  varchar(255) not null
);
```

## sample data

```
insert into users (first_name, last_name) values ('Human', 'Ordinary');
```
