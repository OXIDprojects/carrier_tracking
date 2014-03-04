<?php
/**
 *    This file is part of OXID eShop Community Edition.
 *
 *    OXID eShop Community Edition is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.oxid-esales.com
 * @package core
 * @copyright © OXID eSales AG 2003-2009
 * $Id: oxlinks.php 14378 2008-11-26 13:59:41Z vilma $
 */

/**
 * Links manager.
 * Collects stored in DB links data (URL, description).
 * @package core
 */
class oxCarrier extends oxI18n
{
    /**
     * Object core table name
     *
     * @var string
     */
    protected $_sCoreTbl = 'oxcarrier';

    /**
     * Current class name
     *
     * @var string
     */
    protected $_sClassName = 'oxcarrier';

    /**
     * Class constructor, initiates parent constructor (parent::oxI18n()).
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->init( $this->_sCoreTbl );
    }

    /**
     * Sets data field value
     *
     * @param string $sFieldName index OR name (eg. 'oxarticles__oxtitle') of a data field to set
     * @param string $sValue     value of data field
     * @param int    $iDataType  field type
     *
     * @return null
     */
    protected function _setFieldData( $sFieldName, $sValue, $iDataType = oxField::T_TEXT)
    {
        if ('oxshortdesc' === strtolower($sFieldName) || 'oxcarrier__oxshortdesc' === strtolower($sFieldName)) {
            $iDataType = oxField::T_RAW;
        }

        return parent::_setFieldData($sFieldName, $sValue, $iDataType);
    }

    /**
     * Returns carrier icon
     *
     * @return string
     */
    public function getIconUrl()
    {
        $sIcon = $this->getFieldData('oxicon');

        if ( $sIcon) {
            return $this->getConfig()->getPictureUrl( "master/carrier/icon/".$sIcon, false, $this->getConfig()->isSsl(), null, $this->getFieldData('oxshopid') );
        }

        /*
         * currently not used
        if ( $sIcon != '' ) {
            $oConfig = $this->getConfig();
            $sSize = $oConfig->getConfigParam('sCarrierIconSsize');
            if ( !$sSize ) {
                $sSize = $oConfig->getConfigParam( 'sIconsize' );
            }

            return oxRegistry::get("oxPictureHandler")->getPicUrl( "carrier/icon/", $sIcon, $sSize );
        }
        return '';
        */
    }

}

