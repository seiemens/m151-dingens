create database schohol;
use schohol;
create table shorturls
(
    url_short varchar(16) primary key not null,
    url_long text not null,
    hits int default 0,
    date_added datetime default now()
)