create table email_info(
    email_id int PRIMARY KEY AUTO_INCREMENT,
    email varchar(120) null,
    registreDate timestamp NOT NULL DEFAULT current_timestamp()
)