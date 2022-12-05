--
-- Database: `imdb_copy`
--

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `max_users` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `last_active_time` datetime NOT NULL,
  `creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`id`, `name`, `description`, `max_users`, `create_time`, `last_active_time`, `creator`) VALUES
(1, 'Test kanalas2', 'asd', 3, '2022-12-05 21:32:28', '2022-12-05 21:32:28', 2),
(3, 'Test', 'Test', 5, '2022-12-06 00:04:33', '2022-12-06 00:04:33', 2);

-- --------------------------------------------------------

--
-- Table structure for table `channel_blocking`
--

CREATE TABLE `channel_blocking` (
  `length_min` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `user_blocker` int(11) NOT NULL,
  `user_blocked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `channel_message`
--

CREATE TABLE `channel_message` (
  `id` int(11) NOT NULL,
  `send_time` datetime NOT NULL,
  `text` text NOT NULL,
  `channel` int(11) NOT NULL,
  `sender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `username` varchar(50) NOT NULL,
  `type` enum('Moderator','Critic','Default') NOT NULL,
  `register_time` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `last_visit_time` datetime NOT NULL,
  `avatar_src` varchar(300) NOT NULL,
  `channel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `password`, `username`, `type`, `register_time`, `ip`, `last_visit_time`, `avatar_src`, `channel`) VALUES
(2, 'Test', 'Test', 'test@emasis.com', 'a336f671080fbf4f2a230f313560ddf0d0c12dfcf1741e49e8722a234673037dc493caa8d291d8025f71089d63cea809cc8ae53e5b17054806837dbe4099c4ca', 'test', 'Moderator', '2022-12-05 21:31:25', '158.129.18.80', '2022-12-05 21:31:25', 'https://gif-avatars.com/img/200x200/gif-1-1.gif', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CHANNEL_CREATOR` (`creator`);

--
-- Indexes for table `channel_blocking`
--
ALTER TABLE `channel_blocking`
  ADD PRIMARY KEY (`user_blocker`,`user_blocked`),
  ADD KEY `FK_BLOCKING_BLOCKED` (`user_blocked`);

--
-- Indexes for table `channel_message`
--
ALTER TABLE `channel_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CMESSAGE_CHANNEL` (`channel`),
  ADD KEY `FK_CMESSAGE_SENDER` (`sender`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USER_CHANNEL` (`channel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `channel_message`
--
ALTER TABLE `channel_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `channel`
--
ALTER TABLE `channel`
  ADD CONSTRAINT `FK_CHANNEL_CREATOR` FOREIGN KEY (`creator`) REFERENCES `user` (`id`);

--
-- Constraints for table `channel_blocking`
--
ALTER TABLE `channel_blocking`
  ADD CONSTRAINT `FK_BLOCKING_BLOCKED` FOREIGN KEY (`user_blocked`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_BLOCKING_BLOCKER` FOREIGN KEY (`user_blocker`) REFERENCES `user` (`id`);

--
-- Constraints for table `channel_message`
--
ALTER TABLE `channel_message`
  ADD CONSTRAINT `FK_CMESSAGE_CHANNEL` FOREIGN KEY (`channel`) REFERENCES `channel` (`id`),
  ADD CONSTRAINT `FK_CMESSAGE_SENDER` FOREIGN KEY (`sender`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_USER_CHANNEL` FOREIGN KEY (`channel`) REFERENCES `channel` (`id`);
COMMIT;