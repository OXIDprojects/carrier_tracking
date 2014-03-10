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
 * @package admin
 */

/**
 * Admin carrier collection.
 * Collects list of carriers. Carrier may be viewed by language, sorted by title.
 * Admin Menu: Settings -> Parcel Service.
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
     * Default SQL sorting parameter (default null).
     *
     * @var string
     */
    protected $_sDefSortField = 'oxtitle';

    /**
     * Enable/disable sorting by DESC (SQL) (default false - disable).
     *
     * @var bool
     */
    protected $_blDesc = false;
}
