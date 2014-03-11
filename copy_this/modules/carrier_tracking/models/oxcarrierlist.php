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
 * @package models
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
    }

    /**
     * Selects and loads all active countries
     */
    public function loadActiveCarriers()
    {
        $sTableCarrier = getViewName('oxcarriers');
        $sSelect = "SELECT * FROM ".$sTableCarrier." WHERE oxactive = '1' ORDER BY oxtitle ";
        $this->selectString($sSelect);
    }
}
