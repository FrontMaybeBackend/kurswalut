CREATE TABLE `converted_currencies` (
                          `id` int(11) NOT NULL,
                          `initial_value` int(10) NOT NULL,
                          `source_currencies` varchar(10) NOT NULL,
                          `target_currencies` varchar(10) NOT NULL,
                          `converted_amount` decimal(10.2) NOT NULL
)
