#use temcorte;

/*
CREATE DATABASE temcorte;

use temcorte;

SET time_zone = '-03:00';
# SELECT NOW();

CREATE TABLE IF NOT EXISTS state(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(10) NOT NULL,
     initials VARCHAR (2) NOT NULL,
     created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     modified DATETIME NULL
);

CREATE TABLE IF NOT EXISTS city(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	 name VARCHAR(25) NOT NULL,
     initials VARCHAR (5) NOT NULL,
     created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     modified DATETIME NULL,
     fk_state INT UNSIGNED NOT NULL,
     FOREIGN KEY (fk_state) REFERENCES state(id)
);

CREATE TABLE IF NOT EXISTS address(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    street VARCHAR (25) NOT NULL,
    neighborhood VARCHAR (15) NOT NULL,
    num VARCHAR(5) NOT NULL,
    cep VARCHAR(8) NOT NULL,
	created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NULL,
    fk_city INT UNSIGNED NOT NULL,
    FOREIGN KEY  (fk_city) REFERENCES city(id)
);

CREATE TABLE IF NOT EXISTS social(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    facebook VARCHAR(15) NOT NULL DEFAULT 'facebook',
    instagram VARCHAR(15) NOT NULL DEFAULT 'instagram',
    whatsapp VARCHAR (14) NOT NULL DEFAULT '+0000000000000',
	created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NULL
);

CREATE TABLE IF NOT EXISTS website(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(25) NOT NULL,
     description VARCHAR(100) NOT NULL,
     email VARCHAR(32) NOT NULL DEFAULT "admin@temcorte.com",
     phone VARCHAR(14) NOT NULL DEFAULT "+0000000000000",
     created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     modified DATETIME NULL,
     fk_address INT UNSIGNED DEFAULT 1,
     fk_social INT UNSIGNED DEFAULT 1,
	FOREIGN KEY  (fk_address) REFERENCES address(id),
    FOREIGN KEY  (fk_social) REFERENCES social(id)
);

CREATE TABLE IF NOT EXISTS user_level(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(15) NOT NULL,
    created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME DEFAULT NULL 
);

CREATE TABLE IF NOT EXISTS user(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(15) NOT NULL,
     surname VARCHAR(15) NOT NULL,
     email VARCHAR(45) NOT NULL,
     cpf VARCHAR(11) NOT NULL,
     password VARCHAR(32) NOT NULL,
     created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     modified DATETIME NULL,
     fk_level INT UNSIGNED NOT NULL,
     fk_address INT UNSIGNED DEFAULT 1,
     fk_social INT UNSIGNED DEFAULT 1,
     FOREIGN KEY (fk_level) REFERENCES user_level(id),
     FOREIGN KEY (fk_address) REFERENCES address(id),
     FOREIGN KEY (fk_social) REFERENCES social(id)
);

CREATE TABLE IF NOT EXISTS day(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(15) NOT NULL,
     initials VARCHAR (3) NOT NULL,
     created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     modified DATETIME
);

CREATE TABLE IF NOT EXISTS day_active(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     modified DATETIME NULL,
     fk_employee INT UNSIGNED NOT NULL,
     fk_day INT UNSIGNED NOT NULL,
     fk_city INT UNSIGNED NOT NULL,
     FOREIGN KEY (fk_employee) REFERENCES user(id),
     FOREIGN KEY (fk_day) REFERENCES day(id),
     FOREIGN KEY (fk_city) REFERENCES city(id)
);

CREATE TABLE IF NOT EXISTS holiday(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(45) NOT NULL,
     date DATE NOT NULL,
     created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     permanent INT  DEFAULT 0,
     modified DATETIME NULL,
     fk_employee INT UNSIGNED NOT NULL,
     fk_city INT UNSIGNED NOT NULL,
	 FOREIGN KEY (fk_employee) REFERENCES user(id),
     FOREIGN KEY (fk_city) REFERENCES city(id)
);

CREATE TABLE IF NOT EXISTS time(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     time TIME NOT NULL,
	 created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     modified DATETIME NULL
);

CREATE TABLE IF NOT EXISTS time_active(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     modified DATETIME NULL,
     fk_employee INT UNSIGNED NOT NULL,
     fk_time INT UNSIGNED NOT NULL,
     fk_city INT UNSIGNED NOT NULL,
     fk_day INT UNSIGNED NOT NULL,
     FOREIGN KEY (fk_employee) REFERENCES user(id),
     FOREIGN KEY (fk_time) REFERENCES time(id),
     FOREIGN KEY (fk_city) REFERENCES city(id),
     FOREIGN KEY (fk_day) REFERENCES day_active(id)
);

CREATE TABLE IF NOT EXISTS service(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(25) NOT NULL,
     duration TIME NOT NULL,
     created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     modified DATETIME NULL
);

CREATE TABLE IF NOT EXISTS service_active(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     modified DATETIME NULL,
     fk_service INT UNSIGNED NOT NULL,
     fk_city INT UNSIGNED NOT NULL,
     fk_employee INT UNSIGNED NOT NULL,
     fk_day INT UNSIGNED NOT NULL,
	 FOREIGN KEY (fk_service) REFERENCES service(id),
     FOREIGN KEY (fk_city) REFERENCES city(id),
     FOREIGN KEY (fk_employee) REFERENCES user(id),
     FOREIGN KEY (fk_day) REFERENCES day(id)
);

CREATE TABLE IF NOT EXISTS scheduling(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     start DATETIME NOT NULL,
     end DATETIME NOT NULL,
     created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     modified DATETIME NULL,
     fk_service INT UNSIGNED NOT NULL,
     fk_client INT UNSIGNED NOT NULL,
     fk_employee INT UNSIGNED NOT NULL,
     fk_city INT UNSIGNED NOT NULL,
	 FOREIGN KEY (fk_service) REFERENCES service(id),
     FOREIGN KEY (fk_client) REFERENCES user(id),
     FOREIGN KEY (fk_employee) REFERENCES user(id),
     FOREIGN KEY (fk_city) REFERENCES city(id)
);
*/

