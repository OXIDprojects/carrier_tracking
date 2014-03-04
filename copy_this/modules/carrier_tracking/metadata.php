<?php

/**
 * Metadata version
 */
$sMetadataVersion = '1.1';

/**
 * Module information
 */
$aModule = array(
'id'          => 'carrier_tracking',
'title'       => 'Paketdienste verwalten',
'description' => array(
'de' => '',
'en' => '',
),
'thumbnail'   => 'logo.jpg',
'version'     => '2.0',
'author'      => 'OXID eSales AG',
'url'         => 'http://www.oxid-esales.com',
'email'       => 'info@oxid-esales.com',
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