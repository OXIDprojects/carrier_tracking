<?php
/**
 *    This file is part of OXID eShop Community Edition.
 *    OXID eShop Community Edition is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *    OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @package   core
 * @copyright © OXID eSales AG 2003-2009
 *            $Id: oxcountrylist.php 14378 2008-11-26 13:59:41Z vilma $
 */

/**
 * Article list manager.
 * Collects list of article according to collection rules (categories, etc.).
 *
 * @package core
 */
class oxCarrierList extends oxList
{
    /**
     * Call parent class constructor
     *
     * @param string $sObjectsInListName Associated list item object type
     *
     */
    public function __construct($sObjectsInListName = 'oxcarrier')
    {
        parent::__construct('oxcarrier');
    }

    /**
     * Selects and SQL, creates objects, assign them and
     * preforms sorting that handles umlauts
     *
     * @param string $sSQL SQL select statement
     *
     * @return null;
     */
    public function selectString($sSQL)
    {
        parent::selectString($sSQL);
        uasort($this->_aArray, array($this, '_localCompare'));
    }

    /**
     * Selects and loads all active countries
     */
    public function loadActiveCarriers()
    {
        $sTableCarrier = getViewName('oxcarrier');
        $sSelect = "SELECT * FROM ".$sTableCarrier." WHERE oxactive = '1' ORDER BY oxtitle ";
        $this->selectString($sSelect);
    }

    /**
     * Improved country sorting that handles umlauts.
     * Replaces umlauts and compares country titles.
     *
     * @param oxCountry $oA oxCountry object
     * @param oxCountry $oB oxCountry oxCountry object
     *
     * @return bool
     */
    protected function _localCompare($oA, $oB)
    {
        if ($oA->oxcarrier__oxsort->value != $oB->oxcarrier__oxsort->value) {
            if ($oA->oxcarrier__oxsort->value < $oB->oxcarrier__oxsort->value) {
                return -1;
            } else {
                return 1;
            }
        }

        $aReplaceWhat = array(
        '/ä/',
        '/ö/',
        '/ü/',
        '/Ü/',
        '/Ä/',
        '/Ö/',
        '/ß/',
        '/&auml;/',
        '/&ouml;/',
        '/&uuml;/',
        '/&Auml;/',
        '/&Ouml;/',
        '/&Uuml;/',
        '/&szlig;/'
        );
        $aReplaceTo   = array('az', 'oz', 'uz', 'Uz', 'Az', 'Oz', 'sz', 'az', 'oz', 'uz', 'Az', 'Oz', 'Uz', 'sz');

        $sACodedTitle = preg_replace($aReplaceWhat, $aReplaceTo, $oA->oxcarrier__oxtitle->value);
        $sBCodedTitle = preg_replace($aReplaceWhat, $aReplaceTo, $oB->oxcarrier__oxtitle->value);

        $iRes = strcasecmp($sACodedTitle, $sBCodedTitle);

        // if equal, using case sensitive compare
        if ($iRes === 0) {
            $iRes = strcmp($sACodedTitle, $sBCodedTitle);
        }

        return $iRes;
    }
}
