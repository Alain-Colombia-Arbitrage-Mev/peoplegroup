# oxigenoglobal-backoffice
https://oxigenoglobal.com/afiliado/login

# Oxigeno Home
https://oxigenoglobal.com


credentials database local

  DB_CONNECTION=mysql
  DB_HOST=localhost
  DB_PORT=3306
  DB_DATABASE=oxigenoglobal_red
  DB_USERNAME=oxigenoglobal_afiliado
  DB_PASSWORD=1*?#cNdLKSr4


  DB_CONNECTION=mysql
  DB_HOST=localhost
  DB_PORT=3306
  DB_DATABASE=oxigeno
  DB_USERNAME=oxigenoglobal
  DB_PASSWORD=12345

## ADD Gateway
INSERT INTO gateways (name, gateimg, minamo,maxamo, chargefx, chargepc, rate, val1, val2, val3, status) VALUES ('Etherium', '5a709659027e1.jpg', 10, 15000, 0, 5, 1, 'La transacción será aprobada por blockchain, cuando sea confirmada tus fondos estaran disponibles', NULL, NULL, 1);

# CONNECT TO DB (local)
sudo mariadb -u oxigenoglobal -p oxigeno 

# CONNECT TO DB (production)
sudo mariadb -h oxigenoglobal.com  -u oxigenoglobal_afiliado  -p oxigenoglobal_red
"1*?#cNdLKSr4"

# Access to admin backoffice
**user** admin
**password**  oxigeno2020

# DATABASE SETUP

# Reset System 
TRUNCATE crypto_transactions;
TRUNCATE deposits;
TRUNCATE incomes;
TRUNCATE membership_active;
TRUNCATE membership_history;
TRUNCATE orders;
TRUNCATE password_resets;
TRUNCATE ticket_comments;
TRUNCATE tickets;
TRUNCATE transactions;
TRUNCATE transfers;
TRUNCATE withdraw_trasections;
DELETE FROM users where id > 2;
ALTER TABLE users AUTO_INCREMENT = 3;
UPDATE users SET membership_id = 0;
UPDATE users SET membership_date = null;
UPDATE users SET balance = 0;

TRUNCATE bonus_redeems;
TRUNCATE gateways;


CREATE TABLE `bonus_redeems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `referred_user` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0-Por Pagar , 1-Procesada OK',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

INSERT INTO gateways (name, gateimg, minamo,maxamo, chargefx, chargepc, rate, val1, val2, val3, status) VALUES ('Etherium', '5a709659027e1.jpg', 10, 15000, 0, 5, 1, 'La transacción será aprobada por blockchain, cuando sea confirmada tus fondos estaran disponibles', NULL, NULL, 1);


Export DB

mysqldump --user=oxigenoglobal --password --lock-tables --databases oxigeno > /data/backup/oxigeno.sql