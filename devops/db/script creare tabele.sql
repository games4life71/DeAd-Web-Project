-- MySQL Script generated by MySQL Workbench
-- Thu May 18 14:41:14 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema DeAd
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema DeAd
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `DeAd` DEFAULT CHARACTER SET utf8 ;
USE `DeAd` ;

-- -----------------------------------------------------
-- Table `DeAd`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DeAd`.`users` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `fname` VARCHAR(45) NOT NULL,
  `lname` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `photo` MEDIUMBLOB NULL,
  `function` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC) VISIBLE,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DeAd`.`inmates`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DeAd`.`inmates` (
  `inmate_id` INT NOT NULL AUTO_INCREMENT,
  `person_id` INT NOT NULL,
  `sentence_start_date` DATE NOT NULL,
  `sentence_duration` INT NOT NULL,
  `sentence_category` VARCHAR(45) NULL,
  PRIMARY KEY (`inmate_id`),
  UNIQUE INDEX `inmate_id_UNIQUE` (`inmate_id` ASC) VISIBLE,
  UNIQUE INDEX `person_id_UNIQUE` (`person_id` ASC) VISIBLE,
  CONSTRAINT `person_id_from_inmates`
    FOREIGN KEY (`person_id`)
    REFERENCES `DeAd`.`users` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DeAd`.`visitors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DeAd`.`visitors` (
  `person_id` INT NOT NULL,
  `relationship` VARCHAR(50) NOT NULL,
  `inmate_id` INT NOT NULL,
  INDEX `person_id_idx` (`person_id` ASC) VISIBLE,
  PRIMARY KEY (`inmate_id`, `person_id`),
  CONSTRAINT `person_id`
    FOREIGN KEY (`person_id`)
    REFERENCES `DeAd`.`users` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `inmate_id_from_visitors`
    FOREIGN KEY (`inmate_id`)
    REFERENCES `DeAd`.`inmates` (`inmate_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DeAd`.`visits_summary`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DeAd`.`visits_summary` (
  `visit_id` INT NOT NULL AUTO_INCREMENT,
  `visitor_id` INT NOT NULL,
  `inmate_id` INT NOT NULL,
  `visit_date` DATE NOT NULL,
  `visit_type` VARCHAR(45) NOT NULL,
  `visit_nature` VARCHAR(45) NOT NULL,
  `items_provided_to_convict` VARCHAR(255) NULL,
  `items_offered_by_convict` VARCHAR(255) NULL,
  `health_status` VARCHAR(45) NULL,
  `visit_start` TIME NOT NULL,
  `visit_end` TIME NOT NULL,
  `summary` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`visit_id`),
  UNIQUE INDEX `visit_id_UNIQUE` (`visit_id` ASC) VISIBLE,
  INDEX `inmate_id_idx` (`inmate_id` ASC) VISIBLE,
  CONSTRAINT `inmate_id`
    FOREIGN KEY (`inmate_id`)
    REFERENCES `DeAd`.`inmates` (`inmate_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DeAd`.`witnesses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DeAd`.`witnesses` (
  `witness_id` INT NOT NULL AUTO_INCREMENT,
  `person_id` INT NOT NULL,
  `visit_id` INT NOT NULL,
  PRIMARY KEY (`witness_id`),
  UNIQUE INDEX `witness_id_UNIQUE` (`witness_id` ASC) VISIBLE,
  INDEX `person_id_from_witnesses_idx` (`person_id` ASC) VISIBLE,
  INDEX `visit_id_idx` (`visit_id` ASC) VISIBLE,
  CONSTRAINT `person_id_from_witnesses`
    FOREIGN KEY (`person_id`)
    REFERENCES `DeAd`.`users` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `visit_id`
    FOREIGN KEY (`visit_id`)
    REFERENCES `DeAd`.`visits_summary` (`visit_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DeAd`.`appointments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DeAd`.`appointments` (
  `appointment_id` INT NOT NULL AUTO_INCREMENT,
  `person_id` INT NOT NULL,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `relationship` VARCHAR(45) NOT NULL,
  `visit_nature` VARCHAR(45) NOT NULL,
  `photo` MEDIUMBLOB NOT NULL,
  `source_of_income` VARCHAR(45) NULL,
  `date` DATE NOT NULL,
  `estimated_time` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`appointment_id`),
  UNIQUE INDEX `appointment_id_UNIQUE` (`appointment_id` ASC) VISIBLE,
  INDEX `person_id_from_appointments_idx` (`person_id` ASC) VISIBLE,
  CONSTRAINT `person_id_from_appointments`
    FOREIGN KEY (`person_id`)
    REFERENCES `DeAd`.`users` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
