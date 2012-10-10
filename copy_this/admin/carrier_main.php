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
 * @package admin
 * @copyright © OXID eSales AG 2003-2009
 * $Id: adminlinks_main.php 14610 2008-12-10 17:46:54Z tomas $
 */

/**
 * Admin links details manager.
 * Creates form for submitting new admin links or modifying old ones.
 * Admin Menu: Customer News -> Links.
 * @package admin
 */
class Carrier_Main extends oxAdminDetails
{
    /**
     * Sets link information data (or leaves empty), returns name of template
     * file "adminlinks_main.tpl".
     * @return string
     */
    public function render()
    {
        $myConfig  = $this->getConfig();

        parent::render();

        $soxId = oxConfig::getParameter( "oxid");
        // check if we right now saved a new entry
        $sSavedID = oxConfig::getParameter( "saved_oxid");
        if ( ($soxId == "-1" || !isset( $soxId)) && isset( $sSavedID) ) {
            $soxId = $sSavedID;
            oxSession::deleteVar( "saved_oxid");
            $this->_aViewData["oxid"] =  $soxId;
            // for reloading upper frame
            $this->_aViewData["updatelist"] =  "1";
        }

        if ( $soxId != "-1" && isset( $soxId)) {
            // load object
            $oLinks = oxNew( "oxcarrier", getViewName( 'oxcarrier'));
            $oLinks->loadInLang( $this->_iEditLang, $soxId );

            $oOtherLang = $oLinks->getAvailableInLangs();
            if (!isset($oOtherLang[$this->_iEditLang])) {
                // echo "language entry doesn't exist! using: ".key($oOtherLang);
                $oLinks->loadInLang( key($oOtherLang), $soxId );
            }
            $this->_aViewData["edit"] =  $oLinks;

            // remove already created languages
            $this->_aViewData["posslang"] =  array_diff (oxLang::getInstance()->getLanguageNames(), $oOtherLang);

            foreach ( $oOtherLang as $id => $language) {
                $oLang= new oxStdClass();
                $oLang->sLangDesc = $language;
                $oLang->selected = ($id == $this->_iEditLang);
                $this->_aViewData["otherlang"][$id] =  clone $oLang;
            }
        }

        $this->_aViewData["sNowValue"] = date("Y-m-d H:i:s", oxUtilsDate::getInstance()->getTime());

        return "carrier_main.tpl";
    }

    /**
     * Saves information about link (active, date, URL, description, etc.) to DB.
     *
     * @return mixed
     */
    public function save()
    {
        $soxId      = oxConfig::getParameter( "oxid");
        $aParams    = oxConfig::getParameter( "editval");
        // checkbox handling
        if ( !isset( $aParams['oxcarriertracking__oxactive']))
            $aParams['oxcarriertracking__oxactive'] = 0;

        // adds space to the end of URL description to keep new added links visible
        // if URL description left empty
        if (isset($aParams['oxcarriertracking__oxshortdesc']) && strlen($aParams['oxoxcarriertracking__oxshortdesc']) == 0)
            $aParams['oxcarriertracking__oxshortdesc'] .= " ";

        if ( !$aParams['oxcarriertracking__oxinsert']) {
            // sets default (?) date format to output
            // else if possible - changes date format to system compatible
            $sDate = date(oxLang::getInstance()->translateString( "simpleDateFormat"));
            if ($sDate == "simpleDateFormat")
                $aParams['oxcarriertracking__oxinsert'] = date( "Y-m-d");
            else
                $aParams['oxcarriertracking__oxinsert'] = $sDate;
        }

        $iEditLanguage = oxConfig::getParameter("editlanguage");
        $oLinks = oxNew( "oxcarrier", getViewName( 'oxcarrier'));

        if ( $soxId != "-1") {
            //$oLinks->load( $soxId );
            $oLinks->loadInLang( $iEditLanguage, $soxId );

        } else {
            $aParams['oxcarriertracking__oxid'] = null;
        }

        //$aParams = $oLinks->ConvertNameArray2Idx( $aParams);

        $oLinks->setLanguage(0);
        $oLinks->assign( $aParams);
        $oLinks->setLanguage( $iEditLanguage );
        $oLinks->save();
        $this->_aViewData["updatelist"] = "1";


        // set oxid if inserted
        if ( $soxId == "-1")
            oxSession::setVar( "saved_oxid", $oLinks->oxcarriertracking__oxid->value);

        return $this->autosave();
    }

    /**
     * Saves link description in different languages (eg. english).
     *
     * @return null
     */
    public function saveinnlang()
    {
        $soxId      = oxConfig::getParameter( "oxid");
        $aParams    = oxConfig::getParameter( "editval");
        // checkbox handling
        if ( !isset( $aParams['oxcarriertracking__oxactive']))
            $aParams['oxcarriertracking__oxactive'] = 0;

            // shopid
            $sShopID = oxSession::getVar( "actshop");
            $aParams['oxcarriertracking__oxshopid'] = $sShopID;
        $oLinks = oxNew( "oxcarrier", getViewName( 'oxcarrier'));
        $iEditLanguage = oxConfig::getParameter("editlanguage");

        if( $soxId != "-1")
            $oLinks->loadInLang( $iEditLanguage, $soxId );
        else
            $aParams['oxcarriertracking__oxid'] = null;
        //$aParams = $oLinks->ConvertNameArray2Idx( $aParams);



        $oLinks->setLanguage(0);
        $oLinks->assign( $aParams);

        // apply new language
        $sNewLanguage = oxConfig::getParameter( "new_lang");
        $oLinks->setLanguage( $sNewLanguage);
        $oLinks->save();
        $this->_aViewData["updatelist"] = "1";

        // set oxid if inserted
        if ( $soxId == "-1")
            oxSession::setVar( "saved_oxid", $oLinks->oxcarriertracking__oxid->value);

        return $this->autosave();
    }
}
