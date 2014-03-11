<?php

/**
 * carrier_tacking / parcel service / Paketdienste
 *
 * This file is part of the module carrier_tacking for OXID eShop Community Edition.
 *
 * The module carrier_tacking for OXID eShop Community Edition is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * The module carrier_tacking for OXID eShop Community Edition is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OXID eShop Community Edition. If not, see <http://www.gnu.org/licenses/>.
 *
 * @link https://github.com/OXIDprojects/carrier_tracking
 * @package controlles / admin
 */

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