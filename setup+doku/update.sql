RENAME TABLE `oxcarriertracking` TO `oxcarriers`;

#oxsort
ALTER TABLE `oxcarriers` CHANGE `OXCARRIERICON` `OXICON` CHAR( 128 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE `oxcarriers` CHANGE `OXTRACKADR` `OXCARRIERURL` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE `oxcarriers` ADD `OXTITLE_1` CHAR( 128 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL ;
ALTER TABLE `oxcarriers` ADD `OXSHORTDESC_1` TEXT  NOT NULL ;
ALTER TABLE `oxcarriers` CHANGE `OXICON` `OXICON` VARCHAR( 128 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE `oxcarriers` CHANGE `OXSHORTDESC` `OXSHORTDESC` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE `oxcarriers` CHANGE `OXINSERT` `OXTIMESTAMP` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `oxorder` CHANGE `OXTRACKADR` `OXCARRIERURL` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'alternative Url';


/*
Next Line: currently not used
*/
#INSERT INTO `oxconfigdisplay` (`OXID`, `OXCFGMODULE`, `OXCFGVARNAME`, `OXGROUPING`, `OXVARCONSTRAINT`, `OXPOS`) VALUES
#(md5('carrier sCarrierIconSize'), 'theme:azure', 'sCarrierIconSize', 'images', '', 1);

#INSERT INTO `oxconfig` (`OXID`, `OXSHOPID`, `OXMODULE`, `OXVARNAME`, `OXVARTYPE`, `OXVARVALUE`) VALUES
#(md5('carrier sCarrierIconSize'), 'oxbaseshop', 'theme:azure', 'sCarrierIconSize', 'str', 0x8064a213b1);

#INSERT INTO `oxconfig` (`OXID`, `OXSHOPID`, `OXMODULE`, `OXVARNAME`, `OXVARTYPE`, `OXVARVALUE`) VALUES
#(md5('carrier sCarrierIconSize'), 'oxbaseshop', 'theme:mobile', 'sCarrierIconSize', 'str', 0x8064a213b1);

