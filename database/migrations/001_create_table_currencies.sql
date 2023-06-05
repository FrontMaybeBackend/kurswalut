CREATE TABLE `kurs_walut` (
    `id` int(11) NOT NULL,
    `table_name` varchar(10) NOT NULL,
    `effective_date` date NOT NULL,
    `currency` varchar(100) NOT NULL,
    `code` varchar(10) NOT NULL,
    `rate` decimal(10,2) NOT NULL
)

