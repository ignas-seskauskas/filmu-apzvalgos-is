#@(#) script.ddl

DROP TABLE IF EXISTS channel_message;
DROP TABLE IF EXISTS Komentaro_ivertinimas;
DROP TABLE IF EXISTS channel_blocking;
DROP TABLE IF EXISTS Komentaras;
DROP TABLE IF EXISTS channel;
DROP TABLE IF EXISTS Filmu_sarasas;
DROP TABLE IF EXISTS vaidina;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS Filmo_zanras;
DROP TABLE IF EXISTS vartotojo_tipas;
DROP TABLE IF EXISTS Saitai_iki_nuotrauku;
DROP TABLE IF EXISTS IP_blacklist;
DROP TABLE IF EXISTS Filmas;
DROP TABLE IF EXISTS Dizaino_tema;
DROP TABLE IF EXISTS Apsilankymas;
DROP TABLE IF EXISTS Aktorius;
CREATE TABLE Aktorius
(
	vardas varchar (255) NOT NULL,
	pavarde varchar (255) NOT NULL,
	gimimo_metai int NOT NULL,
	id_Aktorius int NOT NULL,
	PRIMARY KEY(id_Aktorius)
);

CREATE TABLE Apsilankymas
(
	ip varchar (255) NOT NULL,
	data date NOT NULL,
	id_Apsilankymas int NOT NULL,
	PRIMARY KEY(id_Apsilankymas)
);

CREATE TABLE Dizaino_tema
(
	fono_spalva varchar (255) NOT NULL,
	teksto_spalva varchar (255) NOT NULL,
	antrastes_spalva varchar (255) NOT NULL,
	porastes_spalva varchar (255) NOT NULL,
	pagrindine_spalva varchar (255) NOT NULL,
	antraeile_spalva varchar (255) NOT NULL,
	pavadinimas varchar (255) NOT NULL,
	srifto_dydis int NOT NULL,
	sekmes_spalva varchar (255) NOT NULL,
	klaidos_spalva varchar (255) NOT NULL,
	id_Dizaino_tema int NOT NULL,
	PRIMARY KEY(id_Dizaino_tema)
);

CREATE TABLE Filmas
(
	pavadinimas varchar (255) NOT NULL,
	metai int NOT NULL,
	rezisierius varchar (255) NOT NULL,
	trukme int NOT NULL,
	siuzetas varchar (255) NOT NULL,
	rasytojas varchar (255) NOT NULL,
	ivertinimas int NOT NULL,
	id_Filmas int NOT NULL,
	PRIMARY KEY(id_Filmas)
);

CREATE TABLE IP_blacklist
(
	IP_adresas varchar (255) NOT NULL,
	uzblokavimo_laikas datetime NOT NULL,
	id_IP_blacklist int NOT NULL,
	PRIMARY KEY(id_IP_blacklist)
);

CREATE TABLE Saitai_iki_nuotrauku
(
	pavadinimas varchar (255) NOT NULL,
	saitas varchar (255) NOT NULL,
	id_Saitai_iki_nuotrauku int NOT NULL,
	PRIMARY KEY(id_Saitai_iki_nuotrauku)
);

CREATE TABLE Filmo_zanras
(
	zanras enum('Siaubo', 'Veiksmo', 'Komedija', 'Romantinis', 'Dokumentika', 'Detektyvinis') NOT NULL,
	id_Filmo_zanras int NOT NULL,
	fk_Filmasid_Filmas int NOT NULL,
	PRIMARY KEY(id_Filmo_zanras),
	CONSTRAINT yra FOREIGN KEY(fk_Filmasid_Filmas) REFERENCES Filmas (id_Filmas)
);

CREATE TABLE user
(
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
);
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USER_CHANNEL` (`channel`);
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

CREATE TABLE vaidina
(
	fk_Aktoriusid_Aktorius int NOT NULL,
	fk_Filmasid_Filmas int NOT NULL,
	PRIMARY KEY(fk_Aktoriusid_Aktorius, fk_Filmasid_Filmas),
	CONSTRAINT vaidina FOREIGN KEY(fk_Aktoriusid_Aktorius) REFERENCES Aktorius (id_Aktorius)
);

CREATE TABLE Filmu_sarasas
(
	filmu_kiekis int NOT NULL,
	perziuretas boolean NOT NULL,
	ivertintas boolean NOT NULL,
	id_Filmu_sarasas int NOT NULL,
	fk_Filmasid_Filmas int NOT NULL,
	fk_userid int NOT NULL,
	PRIMARY KEY(id_Filmu_sarasas),
	CONSTRAINT priskiriamas FOREIGN KEY(fk_Filmasid_Filmas) REFERENCES Filmas (id_Filmas),
	CONSTRAINT turi_filma FOREIGN KEY(fk_userid) REFERENCES user (id)
);

CREATE TABLE channel
(
	`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `max_users` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `last_active_time` datetime NOT NULL,
  `creator` int(11) NOT NULL
);
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CHANNEL_CREATOR` (`creator`);
ALTER TABLE `channel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

