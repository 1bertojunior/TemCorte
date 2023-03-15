USE scheduling;

/* WEB SITE*/
/*
SELECT name, description, email, phone FROM website;
*/

/* USER */
/*
SELECT name, surname, email, password FROM user;
*/
/* LOGIN */
/*
SELECT name, surname FROM user WHERE email = "hjunior854@gmail.com" AND password = md5("123");
*/

/* CITY */
/*
SELECT c.name, c.initials AS city_initials, s.initials AS state_initials FROM city AS c INNER JOIN state AS s ON c.fk_state = s.id
*/

/* DIAS DA SEMANA */
/* 
SELECT name, initials FROM day;
*/

/* DIAS DA SEMENA POR CIDADE E FUNCIONÁRIO */
/* CIDADES {BP = 1; PM = 2} | FUNCIONÁRIOS {ISRAEL = 1}*/
/* SELECT d.name FROM day_active AS da INNER JOIN day AS d ON da.fk_day = d.id WHERE da.fk_city = 2 AND da.fk_employee = 1 */

/* FERIADOS POR CITY E FUNCIONÁRIO */
/*
SELECT h.name, h.date FROM holiday AS h WHERE fk_city = 1 AND fk_employee = 1
*/

/* HORÁRIOS */
/* SELECT name, value FROM time; */

/* HORÁRIOS POR CIDADE, DIA E FUNCIONÁRIO */
/* CIDADES {BP = 1; PM = 2} | DIAS {1,2,3,4,5,6,7} | FUNCIONÁRIOS {ISRAEL = 1}*/
/* SELECT t.name, t.value FROM time_active AS ta INNER JOIN time AS t ON ta.fk_time = t.id WHERE ta.fk_city = 1 AND ta.fk_employee = 1 AND ta.fk_day = 1 */


/* HORÁRIOS AGENDADOS POR CIDADE, FUNCIONÁRIO E DATA*/
/* CIDADES {BP = 1; PM = 2} | FUNCIONÁRIOS {ISRAEL = 1}*/
/*
SELECT s.start, s.end, s.fk_service FROM scheduling AS s WHERE s.fk_city = 1 AND DATE_FORMAT(s.start, '%Y-%m-%d') = "2022-06-05"; 
*/

/* HORÁRIOS AGENDADOS DE X DIA, Y CIDADE, Z FFUNCIONÁRIO*/
/*
SELECT  DATE_FORMAT(s.start, '%H:%i:%s') as start, DATE_FORMAT(s.end, '%H:%i:%s') as start FROM scheduling AS s
WHERE s.fk_city = 1 AND DATE_FORMAT(s.start, '%Y-%m-%d') = "2022-06-05";
*/

/* SERVIÇO POR CIDADE E FUNCIONÁRIO */
SELECT * FROM 













