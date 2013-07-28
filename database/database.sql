DROP TABLE IF EXISTS web_admins;
DROP TABLE IF EXISTS gameserver_admins;

create table web_admins (
    id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login varchar (15) NOT NULL,
    password varchar (32) NOT NULL,     -- md5 hash
    first_name varchar (20),
    last_name varchar (20),
    email varchar (40) NOT NULL         -- in case someone has a LOT of fantasy
) Engine = MYISAM;


create table gameserver_admins (
    id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

    -- server admin info
    login varchar (15) NOT NULL,
    password varchar (32) NOT NULL,     -- md5 hash
    first_name varchar (20),
    last_name varchar (20),
    email varchar (40) NOT NULL,

    -- creation info
    created datetime NOT NULL,
    last_updated datetime NOT NULL
) Engine = MYISAM;