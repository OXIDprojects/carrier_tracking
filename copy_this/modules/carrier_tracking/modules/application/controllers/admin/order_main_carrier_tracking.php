<?php

/**
 * Class order_main_carrier_tracking
 */
class order_main_carrier_tracking extends order_main_carrier_tracking_parent
{
    /**
     *
     */
    public function getCarrierList()
    {
        /** @var oxCarrierList $oCarrierList */
        $oCarrierList = oxNew( "oxCarrierList" );
        $oCarrierList->loadActiveCarriers();
        return $oCarrierList;
    }
}