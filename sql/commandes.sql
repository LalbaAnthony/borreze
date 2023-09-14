-- Navbar Pages
SELECT *
FROM page
WHERE navBarPosPage IS NOT NULL AND navBarPosPage <> 0
ORDER BY navBarPosPage ASC;

-- Tests menus
DELETE FROM menu;
INSERT INTO menu (lundiDate, lundiRepas, mardiRepas, mercrediRepas, jeudiRepas, vendrediRepas, isLundiFerie, isMardiFerie, isMercrediFerie, isJeudiFerie, isVendrediFerie) VALUES
('2073-01-01', 'Saucisson', NULL, 'Saucisson', 'Saucisson', 'Saucisson', 0, 0, 0, 0, 0 );