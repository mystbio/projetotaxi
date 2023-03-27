CREATE TABLE `tbCorridas` (
    `codcorrida` int(11) NOT NULL,
    `codtipo` int(11) NOT NULL,
    `coduser` int(11) NOT NULL,
    `datahora` datetime NOT NULL,
    `kmini` decimal(18,4) NOT NULL,
    `kmfim` decimal(18,4) NOT NULL,
    `valor` decimal(18,2) NOT NULL,
    `descricao` varchar(50) NOT NULL,
    PRIMARY KEY (`codcorrida`),
    FOREIGN KEY (`codtipo`) REFERENCES `tbTipoPGTO` (`codtipo`),
    FOREIGN KEY (`coduser`) REFERENCES `tbUser` (`coduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela de Corridas';