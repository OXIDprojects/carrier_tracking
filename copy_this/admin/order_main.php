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
 * @copyright � OXID eSales AG 2003-2009
 * $Id: order_main.php 14542 2008-12-08 14:24:48Z vilma $
 */

/**
 * Admin article main order manager.
 * Performs collection and updatind (on user submit) main item information.
 * Admin Menu: Orders -> Display Orders -> Main.
 * @package admin
 */
class Order_Main extends oxAdminDetails
{
    /**
     * Executes parent method parent::render(), creates oxorder and
     * oxuserpayment objects, passes data to Smarty engine and returns
     * name of template file "order_main.tpl".
     *
     * @return string
     */
    public function render()
    {
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
            $oOrder = oxNew( "oxorder" );
            $oOrder->Load( $soxId);

            // paid ?
            if ( $oOrder->oxorder__oxpaid->value != "0000-00-00 00:00:00") {
                $oOrder->blIsPaid = true;
                $oOrder->oxorder__oxpaid->setValue( oxUtilsDate::getInstance()->formatDBDate( $oOrder->oxorder__oxpaid->value));
            }

            $this->_aViewData["edit"] =  $oOrder;
            $this->_aViewData["paymentType"] =  $oOrder->getPaymentType();

            $this->_aViewData["oShipSet"] =  $oOrder->getShippingSetList();
            if ( $oOrder->oxorder__oxdeltype->value ) {

                // order user
                $oUser = oxNew( 'oxuser' );
                $oUser->load( $oOrder->oxorder__oxuserid->value );

                // order sum in default currency
                $dPrice = $oOrder->oxorder__oxtotalbrutsum->value / $oOrder->oxorder__oxcurrate->value;

                $this->_aViewData["oPayments"] =  oxPaymentList::getInstance()->getPaymentList( $oOrder->oxorder__oxdeltype->value, $dPrice, $oUser );
            }

            // any voucher used ?
            $this->_aViewData["aVouchers"] =  $oOrder->getVoucherNrList();
        }

        $this->_aViewData["sNowValue"] = date("Y-m-d H:i:s", oxUtilsDate::getInstance()->getTime());
		
		$oCarrierList = oxNew( "oxCarrierList" );
        $oCarrierList->loadActiveCarriers(  );

        $this->_aViewData["carrierlist"] = $oCarrierList;

        return "order_main.tpl";
    }

    /**
     * Saves main orders configuration parameters.
     *
     * @return string
     */
    public function save()
    {

        $soxId      = oxConfig::getParameter( "oxid");
        $aParams    = oxConfig::getParameter( "editval");
        $aDynvalues = oxConfig::getParameter( "dynvalue");

        $blChangeDelivery = false;

            // shopid
            $sShopID = oxSession::getVar( "actshop");
            $aParams['oxorder__oxshopid'] = $sShopID;

        $oOrder = oxNew( "oxorder" );
        if ( $soxId != "-1") {
            $oOrder->load( $soxId);
            if ( $oOrder->oxorder__oxdelcost->value != $aParams['oxorder__oxdelcost'] ) {
                $blChangeDelivery = true;
            }
        } else {
            $aParams['oxorder__oxid'] = null;
        }

        $oOrder->assign( $aParams);

        if ( isset( $aDynvalues)) {
            // #411 Dodger
            $oPayment = oxNew( "oxuserpayment" );
            $oPayment->load( $oOrder->oxorder__oxpaymentid->value);
            $oPayment->oxuserpayments__oxvalue->setValue(oxUtils::getInstance()->assignValuesToText( $aDynvalues));
            $oPayment->save();
        }

        $oOrder->save();

        $oOrder->recalculateOrder( array(), $blChangeDelivery );

        // set oxid if inserted
        if ( $soxId == "-1")
            oxSession::setVar( "saved_oxid", $oOrder->oxorder__oxid->value);


        return $this->autosave();
    }

    /**
     * Sends order.
     *
     * @return null
     */
    public function sendorder()
    {
        $soxId  = oxConfig::getParameter( "oxid");
        $oOrder = oxNew( "oxorder" );
        $oOrder->load( $soxId);

        // #632A
        $timeout = oxUtilsDate::getInstance()->getTime(); //time();
        $now = date("Y-m-d H:i:s", $timeout);
        $oOrder->oxorder__oxsenddate->setValue($now);
        $oOrder->save();

        // #1071C
        $oOrderArticles = $oOrder->getOrderArticles();
        foreach ( $oOrderArticles as $oxid=>$oArticle) {
            // remove canceled articles from list
            if ( $oArticle->oxorderarticles__oxstorno->value == 1 )
                $oOrderArticles->offsetUnset($oxid);
        }

        $blMail  = oxConfig::getParameter( "sendmail");
        if ( isset( $blMail) && $blMail) {
            // send eMail

            $oxEMail = oxNew( "oxemail" );
            $oxEMail->SendSendedNowMail( $oOrder );
        }

    }

    /**
     * Resets order shipping date.
     *
     * @return null
     */
    public function resetorder()
    {
        $soxId  = oxConfig::getParameter( "oxid");
        $oOrder = oxNew( "oxorder" );
        $oOrder->load( $soxId);

        $oOrder->oxorder__oxsenddate->setValue("0000-00-00 00:00:00");
        $oOrder->save();

    }

    /**
     * Changes delivery set for this order and
     * resets current payment.
     *
     * @return null
     */
    public function changeDelSet()
    {
        $soxId  = oxConfig::getParameter( "oxid");
        $oOrder = oxNew( "oxorder" );
        if ($oOrder->load( $soxId)) {
            $sDelType = oxConfig::getParameter( "setDelSet");
            $oOrder->oxorder__oxdeltype->setValue($sDelType);
            $oOrder->oxorder__oxpaymenttype->setValue("oxempty");
            $oOrder->save();

            $oOrder->recalculateOrder( array() );
        }
    }

    /**
     * Changes delivery set for this order and
     * resets current payment.
     *
     * @return null
     */
    public function changePayment()
    {
        $soxId  = oxConfig::getParameter( "oxid");
        $oOrder = oxNew( "oxorder" );
        if ($oOrder->load( $soxId)) {
            $sPayment = oxConfig::getParameter( "setPayment");
            $oOrder->oxorder__oxpaymenttype->setValue($sPayment);
            $oOrder->save();

            $oOrder->recalculateOrder( array() );
        }
    }
}
