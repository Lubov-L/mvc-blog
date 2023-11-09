CREATE TABLE news
(
    id               INT AUTO_INCREMENT PRIMARY KEY,
    title            VARCHAR(255) NOT NULL,
    content          TEXT         NOT NULL,
    publication_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);