/*
CREATE TABLE IF NOT EXISTS website(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(20) NOT NULL,
     description VARCHAR(100) NOT NULL,
     email VARCHAR(30) NOT NULL,
     phone VARCHAR (9) NOT NULL,
     created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     modofied DATETIME NULL
);

CREATE TABLE IF NOT EXISTS user(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(25) NOT NULL,
     surname VARCHAR(25) NOT NULL,
     email VARCHAR(30) NOT NULL,
     password VARCHAR(32) NOT null,
     created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     modofied DATETIME NULL
);

CREATE TABLE IF NOT EXISTS holiday(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(25) NOT NULL,
     date DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS state(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(10) NOT NULL,
     initials VARCHAR (2) NOT NULL
);

CREATE TABLE IF NOT EXISTS city(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	 name VARCHAR(10) NOT NULL,
     initials VARCHAR (5) NOT NULL,
     fk_state INT UNSIGNED NOT NULL,
     FOREIGN KEY (fk_state) REFERENCES state(id)
);

CREATE TABLE IF NOT EXISTS employee_role(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR (15) NOT NULL
);

CREATE TABLE IF NOT EXISTS employee(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR (20) NOT NULL,
     surname VARCHAR (20) NOT NULL,
     email VARCHAR (30) NOT NULL,
     phone VARCHAR (9) NOT NULL,
     fk_role INT UNSIGNED NOT NULL,
	  FOREIGN KEY  (fk_role) REFERENCES employee_role(id)
);

CREATE TABLE IF NOT EXISTS time(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR (5) NOT NULL,
     value TIME NOT NULL
);

CREATE TABLE IF NOT EXISTS time_active(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     fk_city INT UNSIGNED NOT NULL,
     fk_employee INT UNSIGNED NOT NULL,
     fk_time INT UNSIGNED NOT NULL,
     FOREIGN KEY (fk_city) REFERENCES city(id),
     FOREIGN KEY (fk_employee) REFERENCES employee(id),
     FOREIGN KEY (fk_time) REFERENCES time(id)
);

CREATE TABLE IF NOT EXISTS day(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(15) NOT NULL,
     initials VARCHAR (3) NOT NULL
);

CREATE TABLE IF NOT EXISTS day_active(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     fk_city INT UNSIGNED NOT NULL,
     fk_employee INT UNSIGNED NOT NULL,
     fk_day INT UNSIGNED NOT NULL
);

CREATE TABLE IF NOT EXISTS service(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(25) NOT NULL,
     time TIME NOT NULL
);

CREATE TABLE IF NOT EXISTS scheduling(
	 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(20) NOT NULL,
     surname VARCHAR(20) NOT NULL,
     phone VARCHAR(9) NOT NULL,
     email VARCHAR(35) NOT NULL,
     start DATETIME NOT NULL,
     end DATETIME NOT NULL,
     created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     modofied DATETIME NULL,
     fk_service INT UNSIGNED NOT NULL,
     fk_city INT UNSIGNED NOT NULL,
     fk_employee INT UNSIGNED NOT NULL,
	 FOREIGN KEY (fk_service) REFERENCES service(id),
     FOREIGN KEY (fk_city) REFERENCES city(id),
     FOREIGN KEY (fk_employee) REFERENCES employee(id)
);

INSERT INTO website (name, description, email, phone) VALUES ('Barber', 'Agendamento online', 'suporte@1bertojr.com','994449442'); 

INSERT INTO user (name, surname, email, password ) VALUES ( 'Humberto', 'Júnior', 'hjunior854@gmail.com',  '202cb962ac59075b964b07152d234b70');

ALTER TABLE city CHANGE name name VARCHAR (35) NOT NULL;

INSERT INTO state (name, initials) VALUES ('Piauí', 'PI');

INSERT INTO city (name, initials, fk_state) VALUES ('Belém do Piauí', 'BP', 1);

INSERT INTO city (name, initials, fk_state) VALUES ('Padre Marcos', 'PM', 1);

SELECT * FROM city;

ALTER TABLE holiday ADD (
	fk_city INT UNSIGNED NOT NULL,
    fk_employee INT UNSIGNED NOT NULL,
    FOREIGN KEY (fk_city) REFERENCES city(id),
	FOREIGN KEY (fk_employee) REFERENCES employee(id)
);

INSERT INTO time (name, value) VALUES  ('00h00','00:00'), ('00h30','00:30'), ('01h00', '01:00'), ('01h30','01:30'), ('02h00', '02:00'),
('02h30','02:30'), ('03h00', '03:00'), ('03h30','03:30'), ('04h00', '04:00'), ('04h30','04:30'), ('05h00', '05:00'), ('05h30','05:30'),
('06h00', '06:00'), ('06h30','06:30'), ('07h00', '07:00'), ('07h30','07:30'), ('08h00', '08:00'), ('08h30','08:30'), ('09h00', '09:00'),
('09h30','09:30'), ('10h00', '10:00'), ('10h30','10:30'), ('11h00', '11:00'), ('11h30','11:30'), ('12h00', '12:00'),  ('12h30', '12:30'),
('13h00', '13:00'), ('13h30','13:30'), ('14h00', '14:00'), ('14h30', '14:30'), ('15h00', '15:00'),('15h30','15:30'), ('16h00', '16:00'), 
('16h30','16:30'), ('17h00', '17:00'), ('17h30','17:30'), ('18h00', '18:00'), ('18h30','18:30'), ('19h00', '19:00'), ('19h30','19:30'),
('20h00', '20:00'), ('20h30','20:30'), ('21h00', '21:00'),('21h30','21:30'), ('22h00', '22:00'),('22h30','22:30'),('23h00', '23:00'),
('23h30','23:30');

INSERT INTO day (name, initials) VALUES("Domingo", "Dom"), ("Segunda-feira", "Seg"), ("Terça-feira", "Ter"), ("Quarta-feira", "Qua"),
("Quinta-feira", "Qui"), ("Sexta-feira", "Sex"), ("Sábado", "Sáb");

ALTER TABLE time_active ADD (
	fk_day INT UNSIGNED NOT NULL,
    FOREIGN KEY (fk_day) REFERENCES day_active(id)
);

INSERT INTO day_active (fk_city, fk_employee, fk_day) VALUES (1, 1, 1), (1, 1, 2), (1, 1, 4), (1, 1, 5), (1, 1, 7);

INSERT INTO day_active (fk_city, fk_employee, fk_day) VALUES (2, 1, 3), (2, 1, 6);



INSERT INTO time_active (fk_city, fk_employee, fk_time, fk_day) VALUES (1, 1, 17,1), (1, 1, 18,1), (1, 1, 19,1), (1, 1, 20,1),
(1, 1, 21,1), (1, 1, 22,1), (1, 1, 23,1), (1, 1, 24,1);

INSERT INTO time_active (fk_city, fk_employee, fk_time, fk_day) VALUES (1, 1, 17,2), (1, 1, 18,2), (1, 1, 19,2), (1, 1, 20,2),
(1, 1, 21,2), (1, 1, 22,2), (1, 1, 23,2), (1, 1, 24,2), (1, 1, 29,2), (1, 1, 30,2), (1, 1, 31,2), (1, 1, 32,2), (1, 1, 33,2),
(1, 1, 34,2), (1, 1, 35,2), (1, 1, 36,2), (1, 1, 37,2);

INSERT INTO time_active (fk_city, fk_employee, fk_time, fk_day) VALUES (1, 1, 17,4), (1, 1, 18,4), (1, 1, 19,4), (1, 1, 20,4),
(1, 1, 21,4), (1, 1, 22,4), (1, 1, 23,4), (1, 1, 24,4), (1, 1, 29,4), (1, 1, 30,4), (1, 1, 31,4), (1, 1, 32,4), (1, 1, 33,4),
(1, 1, 34,4), (1, 1, 35,4), (1, 1, 36,4), (1, 1, 37,4);

INSERT INTO time_active (fk_city, fk_employee, fk_time, fk_day) VALUES (1, 1, 17,5), (1, 1, 18,5), (1, 1, 19,5), (1, 1, 20,5),
(1, 1, 21,5), (1, 1, 22,5), (1, 1, 23,5), (1, 1, 24,5), (1, 1, 29,5), (1, 1, 30,5), (1, 1, 31,5), (1, 1, 32,5), (1, 1, 33,5),
(1, 1, 34,5), (1, 1, 35,5), (1, 1, 36,5), (1, 1, 37,5);

INSERT INTO time_active (fk_city, fk_employee, fk_time, fk_day) VALUES (1, 1, 17,7), (1, 1, 18,7), (1, 1, 19,7), (1, 1, 20,7),
(1, 1, 21,7), (1, 1, 22,7), (1, 1, 23,7), (1, 1, 24,7), (1, 1, 29,7), (1, 1, 30,7), (1, 1, 31,7), (1, 1, 32,7), (1, 1, 33,7),
(1, 1, 34,7), (1, 1, 35,7), (1, 1, 36,7), (1, 1, 37,7);

INSERT INTO time_active (fk_city, fk_employee, fk_time, fk_day) VALUES (2, 1, 17,3), (2, 1, 18,3), (2, 1, 19,3), (2, 1, 20,3),
(2, 1, 21,3), (2, 1, 22,3), (2, 1, 23,3), (2, 1, 24,3), (2, 1, 29,3), (2, 1, 30,3), (2, 1, 31,3), (2, 1, 32,3), (2, 1, 33,3),
(2, 1, 34,3), (2, 1, 35,3), (2, 1, 36,3), (2, 1, 37,3);

INSERT INTO time_active (fk_city, fk_employee, fk_time, fk_day) VALUES (2, 1, 17,6), (2, 1, 18,6), (2, 1, 19,6), (2, 1, 20,6),
(2, 1, 21,6), (2, 1, 22,6), (2, 1, 23,6), (2, 1, 24,6), (2, 1, 29,6), (2, 1, 30,6), (2, 1, 31,6), (2, 1, 32,6), (2, 1, 33,6),
(2, 1, 34,6), (2, 1, 35,6), (2, 1, 36,6), (2, 1, 37,6);


INSERT INTO service (name, time) VALUES ("Corte normal", "00:30"), ("Corte degradê", "01:00"), 
("Corte & Barbar", "01:00"), ("Tesoura", "01:00"), ("Outros", "01:00");

INSERT INTO scheduling (name, surname, phone, email, start, end, fk_service, fk_city, fk_employee) VALUES
("Humberto", "Júnior", "994449442", "suporte@1bertojr.com", "2022-06-05 10:00:00", "2022-06-05 10:30:00", 1, 1, 1);

INSERT INTO scheduling (name, surname, phone, email, start, end, fk_service, fk_city, fk_employee) VALUES
("Vírgilio", "Leal", "994000000", "email@gmail.com", "2022-06-05 16:00:00", "2022-06-05 17:00:00", 2, 1, 1);

INSERT INTO employee_role (name) VALUE ('Barbeiro');

INSERT INTO employee (name, surname, email, phone, fk_role) VALUE ('Israel', 'João', 'israel@barbeariavisual.com','994000000',1);

INSERT INTO holiday (name, date, fk_city, fk_employee) VALUES ('Corpus Chriti', '2022-06-16',1,1);

INSERT INTO holiday (name, date, fk_city, fk_employee) VALUES ('Independência do Brasil', '2022-08-07',1,1);

*/







