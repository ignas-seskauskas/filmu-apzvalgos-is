CREATE TABLE `kanalas` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(50) NOT NULL,
  `aprasymas` text NOT NULL,
  `max_vartotojai` int(11) NOT NULL,
  `sukurimo_laikas` datetime NOT NULL,
  `paskutinio_aktyvumo_laikas` datetime NOT NULL,
  `kurejas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `uzblokavimas`
--

CREATE TABLE `uzblokavimas` (
  `trukme_min` int(11) NOT NULL,
  `nuo_kada` datetime NOT NULL,
  `blokuotojas` int(11) NOT NULL,
  `blokuojamasis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vartotojas`
--

CREATE TABLE `vartotojas` (
  `id` int(11) NOT NULL,
  `vardas` varchar(50) NOT NULL,
  `pavarde` varchar(50) NOT NULL,
  `epastas` varchar(100) NOT NULL,
  `slaptazodis` varchar(128) NOT NULL,
  `slapyvardis` varchar(50) NOT NULL,
  `tipas` enum('Moderatorius','Kritikas','Paprastas') NOT NULL,
  `uzsiregistravimo_data` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `paskutinio_apsilankymo_laikas` datetime NOT NULL,
  `nuotraukos_nuoroda` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zinute`
--

CREATE TABLE `zinute` (
  `id` int(11) NOT NULL,
  `issiuntimo_laikas` datetime NOT NULL,
  `tekstas` text NOT NULL,
  `kanalas` int(11) NOT NULL,
  `siuntejas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kanalas`
--
ALTER TABLE `kanalas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_KANALAS_KUREJAS` (`kurejas`);

--
-- Indexes for table `uzblokavimas`
--
ALTER TABLE `uzblokavimas`
  ADD PRIMARY KEY (`blokuotojas`,`blokuojamasis`),
  ADD KEY `FK_UZBLOKAVIMAS_BLOKUOJAMASIS` (`blokuojamasis`);

--
-- Indexes for table `vartotojas`
--
ALTER TABLE `vartotojas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zinute`
--
ALTER TABLE `zinute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ZINUTE_SIUNTEJAS` (`siuntejas`),
  ADD KEY `FK_ZINUTE_KANALAS` (`kanalas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kanalas`
--
ALTER TABLE `kanalas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vartotojas`
--
ALTER TABLE `vartotojas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zinute`
--
ALTER TABLE `zinute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kanalas`
--
ALTER TABLE `kanalas`
  ADD CONSTRAINT `FK_KANALAS_KUREJAS` FOREIGN KEY (`kurejas`) REFERENCES `vartotojas` (`id`);

--
-- Constraints for table `uzblokavimas`
--
ALTER TABLE `uzblokavimas`
  ADD CONSTRAINT `FK_UZBLOKAVIMAS_BLOKUOJAMASIS` FOREIGN KEY (`blokuojamasis`) REFERENCES `vartotojas` (`id`),
  ADD CONSTRAINT `FK_UZBLOKAVIMAS_BLOKUOTOJAS` FOREIGN KEY (`blokuotojas`) REFERENCES `vartotojas` (`id`);

--
-- Constraints for table `zinute`
--
ALTER TABLE `zinute`
  ADD CONSTRAINT `FK_ZINUTE_KANALAS` FOREIGN KEY (`kanalas`) REFERENCES `kanalas` (`id`),
  ADD CONSTRAINT `FK_ZINUTE_SIUNTEJAS` FOREIGN KEY (`siuntejas`) REFERENCES `vartotojas` (`id`);
COMMIT;