CREATE TABLE Komentaras
(
	vartotojo_vardas varchar (255) NOT NULL,
	tekstas varchar (255) NOT NULL,
	data date NOT NULL,
	reitingas int NOT NULL,
	antraste varchar (255) NOT NULL,
	id_Komentaras int NOT NULL,
	fk_Filmasid_Filmas int NOT NULL,
	fk_userid int NOT NULL,
	PRIMARY KEY(id_Komentaras),
	CONSTRAINT turi_komentara FOREIGN KEY(fk_Filmasid_Filmas) REFERENCES Filmas (id_Filmas),
	CONSTRAINT raso FOREIGN KEY(fk_userid) REFERENCES user (id)
);

CREATE TABLE channel_blocking
(
	`length_min` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `user_blocker` int(11) NOT NULL,
  `user_blocked` int(11) NOT NULL
);

ALTER TABLE `channel_blocking`
  ADD PRIMARY KEY (`user_blocker`,`user_blocked`),
  ADD KEY `FK_BLOCKING_BLOCKED` (`user_blocked`);

CREATE TABLE Komentaro_ivertinimas
(
	patiko boolean NOT NULL,
	id_Komentaro_ivertinimas int NOT NULL,
	fk_Komentarasid_Komentaras int NOT NULL,
	fk_userid int NOT NULL,
	PRIMARY KEY(id_Komentaro_ivertinimas),
	CONSTRAINT turi_ivertinima FOREIGN KEY(fk_Komentarasid_Komentaras) REFERENCES Komentaras (id_Komentaras)
);

CREATE TABLE channel_message
(
	`id` int(11) NOT NULL,
  `send_time` datetime NOT NULL,
  `text` text NOT NULL,
  `channel` int(11) NOT NULL,
  `sender` int(11) NOT NULL
);
ALTER TABLE `channel_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CMESSAGE_CHANNEL` (`channel`),
  ADD KEY `FK_CMESSAGE_SENDER` (`sender`);
ALTER TABLE `channel_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `channel`
  ADD CONSTRAINT `FK_CHANNEL_CREATOR` FOREIGN KEY (`creator`) REFERENCES `user` (`id`);

ALTER TABLE `channel_blocking`
  ADD CONSTRAINT `FK_BLOCKING_BLOCKED` FOREIGN KEY (`user_blocked`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_BLOCKING_BLOCKER` FOREIGN KEY (`user_blocker`) REFERENCES `user` (`id`);

ALTER TABLE `channel_message`
  ADD CONSTRAINT `FK_CMESSAGE_CHANNEL` FOREIGN KEY (`channel`) REFERENCES `channel` (`id`),
  ADD CONSTRAINT `FK_CMESSAGE_SENDER` FOREIGN KEY (`sender`) REFERENCES `user` (`id`);

ALTER TABLE `user`
  ADD CONSTRAINT `FK_USER_CHANNEL` FOREIGN KEY (`channel`) REFERENCES `channel` (`id`);

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `password`, `username`, `type`, `register_time`, `ip`, `last_visit_time`, `avatar_src`, `channel`) VALUES
(3, 'Admin', 'Admin', 'admin@admin.com', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', 'admin', 'Moderator', '2022-12-13 21:02:40', '111.111.111.111', '2022-12-13 21:02:40', 'https://i.gifer.com/origin/f8/f8903ad1904347df9561656bcfa8918e.gif', NULL);

INSERT INTO `channel` (`id`, `name`, `description`, `max_users`, `create_time`, `last_active_time`, `creator`) VALUES
(4, 'Test', 'Test', 3, '2022-12-13 22:14:54', '2022-12-13 22:14:54', 3),
(5, 'Test2', 'asd', 5, '2022-12-13 22:21:26', '2022-12-13 22:21:26', 3);
