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
 */

/**
 *  *
 * Metadata version
 */
$sMetadataVersion = '1.1';

/**
 * Module information
 */
$aModule = array(
'id'          => 'carrier_tracking',
'title'       => array(
'de' => 'Paketdienste verwalten',
'en' => 'Parcel Service',
),
'description' => array(
'de' => '
Eine einfache Verwaltung von Paketdiensten und deren Trackingsm&ouml;glichkeiten.<br>
Damit können beliebige viele Dienstleister im Shop angelegt werden und inviduell jeder Bestellung als Versender und damit als Trackingurl hinterlegt werden.

<br>
<br>Author der Version 1.0 kann nicht mehr genau ermittelt werden(vermutlich eine Praktikumsarbeit bei Oxid).
',
'en' => 'A simple package management of services and their tracking capabilities.<br>
This allows any number of service providers are created in the shop and inviduell every order be so deposited as senders and as Trackingurl.
<br>
<br>
Author version 1.0 can not be accurately determined (probably a practical work at Oxid).
',
),
'thumbnail'   => '',
'version'     => '2.0',
'author'      => 'Markus Gärtner',
'url'         => 'https://github.com/OXIDprojects/carrier_tracking',
'email'       => 'mg@projekt-one.de',
'extend'      => array(
'order_main'        => 'carrier_tracking/modules/application/controllers/admin/order_main_carrier_tracking',
'oxorder'           => 'carrier_tracking/modules/application/models/oxorder_carrier_tracking',
'oxutilsfile'       => 'carrier_tracking/modules/core/oxutilsfile_carrier_tracking',
#'oxdynimggenerator' => 'carrier_tracking/modules/core/oxdynimggenerator_carrier_tracking',

),
'files' => array(
    // models
    'oxCarrier'     => 'carrier_tracking/models/oxcarrier.php',
    'oxCarrierList' => 'carrier_tracking/models/oxcarrierlist.php',
    // admin
    'Carrier'       => 'carrier_tracking/controllers/admin/carrier.php',
    'Carrier_list'  => 'carrier_tracking/controllers/admin/carrier_list.php',
    'Carrier_main'  => 'carrier_tracking/controllers/admin/carrier_main.php',
),
'events'      => array(
),
'templates' => array(
'carrier.tpl'      => 'carrier_tracking/views/admin/tpl/carrier.tpl',
'carrier_list.tpl' => 'carrier_tracking/views/admin/tpl/carrier_list.tpl',
'carrier_main.tpl' => 'carrier_tracking/views/admin/tpl/carrier_main.tpl',

),
'blocks' => array(
array(
'template' => 'bottomnaviitem.tpl',
'block'    => 'admin_bottomnavicustom',
'file'     => 'views/admin/blocks/admin_bottomnavicustom.tpl'
),

array(
'template' => 'order_main.tpl',
'block'    => 'admin_order_main_form_tracking',
'file'     => 'views/admin/blocks/admin_order_main_form_tracking.tpl'
),

array(
'template' => 'page/account/order.tpl',
'block'    => 'account_order_history_orderitem_tracking',
'file'     => 'views/azure/blocks/page/account/account_order_history_orderitem_tracking.tpl'
),

array(
'template' => 'page/account/order.tpl',
'block'    => 'mb_account_order_history_orderitem_tracking',
'file'     => 'views/mobile/blocks/page/account/account_order_history_orderitem_tracking.tpl'
),

),
'settings'    => array()
);