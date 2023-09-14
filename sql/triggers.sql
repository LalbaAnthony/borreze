DELIMITER |
CREATE OR REPLACE TRIGGER
before_insert_menu
BEFORE
INSERT
ON menu FOR EACH ROW
BEGIN
        -- Verif si déja un menu à la même date 
        IF (SELECT COUNT(*) FROM menu WHERE lundiDate = NEW.lundiDate) > 0
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Déja un menu a cette date.';
        END IF;

        -- Set lastModifDateTimeMenu
        SET NEW.lastModifDateTimeMenu = NOW();

        -- Check si au moins 1 jour
        IF NEW.isLundiFerie = 1 AND NEW.isMardiFerie = 1 AND NEW.isJeudiFerie = 1 AND NEW.isVendrediFerie = 1
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Au moins un jour ne doit pas être férié.';
        END IF;

        -- Cohérence isFerie / repas
        IF NEW.isLundiFerie = 1 AND (NEW.lundiRepas IS NOT NULL OR NEW.lundiRepas <> '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Lundi ne peut être férié ET avoir un repas.';
        END IF;
        IF NEW.isMardiFerie = 1 AND (NEW.mardiRepas IS NOT NULL OR NEW.mardiRepas <> '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Mardi ne peut être férié ET avoir un repas.';
        END IF;
        -- IF NEW.isMercrediFerie = 1 AND (NEW.mercrediRepas IS NOT NULL OR NEW.mercrediRepas <> '')
        --         THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Mercredi ne peut être férié ET avoir un repas.';
        -- END IF;
        IF NEW.isJeudiFerie = 1 AND (NEW.jeudiRepas IS NOT NULL OR NEW.jeudiRepas <> '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Jeudi ne peut être férié ET avoir un repas.';
        END IF;
        IF NEW.isVendrediFerie = 1 AND (NEW.vendrediRepas IS NOT NULL OR NEW.vendrediRepas <> '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Vendredi ne peut être férié ET avoir un repas.';
        END IF;

        IF NEW.isLundiFerie = 0 AND (NEW.lundiRepas IS NULL OR NEW.lundiRepas = '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Lundi doit être férié OU avoir un repas.';
        END IF;
        IF NEW.isMardiFerie = 0 AND (NEW.mardiRepas IS NULL OR NEW.mardiRepas = '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Mardi doit être férié ET avoir un repas.';
        END IF;
        -- IF NEW.isMercrediFerie = 0 AND (NEW.mercrediRepas IS NULL OR NEW.mercrediRepas = '')
        --         THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Mercredi doit être férié ET avoir un repas.';
        -- END IF;
        IF NEW.isJeudiFerie = 0 AND (NEW.jeudiRepas IS NULL OR NEW.jeudiRepas = '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Jeudi doit être férié ET avoir un repas.';
        END IF;
        IF NEW.isVendrediFerie = 0 AND (NEW.vendrediRepas IS NULL OR NEW.vendrediRepas = '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Vendredi doit être férié ET avoir un repas.';
        END IF;
END |
DELIMITER ;

DELIMITER |
CREATE OR REPLACE TRIGGER
before_update_menu
BEFORE
UPDATE 
ON menu FOR EACH ROW
BEGIN
        -- Verif si déja un menu à la même date 
        IF (SELECT COUNT(*) FROM menu WHERE lundiDate = NEW.lundiDate AND idMenu <> NEW.idMenu) > 0
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Déja un menu a cette date.';
        END IF;

        -- Set lastModifDateTimeMenu
        SET NEW.lastModifDateTimeMenu = NOW();

        -- Check si au moins 1 jour
        IF NEW.isLundiFerie = 1 AND NEW.isMardiFerie = 1 AND NEW.isJeudiFerie = 1 AND NEW.isVendrediFerie = 1
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Au moins un jour ne doit pas être férié.';
        END IF;

        -- Cohérence isFerie / repas
        IF NEW.isLundiFerie = 1 AND (NEW.lundiRepas IS NOT NULL OR NEW.lundiRepas <> '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Lundi ne peut être férié ET avoir un repas.';
        END IF;
        IF NEW.isMardiFerie = 1 AND (NEW.mardiRepas IS NOT NULL OR NEW.mardiRepas <> '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Mardi ne peut être férié ET avoir un repas.';
        END IF;
        -- IF NEW.isMercrediFerie = 1 AND (NEW.mercrediRepas IS NOT NULL OR NEW.mercrediRepas <> '')
        --         THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Mercredi ne peut être férié ET avoir un repas.';
        -- END IF;
        IF NEW.isJeudiFerie = 1 AND (NEW.jeudiRepas IS NOT NULL OR NEW.jeudiRepas <> '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Jeudi ne peut être férié ET avoir un repas.';
        END IF;
        IF NEW.isVendrediFerie = 1 AND (NEW.vendrediRepas IS NOT NULL OR NEW.vendrediRepas <> '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Vendredi ne peut être férié ET avoir un repas.';
        END IF;

        IF NEW.isLundiFerie = 0 AND (NEW.lundiRepas IS NULL OR NEW.lundiRepas = '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Lundi doit être férié OU avoir un repas.';
        END IF;
        IF NEW.isMardiFerie = 0 AND (NEW.mardiRepas IS NULL OR NEW.mardiRepas = '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Mardi doit être férié ET avoir un repas.';
        END IF;
        -- IF NEW.isMercrediFerie = 0 AND (NEW.mercrediRepas IS NULL OR NEW.mercrediRepas = '')
        --         THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Mercredi doit être férié ET avoir un repas.';
        -- END IF;
        IF NEW.isJeudiFerie = 0 AND (NEW.jeudiRepas IS NULL OR NEW.jeudiRepas = '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Jeudi doit être férié ET avoir un repas.';
        END IF;
        IF NEW.isVendrediFerie = 0 AND (NEW.vendrediRepas IS NULL OR NEW.vendrediRepas = '')
                THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Vendredi doit être férié ET avoir un repas.';
        END IF;
END |
DELIMITER ;