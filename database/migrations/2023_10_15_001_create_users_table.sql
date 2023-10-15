CREATE table users
(
    id         BIGINT UNSIGNED     NOT NULL AUTO_INCREMENT,
    name       varchar(255)        NOT NULL,
    phone      varchar(255),
    email      varchar(255) Unique NOT NULL,
    `password` varchar(255)        NOT NULL,
    PRIMARY KEY (id)
);