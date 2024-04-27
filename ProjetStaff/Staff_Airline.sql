
CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_id` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `Users` (`user_id`, `username`, `email`, `password`, `admin_id`, `created_at`) VALUES
(1, 'Walid', 'maadi_walid@yahoo.fr', '$2y$10$rkd.Q3pP3aFe3Kx/ac0XNuh/wqr9c3Br2ooC7lO0qlH.TNScCKbCW', 1, '2024-04-26 11:16:25');


ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);


ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;


