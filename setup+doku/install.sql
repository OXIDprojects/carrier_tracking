### Create the table 'oxcarrier

CREATE TABLE IF NOT EXISTS `oxcarrier` (
    `OXID` char(32) COLLATE latin1_general_ci NOT NULL,
    `OXSHOPID` char(32) COLLATE latin1_general_ci NOT NULL,
    `OXACTIVE` tinyint(1) NOT NULL DEFAULT '0',
    `OXTITLE` char(128) COLLATE latin1_general_ci NOT NULL,
    `OXTITLE_1` char(128) COLLATE latin1_general_ci NOT NULL,
    `OXSORT` int(11) NOT NULL,
    `OXSHORTDESC` varchar(255) COLLATE latin1_general_ci NOT NULL,
    `OXSHORTDESC_1` varchar(255) COLLATE latin1_general_ci NOT NULL,
    `OXICON` varchar(128) COLLATE latin1_general_ci NOT NULL,
    `OXCARRIERURL` varchar(255) COLLATE latin1_general_ci NOT NULL,
    `OXTIMESTAMP` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`OXID`),
    KEY `OXSHOPID` (`OXSHOPID`,`OXACTIVE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


### Add OXTRACKADR to oxorder table

ALTER TABLE `oxorder` ADD `OXCARRIERURL` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL ;
ALTER TABLE `oxorder` ADD `OXCARRIERID` CHAR( 32 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL ;

/*
Next Line: currently not used
*/
#INSERT INTO `oxconfigdisplay` (`OXID`, `OXCFGMODULE`, `OXCFGVARNAME`, `OXGROUPING`, `OXVARCONSTRAINT`, `OXPOS`) VALUES
#(md5('carrier sCarrierIconSize'), 'theme:azure', 'sCarrierIconSize', 'images', '', 1);

#INSERT INTO `oxconfig` (`OXID`, `OXSHOPID`, `OXMODULE`, `OXVARNAME`, `OXVARTYPE`, `OXVARVALUE`) VALUES
#(md5('carrier sCarrierIconSize'), 'oxbaseshop', 'theme:azure', 'sCarrierIconSize', 'str', 0x8064a213b1);

#INSERT INTO `oxconfig` (`OXID`, `OXSHOPID`, `OXMODULE`, `OXVARNAME`, `OXVARTYPE`, `OXVARVALUE`) VALUES
#(md5('carrier sCarrierIconSize'), 'oxbaseshop', 'theme:mobile', 'sCarrierIconSize', 'str', 0x8064a213b1);