/* Povoando */

/*
INSERT INTO state(name,initials) VALUES ("Piauí","PI");

INSERT INTO city (name, initials, fk_state) VALUES
("Picos", "PC", 1);

INSERT INTO user_level (name)  VALUES ("Admin"), ("Funcionário"), ("Cliente");

# ALTERAR NUM PARA CHAR DEPOIS
INSERT INTO address (street, neighborhood, num, cep, fk_city) VALUES
("Rua","Bairro","Número", "0", 1);

INSERT INTO social () VALUES ();

INSERT website (name, description) VALUES
("Barbearia", "O local para grandes homens!");

INSERT INTO user (name, surname, email, cpf, password, fk_level) VALUES
("Admin", "Sistema", "admin@barbearia.com", "00000000000", "202cb962ac59075b964b07152d234b70",1);

INSERT INTO user (name, surname, email, cpf, password, fk_level) VALUES
("Tião", "do Corte", "tiaodocorte@barbearia.com", "00000000000", "202cb962ac59075b964b07152d234b70", 2);

INSERT INTO user (name, surname, email, cpf, password, fk_level) VALUES
("José", "da Costa", "josedacosta@barbearia.com", "00000000000", "202cb962ac59075b964b07152d234b70", 3);

#NSERT INTO website (name, description, fk_address) VALUES
#("Barbearia", "O local para grandes homens");

INSERT INTO day (name, initials) VALUES("Domingo", "Dom"), ("Segunda-feira", "Seg"), ("Terça-feira", "Ter"), ("Quarta-feira", "Qua"),
("Quinta-feira", "Qui"), ("Sexta-feira", "Sex"), ("Sábado", "Sáb");

INSERT INTO time (time) VALUES  ('00:00'), ('00:30'), ('01:00'), ('01:30'), ('02:00'),
('02:30'), ('03:00'), ('03:30'), ('04:00'), ('04:30'), ('05:00'), ('05:30'),
('06:00'), ('06:30'), ('07:00'), ('07:30'), ('08:00'), ('08:30'), ('09:00'),
('09:30'), ('10:00'), ('10:30'), ('11:00'), ('11:30'), ('12:00'), ('12:30'),
('13:00'), ('13:30'), ('14:00'), ('14:30'), ('15:00'), ('15:30'), ('16:00'), 
('16:30'), ('17:00'), ('17:30'), ('18:00'), ('18:30'), ('19:00'), ('19:30'),
('20:00'), ('20:30'), ('21:00'), ('21:30'), ('22:00'), ('22:30'),('23:00'),
('23:30');

INSERT INTO holiday (name, date, permanent, fk_employee, fk_city) VALUES
("Ano Novo", "2022-01-01", 1, 1, 1),
("Carnaval 2023", "2023-02-20", 0, 1, 1),
("Carnaval 2023", "2023-02-21", 0, 1, 1),
("Quarta-feira de Cinzas", "2023-02-22", 0, 1, 1),
("Paixão de Cristo", "2023-04-07", 0, 1, 1),
("Páscoa 2023", "2023-04-09", 0, 1, 1),
("Tiradentes", "2023-04-21", 1, 1, 1),
("Corpus Christi", "2023-06-08", 0, 1, 1),
("Independência do Brasil", "2023-09-07", 1, 1, 1),
("Nossa Sr.a Aparecida", "2023-10-12", 1, 1, 1),
("Finados", "2023-11-02", 1, 1, 1),
("Proclamação da República", "2023-11-15", 1, 1, 1),
("Véspera de Natal", "2023-12-24", 1, 1, 1),
("Natal", "2023-12-25", 1, 1, 1),
("Véspera do Ano Novo", "2023-12-31", 1, 1, 1);

INSERT INTO service (name, duration) VALUES ("Corte normal", "00:30"), ("Corte degradê", "01:00"), 
("Corte & Barbar", "01:00"), ("Tesoura", "01:00"), ("Outros", "01:00");

INSERT INTO day_active (fk_employee, fk_city, fk_day) VALUES 
(2, 1, 2), (2, 1, 3), (2, 1, 4), (2, 1, 5), (2, 1, 6);

INSERT INTO time_active (fk_city, fk_employee, fk_time, fk_day) VALUES
(1, 2, 17, 1), (1, 2, 18, 1), (1, 2, 19, 1), (1, 2, 20, 1), # segunda manhã
(1, 2, 21, 1), (1, 2, 22, 1), (1, 2, 23, 1), (1, 2, 24, 1), # segunda manhã
(1, 2, 29, 1), (1, 2, 30, 1), (1, 2, 31, 1), (1, 2, 32, 1), # segunda tarde
(1, 2, 33, 2), (1, 2, 34, 2), (1, 2, 35, 2), (1, 2, 36, 1), # segunda tarde

(1, 2, 17, 2), (1, 2, 18, 2), (1, 2, 19, 2), (1, 2, 20, 2), # terça manhã
(1, 2, 21, 2), (1, 2, 22, 2), (1, 2, 23, 2), (1, 2, 24, 2), # terça manhã
(1, 2, 29, 2), (1, 2, 30, 2), (1, 2, 31, 2), (1, 2, 32, 2), # terça tarde
(1, 2, 33, 2), (1, 2, 34, 2), (1, 2, 35, 2), (1, 2, 36, 2), # terça tarde

(1, 2, 17, 3), (1, 2, 18, 3), (1, 2, 19, 3), (1, 2, 20, 3), # quarta manhã
(1, 2, 21, 3), (1, 2, 22, 3), (1, 2, 23, 3), (1, 2, 24, 3), # quarta manhã
(1, 2, 29, 3), (1, 2, 30, 3), (1, 2, 31, 3), (1, 2, 32, 3), # quarta tarde
(1, 2, 33, 3), (1, 2, 34, 3), (1, 2, 35, 3), (1, 2, 36, 3), # quarta tarde

(1, 2, 17, 4), (1, 2, 18, 4), (1, 2, 19, 4), (1, 2, 20, 4), # quinta manhã
(1, 2, 21, 4), (1, 2, 22, 4), (1, 2, 23, 4), (1, 2, 24, 4), # quinta manhã
(1, 2, 29, 4), (1, 2, 30, 4), (1, 2, 31, 4), (1, 2, 32, 4), # quinta tarde
(1, 2, 33, 4), (1, 2, 34, 4), (1, 2, 35, 4), (1, 2, 36, 4), # quinta tarde

(1, 2, 17, 5), (1, 2, 18, 5), (1, 2, 19, 5), (1, 2, 20, 5), # sexta manhã
(1, 2, 21, 5), (1, 2, 22, 5), (1, 2, 23, 5), (1, 2, 24, 5), # sexta manhã
(1, 2, 29, 5), (1, 2, 30, 5), (1, 2, 31, 5), (1, 2, 32, 5), # sexta tarde
(1, 2, 33, 5), (1, 2, 34, 5), (1, 2, 35, 5), (1, 2, 36, 5); # sexta tarde

INSERT INTO service_active (fk_service, fk_city, fk_employee, fk_day) VALUES 
(1, 1, 2, 1), (1, 1, 2, 2), (1, 1, 2, 3), (1, 1, 2, 4), (1, 1, 2, 5),
(2, 1, 2, 1), (2, 1, 2, 2), (2, 1, 2, 3), (2, 1, 2, 4), (2, 1, 2, 5),
(3, 1, 2, 1), (3, 1, 2, 2), (3, 1, 2, 3), (3, 1, 2, 4), (3, 1, 2, 5),
(4, 1, 2, 1), (4, 1, 2, 2), (4, 1, 2, 3), (4, 1, 2, 4), (4, 1, 2, 5),
(5, 1, 2, 1), (5, 1, 2, 2), (5, 1, 2, 3), (5, 1, 2, 4), (5, 1, 2, 5);

# ADICIONADO UM AGENDAENTO
INSERT INTO scheduling(start, end, fk_service, fk_client, fk_employee, fk_city) VALUES
("2023-01-25 08:00:00", "2023-01-25 08:30:00", 1, 3, 2, 1);
*/



