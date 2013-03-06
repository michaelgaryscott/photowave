CREATE DATABASE asameli_guestbook;
USE asameli_guestbook;

CREATE TABLE tblGroup
(
GroupID INT AUTO_INCREMENT PRIMARY KEY,
Name CHAR(70) NOT NULL,
Bezeichnung CHAR(70)
);

CREATE TABLE tblUser
(
UserID INT AUTO_INCREMENT PRIMARY KEY,
Name CHAR(70) NOT NULL,
Vorname CHAR(70) NOT NULL,
Titel CHAR(4) NOT NULL,
Mail CHAR(70) NOT NULL,
Password CHAR(70) NOT NULL,
GroupID INT NOT NULL,
FOREIGN KEY (GroupID) REFERENCES tblGroup(GroupID)
);


CREATE TABLE tblBeitraege
(
BeitragID INT AUTO_INCREMENT PRIMARY KEY,
Beitrag TEXT NOT NULL,
Datum TIMESTAMP NOT NULL,
IP VARCHAR(20) NOT NULL,
UserID INT NOT NULL,
FOREIGN KEY (UserID) REFERENCES tblUser(UserID)
);

INSERT INTO tblgroup
(name, bezeichnung)
VALUES
("admin", "Administratoren"),
("registred", "Registrierte Benutzer");

INSERT INTO tbluser
(Name, Vorname, Titel, Mail, Password, GroupID)
VALUES
("Admin", "Admin", "Herr", "admin@admin.ch", "21232f297a57a5a743894a0e4a801fc3", 1),
("User", "User", "Herr", "user@user.ch", "ee11cbb19052e40b07aac0ca060c23ee", 2);