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
 * $Id: carrier_list.php 14017 2008-11-06 13:32:23Z arvydas $
 */

/**
 * Admin links collection.
 * Collects list of admin links. Links may be viewed by language, sorted by date,
 * url or any keyword.
 * Admin Menu: Customer News -> Links.
 * @package admin
 */
class Carrier_List extends oxAdminList
{
    /**
     * Current class template name.
     * @var string
     */
    protected $_sThisTemplate = 'carrier_list.tpl';

    /**
     * Name of chosen object class (default null).
     *
     * @var string
     */
    protected $_sListClass = 'oxcarrier';

    /**
     * Sets default list sorting field (oxinsert) and executes parent method parent::Init().
     *
     * @return null
     */
    public function init()
    {
        $this->_sDefSort = "oxinsert";
        $sSortCol = oxConfig::getParameter( 'sort' );

        if ( !$sSortCol || $sSortCol == $this->_sDefSort ) {
            $this->_blDesc = true;
        }

        parent::Init();

    }
}
