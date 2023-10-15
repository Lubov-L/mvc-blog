CREATE TABLE IF NOT EXISTS users
(
    id         BIGINT UNSIGNED     NOT NULL AUTO_INCREMENT,
    name       VARCHAR(255)        NOT NULL,
    phone      VARCHAR(255),
    email      VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255)        NOT NULL,
    PRIMARY KEY (id)
);