/* SELECT DATA*/

# WEB SITE
 #SELECT w.name, w.description FROM website AS w;
 
# SELECT a.street, a.neighborhood, a.num, c.name, st.name, st.initials
# FROM website AS w
# INNER JOIN address AS a ON (w.fk_address = a.id)
#	INNER JOIN city AS c ON (a.fk_city = c.id)
#		INNER JOIN state AS st ON (c.fk_state = st.id);

#SELECT so.facebook, so.instagram, so.whatsapp
#FROM website AS w INNER JOIN social AS so ON (w.fk_social = so.id)
 
#SELECT w.name AS webiste, w.description, a.street, a.neighborhood, a.num, c.name, st.name, st.initials, so.facebook, so.instagram, so.whatsapp
#FROM website AS w
#INNER JOIN address AS a ON (w.fk_address = a.id)
	#INNER JOIN city AS c ON (a.fk_city = c.id)
		#INNER JOIN state AS st ON (c.fk_state = st.id)
#INNER JOIN social AS so ON (w.fk_social = so.id)
 #;

# USUÁRIO
# SELECT u.name, u.surname, u.email, u.password, ul.name FROM user as u INNER JOIN user_level as ul ON (u.fk_level = ul.id);

# LOGIN
# SELECT name, surname FROM user WHERE email = "admin@barbearia.com" AND password = md5("123");

