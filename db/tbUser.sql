CREATE TABLE `tbUser` (
    `coduser` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `username` varchar(20) NOT NULL,
    `password` varchar(8) NOT NULL,
    `admin` char(1) NULL,
    PRIMARY KEY (`coduser`),
    UNIQUE KEY `idx_tbUser_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela de Usuários';