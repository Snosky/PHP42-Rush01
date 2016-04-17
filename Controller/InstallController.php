<?php
namespace Controller;

class InstallController
{
    public function homeAction()
    {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL,ALLOW_INVALID_DATES\';
                DROP SCHEMA IF EXISTS `snosky_rush01` ;
                CREATE SCHEMA IF NOT EXISTS `snosky_rush01` DEFAULT CHARACTER SET utf8 ;
                USE `snosky_rush01` ;
                DROP TABLE IF EXISTS `snosky_rush01`.`t_user` ;
                CREATE TABLE IF NOT EXISTS `snosky_rush01`.`t_user` (
                  `usr_id` INT NOT NULL AUTO_INCREMENT,
                  `usr_username` VARCHAR(45) NULL,
                  `usr_email` VARCHAR(255) NULL,
                  `usr_password` VARCHAR(255) NULL,
                  `usr_salt` VARCHAR(45) NULL,
                  `usr_role` VARCHAR(45) NULL,
                  PRIMARY KEY (`usr_id`))
                ENGINE = InnoDB;
                DROP TABLE IF EXISTS `snosky_rush01`.`t_user_profile` ;
                CREATE TABLE IF NOT EXISTS `snosky_rush01`.`t_user_profile` (
                  `pro_id` INT NOT NULL AUTO_INCREMENT,
                  `t_user_usr_id` INT NOT NULL,
                  PRIMARY KEY (`pro_id`),
                  INDEX `fk_t_user_profile_t_user_idx` (`t_user_usr_id` ASC),
                  CONSTRAINT `fk_t_user_profile_t_user`
                    FOREIGN KEY (`t_user_usr_id`)
                    REFERENCES `snosky_rush01`.`t_user` (`usr_id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)
                ENGINE = InnoDB;
                DROP TABLE IF EXISTS `snosky_rush01`.`t_game` ;
                CREATE TABLE IF NOT EXISTS `snosky_rush01`.`t_game` (
                  `game_id` INT NOT NULL AUTO_INCREMENT,
                  `game_password` VARCHAR(45) NULL,
                  `usr_id` INT NOT NULL,
                  PRIMARY KEY (`game_id`),
                  INDEX `fk_t_game_t_user1_idx` (`usr_id` ASC),
                  CONSTRAINT `fk_t_game_t_user1`
                    FOREIGN KEY (`usr_id`)
                    REFERENCES `snosky_rush01`.`t_user` (`usr_id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)
                ENGINE = InnoDB;
                DROP TABLE IF EXISTS `snosky_rush01`.`t_game_has_t_user` ;
                CREATE TABLE IF NOT EXISTS `snosky_rush01`.`t_game_has_t_user` (
                  `game_id` INT NOT NULL,
                  `usr_id` INT NOT NULL,
                  PRIMARY KEY (`game_id`, `usr_id`),
                  INDEX `fk_t_game_has_t_user_t_user1_idx` (`usr_id` ASC),
                  INDEX `fk_t_game_has_t_user_t_game1_idx` (`game_id` ASC),
                  CONSTRAINT `fk_t_game_has_t_user_t_game1`
                    FOREIGN KEY (`game_id`)
                    REFERENCES `snosky_rush01`.`t_game` (`game_id`)
                    ON DELETE CASCADE
                    ON UPDATE NO ACTION,
                  CONSTRAINT `fk_t_game_has_t_user_t_user1`
                    FOREIGN KEY (`usr_id`)
                    REFERENCES `snosky_rush01`.`t_user` (`usr_id`)
                    ON DELETE CASCADE
                    ON UPDATE NO ACTION)
                ENGINE = InnoDB;
                DROP TABLE IF EXISTS `snosky_rush01`.`t_chat_message` ;
                CREATE TABLE IF NOT EXISTS `snosky_rush01`.`t_chat_message` (
                  `msg_id` INT NOT NULL AUTO_INCREMENT,
                  `msg_content` LONGTEXT NULL,
                  `usr_id` INT NOT NULL,
                  `game_id` INT NULL,
                  `msg_date` DATETIME NULL,
                  PRIMARY KEY (`msg_id`),
                  INDEX `fk_t_chat_message_t_user1_idx` (`usr_id` ASC),
                  INDEX `fk_t_chat_message_t_game1_idx` (`game_id` ASC),
                  CONSTRAINT `fk_t_chat_message_t_user1`
                    FOREIGN KEY (`usr_id`)
                    REFERENCES `snosky_rush01`.`t_user` (`usr_id`)
                    ON DELETE CASCADE
                    ON UPDATE NO ACTION,
                  CONSTRAINT `fk_t_chat_message_t_game1`
                    FOREIGN KEY (`game_id`)
                    REFERENCES `snosky_rush01`.`t_game` (`game_id`)
                    ON DELETE CASCADE
                    ON UPDATE NO ACTION)
                ENGINE = InnoDB;                
                SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
                ';

        $db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS, array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        $sql = explode(';', $sql);
        $error = FALSE;
        foreach ($sql as $line)
        {
            $line = trim($line);
            if (!empty($line))
            {
                try
                {
                    $db->query($line);
                }
                catch (\PDOException $e)
                {
                    echo 'Erreur sql : '. $e;
                }
                $error = TRUE;
            }
        }
        if (!$error)
            echo 'BDD OK';
        return;
    }
}