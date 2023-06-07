CREATE TABLE `converted_currencies` (
                                        `id` int(11) PRIMARY KEY AUTO_INCREMENT,
                                        `initial_value` int(10) NOT NULL,
                                        `source_currencies` varchar(10) NOT NULL,
                                        `rate_kurs` varchar(10) NOT NULL,
                                        `converted_amount` decimal(10,2) NOT NULL,
                                        `currencies_id` int NOT NULL
);