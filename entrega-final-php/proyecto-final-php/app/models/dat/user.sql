CREATE TABLE Users (
    id INT(20) AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    password CHAR(60) NOT NULL,
    role INT NOT NULL CHECK (role IN (0, 1))
);

INSERT INTO Users (login, password, role) VALUES 
('pepe1', '$2y$10$cnXDAetYsGKMBjYz51KUF.9wvsgvzsSwZviJA5JnbOBg4H0CYl4YG', 1),  -- passwd 'pepe'
('anana', '$2y$10$KYpVAiKP2sQUv6w1n.hnlu2FTML7wVJ87/ZFOCmISQdwvR11ZqUZW', 0),  -- passwd 'ana1'
('joseprofe', '$2y$10$o1Mbs4HUa7kFGmn2fnaUYuXDrAzHmTBP7Nd5I7eXypwCKbbQXab66', 0);  -- passwd '123456'