# BUSCAR CIDADE DA BARBEARIA
# SELECT c.name, s.initials FROM city AS c INNER JOIN state AS s ON (c.fk_state = s.id);

# DIAS DA SEMANA
# SELECT name, initials FROM day;

# DIAS ATIVO (CIDADE e FUNCIONÁRIO)
#SELECT d.name, d.initials FROM day_active AS da INNER JOIN day AS d ON (da.fk_day = d.id)
#WHERE da.fk_city = 1 AND da.fk_employee = 2;

# FERIADOS (CIDADE E FUNCIONÁRIO )
#SELECT h.name,  DATE_FORMAT(h.date,'%d/%m/%Y') FROM holiday AS h WHERE fk_city = 1 AND fk_employee = 1;

# HORÁRIOS ATIVOS (CIDADE, FUNCIONÁRIO E DIA)
#SELECT t.time FROM time_active AS ta INNER JOIN time AS t ON (ta.fk_time = t.id)
#WHERE ta.fk_employee = 2 AND ta.fk_city = 1 AND ta.fk_day = 1;

# HORÁRIOS AGENDADOS (CITY, FUNCIONÁRIO)

#SELECT sche.start, sche.end, ser.name AS service, cli.name AS client, emp.name AS employee
#FROM scheduling AS sche
#INNER JOIN service AS ser  ON (sche.fk_service = ser.id) 
#INNER JOIN user AS cli ON (sche.fk_client = cli.id) 
#INNER JOIN user AS emp ON (sche.fk_employee = emp.id);

# HORÁRIOS AGENDADOS (INICIO, FIM)
#SELECT s.start, s.end FROM scheduling AS s; 


# HORÁRIOS NÃO AGENDADOS (EMPLOYEE E CITY)
#SELECT t.time FROM time_active AS ta INNER JOIN time AS t ON (ta.fk_time = t.id)
#WHERE ta.fk_employee = 2 AND ta.fk_city = 1 AND ta.fk_day = 1 AND
#t.time NOT IN (SELECT DATE_FORMAT(s.start, '%T') AS start FROM scheduling AS s)







