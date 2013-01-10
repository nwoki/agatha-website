DROP TABLE IF EXISTS web_admins;
DROP TABLE IF EXISTS server_admins;

create table web_admins (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login varchar (15) NOT NULL,
    password varchar (32) NOT NULL,     -- md5 hash
    first_name varchar (20),
    last_name varchar (20),
    email varchar (40) NOT NULL         -- in case someone has a LOT of fantasy
) Engine = InnoDB;


create table server_admins (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,

    -- server admin info
    nick varchar (15) NOT NULL,
    first_name varchar (20),
    last_name varchar (20),
    email varchar (40) NOT NULL,
    auth_token varchar (40) NOT NULL,

    -- server info (this might be moved to seperate table later on)
    server_name varchar (30) NOT NULL,  -- let the fantasy run
    server_ip varchar (15) NOT NULL,    -- ipv4 for now
    server_port int NOT NULL
) Engine = InnoDB;