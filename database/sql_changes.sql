ALTER TABLE `itabhumi`.`users` 
ADD COLUMN `mobile_no` VARCHAR(45) NULL AFTER `role`,
ADD UNIQUE INDEX `mobile_no_UNIQUE` (`mobile_no` ASC) VISIBLE;
;

ALTER TABLE `itabhumi`.`documents_uploaded` 
ADD COLUMN `module_name` VARCHAR(45) NOT NULL AFTER `id`;

ALTER TABLE `itabhumi`.`land_allotment` 
ADD COLUMN `district` VARCHAR(45) NULL AFTER `mobile_no`,
ADD COLUMN `father_name` VARCHAR(100) NULL AFTER `plot_location`,
ADD COLUMN `lattitude` VARCHAR(255) NULL AFTER `father_name`,
ADD COLUMN `longitude` VARCHAR(255) NULL AFTER `lattitude`,
ADD COLUMN `area` VARCHAR(100) NULL AFTER `lease_period`,
ADD COLUMN `land_possession` VARCHAR(100) NULL AFTER `area`,
ADD COLUMN `date_occupancy` VARCHAR(45) NULL AFTER `land_possesion`,
ADD COLUMN `crop_structure` VARCHAR(100) NULL AFTER `date_occupancy`,
ADD COLUMN `revenue_assessed` VARCHAR(45) NULL AFTER `crop_structure`,
CHANGE COLUMN `plot_location` `plot_location` VARCHAR(45) NULL AFTER `district`;
