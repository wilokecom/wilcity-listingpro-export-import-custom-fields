<?php

namespace WilcityListingProExportImport\Controllers;

/**
 * Class ExportController
 * @package WilcityListingProExportImport\Controllers
 */
class EnqueueScriptController
{
	public function __construct()
	{
		add_action('admin_enqueue_scripts', [$this,'enqueueStyleAndScriptController']);
	}

	public function enqueueStyleAndScriptController()
	{
		wp_enqueue_style('semantic', IMPORT_EXPORT_WILCITY_LISTING_PRO_DIR . 'asset/Semantic-UI-CSS-master/semantic.css');
		wp_enqueue_script('wilcity-import-listingpro', IMPORT_EXPORT_WILCITY_LISTING_PRO_DIR .
			'source/js/script.js', ['jquery'], 1.1, true);
	}
}
