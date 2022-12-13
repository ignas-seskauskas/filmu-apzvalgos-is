#@(#) script.ddl

DROP TABLE IF EXISTS Zinute;
DROP TABLE IF EXISTS Komentaro_ivertinimas;
DROP TABLE IF EXISTS Uzblokavimas;
DROP TABLE IF EXISTS Komentaras;
DROP TABLE IF EXISTS Kanalas;
DROP TABLE IF EXISTS Filmu_sarasas;
DROP TABLE IF EXISTS vaidina;
DROP TABLE IF EXISTS Vartotojas;
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

CREATE TABLE Vartotojas
(
	vardas varchar (255) NOT NULL,
	pavarde varchar (255) NOT NULL,
	epastas varchar (255) NOT NULL,
	slaptazodis varchar (255) NOT NULL,
	slapyvardis varchar (255) NOT NULL,
	uzsiregistravimo_data date NOT NULL,
	ip varchar (255) NOT NULL,
	paskutinio_apsilankymo_laikas date NOT NULL,
	nuotraukos_nuoroda varchar (255) NOT NULL,
	tipas enum('moderatorius', 'kritikas', 'paprastas') NOT NULL,
	id_Vartotojas int NOT NULL,
	PRIMARY KEY(id_Vartotojas)
);

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
	fk_Vartotojasid_Vartotojas int NOT NULL,
	PRIMARY KEY(id_Filmu_sarasas),
	CONSTRAINT priskiriamas FOREIGN KEY(fk_Filmasid_Filmas) REFERENCES Filmas (id_Filmas),
	CONSTRAINT turi_filma FOREIGN KEY(fk_Vartotojasid_Vartotojas) REFERENCES Vartotojas (id_Vartotojas)
);

CREATE TABLE Kanalas
(
	pavadinimas varchar (255) NOT NULL,
	aprasymas varchar (255) NOT NULL,
	max_prisijungusiu_vartotoju int NOT NULL,
	sukurimo_laikas date NOT NULL,
	paskutinio_aktyvumo_laikas date NOT NULL,
	prisijunge_vartotojai int NOT NULL,
	id_Kanalas int NOT NULL,
	fk_Vartotojasid_Vartotojas int NOT NULL,
	PRIMARY KEY(id_Kanalas),
	CONSTRAINT sukuria FOREIGN KEY(fk_Vartotojasid_Vartotojas) REFERENCES Vartotojas (id_Vartotojas)
);

CREATE TABLE Komentaras
(
	vartotojo_vardas varchar (255) NOT NULL,
	tekstas varchar (255) NOT NULL,
	data date NOT NULL,
	reitingas int NOT NULL,
	antraste varchar (255) NOT NULL,
	id_Komentaras int NOT NULL,
	fk_Filmasid_Filmas int NOT NULL,
	fk_Vartotojasid_Vartotojas int NOT NULL,
	PRIMARY KEY(id_Komentaras),
	CONSTRAINT turi_komentara FOREIGN KEY(fk_Filmasid_Filmas) REFERENCES Filmas (id_Filmas),
	CONSTRAINT raso FOREIGN KEY(fk_Vartotojasid_Vartotojas) REFERENCES Vartotojas (id_Vartotojas)
);

CREATE TABLE Uzblokavimas
(
	trukme int NOT NULL,
	data date NOT NULL,
	id_Uzblokavimas int NOT NULL,
	fk_Vartotojasid_Vartotojas int NOT NULL,
	fk_Vartotojasid_Vartotojas1 int NOT NULL,
	PRIMARY KEY(id_Uzblokavimas),
	CONSTRAINT blokuoja FOREIGN KEY(fk_Vartotojasid_Vartotojas) REFERENCES Vartotojas (id_Vartotojas),
	CONSTRAINT yra_blokuojamas FOREIGN KEY(fk_Vartotojasid_Vartotojas1) REFERENCES Vartotojas (id_Vartotojas)
);

CREATE TABLE Komentaro_ivertinimas
(
	patiko boolean NOT NULL,
	id_Komentaro_ivertinimas int NOT NULL,
	fk_Komentarasid_Komentaras int NOT NULL,
	fk_Vartotojasid_Vartotojas int NOT NULL,
	PRIMARY KEY(id_Komentaro_ivertinimas),
	CONSTRAINT turi_ivertinima FOREIGN KEY(fk_Komentarasid_Komentaras) REFERENCES Komentaras (id_Komentaras)
);

CREATE TABLE Zinute
(
	issiuntimo_laikas date NOT NULL,
	tekstas varchar (255) NOT NULL,
	id_Zinute int NOT NULL,
	fk_Kanalasid_Kanalas int NOT NULL,
	fk_Vartotojasid_Vartotojas int NOT NULL,
	PRIMARY KEY(id_Zinute),
	CONSTRAINT turi_zinute FOREIGN KEY(fk_Kanalasid_Kanalas) REFERENCES Kanalas (id_Kanalas),
	CONSTRAINT siuncia FOREIGN KEY(fk_Vartotojasid_Vartotojas) REFERENCES Vartotojas (id_Vartotojas)
);
