-- Create user

DROP USER IF EXISTS 'borrezeuser'@'localhost';
CREATE USER 'borrezeuser'@'localhost' IDENTIFIED BY 'wDGgwaN1QC3VHur';

GRANT SELECT ON borreze.page TO 'borrezeuser'@'localhost';
GRANT SELECT ON borreze.menu TO 'borrezeuser'@'localhost';
GRANT INSERT ON borreze.menu TO 'borrezeuser'@'localhost';
GRANT UPDATE ON borreze.menu TO 'borrezeuser'@'localhost';
GRANT DELETE ON borreze.menu TO 'borrezeuser'@'localhost';