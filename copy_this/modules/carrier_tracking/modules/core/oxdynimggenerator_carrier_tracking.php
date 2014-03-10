<?php

/**
 *
 * @link https://github.com/OXIDprojects/carrier_tracking
 * @package modules / core
 */

/**
 * currently not used
 *
 * Class oxdynimggenerator_carrier_tracking
 */
class oxdynimggenerator_carrier_tracking extends oxdynimggenerator_carrier_tracking_parent
{
    /**
     * Map of config parameter to requested image path
     * @var array
     */
    protected $_aConfParamToPath = array( // ** product
                                          "sIconsize"             => '/.*\/generated\/product\/(icon|\d+)\/\d+\_\d+\_\d+$/',  // Icon size
                                          "sThumbnailsize"        => '/.*\/generated\/product\/(thumb|\d+)\/\d+\_\d+\_\d+$/', // Thumbnail size
                                          "sZoomImageSize"        => '/.*\/generated\/product\/\d+\/\d+\_\d+\_\d+$/',         // Zoom picture size
                                          "aDetailImageSizes"     => '/.*\/generated\/product\/\d+\/\d+\_\d+\_\d+$/',         // Product picture size

                                          // ** manufacturer/vendor
                                          "sManufacturerIconsize" => '/.*\/generated\/(manufacturer|vendor)\/icon\/\d+\_\d+\_\d+$/', // Manufacturer's|brand logo size

                                          // ** category
                                          "sCatThumbnailsize"     => '/.*\/generated\/category\/thumb\/\d+\_\d+\_\d+$/',     // Category picture size
                                          "sCatIconsize"          => '/.*\/generated\/category\/icon\/\d+\_\d+\_\d+$/',      // Size of a subcategory's picture
                                          "sCatPromotionsize"     => '/.*\/generated\/category\/promo_icon\/\d+\_\d+\_\d+$/', // Category picture size for promotion on startpage

                                          // ** carrier
                                          "sCarrierIconSsize"     => '/.*\/generated\/carrier\/icon\/\d+\_\d+\_\d+$/' // carrier logo size
    );


}