<?php
/**
 * Plugin Name: Wilcity Listing Pro Export Import Custom Fields
 * Author: Wilcity
 * Author URI: https://wilcityservice.com
 * Description: Export from Listing Pro and Import to Wilcity
 * Text Domain: wilcity-listingpro-export-import
 * Version: 1.0
 */

define ('IMPORT_EXPORT_WILCITY_LISTING_PRO_DIR', plugin_dir_url(__FILE__));
require plugin_dir_path(__FILE__) . 'vendor/autoload.php';

new \WilcityListingProExportImport\Controllers\EnqueueScriptController();
new \WilcityListingProExportImport\Controllers\ExportController();
new \WilcityListingProExportImport\Controllers\ImportController();