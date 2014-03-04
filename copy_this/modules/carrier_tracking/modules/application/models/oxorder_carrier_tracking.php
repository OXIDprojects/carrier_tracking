<?php

/**
 * Class oxorder_carrier_tracking
 */
class oxorder_carrier_tracking extends oxorder_carrier_tracking_parent
{
    /**
     * @var string
     */
    protected $_sCarrierFallBackUrl = "http://www.dpd.de/cgi-bin/delistrack?typ=1&amp;lang=de&amp;pknr=";

    /**
     * Returns shipment tracking url if oxorder__oxtrackcode is supplied
     *
     * @return string
     */
    public function getShipmentTrackingUrl()
    {
        $sTrackAddress = $this->getFieldData('OXCARRIERURL');
        $sCarrierID    = $this->getFieldData('OXCARRIERID');
        $sTrackinCode  = $this->getFieldData('OXTRACKCODE');

        if ($sTrackinCode == '') {
            return '';
        }

        if ($sTrackAddress == '' && $sCarrierID == '') {
            $sPath = $this->_sCarrierFallBackUrl;

        } elseif ($sTrackAddress != '' && $sCarrierID == '') {
            $sPath = $sTrackAddress;

        } elseif ($sTrackAddress == '' && $sCarrierID != '') {
            /** @var oxcarrier $oCarrier */
            $oCarrier = oxnew('oxcarrier');
            $oCarrier->load($sCarrierID);
            $sPath = $oCarrier->getFieldData('OXCARRIERURL');

        } elseif ($sTrackAddress != '' && $sCarrierID != '') {
            $sPath = $sTrackAddress;
        } else {
            $sPath = $this->_sCarrierFallBackUrl;

        }

        return $sPath . $sTrackinCode;
    }

    /**
     * @return oxcarrier
     */
    public function getCarrier()
    {
        /** @var oxcarrier $oCarrier */
        $oCarrier = oxnew('oxcarrier');
        $oCarrier->load($this->getFieldData('OXCARRIERID'));
        return $oCarrier;
    }

    /**
     * @return mixed
     * AlternativeShipmentTrackingUrl
     */
    public function getAlternativeShipmentTrackingUrl()
    {
        return $this->getFieldData('OXCARRIERURL');
    }
}