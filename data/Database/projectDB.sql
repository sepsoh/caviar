CREATE DATABASE khepri_db;

CREATE DATABASE User;

USE User;

CREATE TABLE userInformation(
    email varchar(256),
    password varchar(256),
    name varchar(256),
    date date
);

CREATE TABLE purchases(
    email varchar(256),
    stockID varchar(256),
    signalID varchar(256)
);

CREATE TABLE stocks(
    email varchar(256),
    stockID varchar(256)
);


USE khepri_db;