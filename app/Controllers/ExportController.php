<?php

namespace WilcityListingProExportImport\Controllers;

/**
 * Class ExportController
 * @package WilcityListingProExportImport\Controllers
 */
class ExportController
{
	public function __construct()
	{
		add_action('admin_menu', [$this,'wilokeExportListingProData']);
	}

	public function wilokeExportListingProData()
	{
		add_menu_page(
			'Export ListingPro Custom Fields',
			'Export ListingPro Custom Fields',
			'manage_options',
			'export-listingpro-custom-fields',
			[$this, 'wilokeExportListingProCustomFields']);
	}

	public function wilokeExportListingProCustomFields()
	{
		$aFields = [];
		if (isset($_POST['run_export_custom_fields']) && !empty($_POST['run_export_custom_fields'])) {
			$query = new \WP_Query(
				[
					'post_type'      => 'listing',
					'posts_per_page' => absint($_POST['listings_per_export']),
					'paged'          => abs($_POST['listing_page'])
                ]
			);

			if ($query->have_posts()) {
				while ($query->have_posts()) {
					$query->the_post();
					$data = get_post_meta($query->post->ID, 'lp_listingpro_options_fields', true);
					if (empty($data)) {
						$aFields[$query->post->post_name] = '';
					} else {
						$aFields[$query->post->post_name] = $data;
					}
				}
			}
		}
		?>
        <div class="ui segment">
            <h1 class="ui heading dividing">Export ListingPro Custom Fields</h1>
            <form action="<?php echo admin_url('admin.php?page=export-listingpro-custom-fields'); ?>" method="POST"
                  class="form ui">
				<?php if (!empty($aFields)) : ?>
                    <div class="field">
                        <label for="terms-options-data">Copy This Data and Parse To Wiloke ListingPro Import -> Import
                            Custom
                            Fields</label>
                        <textarea cols="30" rows="10"><?php echo base64_encode(serialize($aFields)); ?></textarea>
                    </div>

				<?php endif; ?>
                <div class="field">
                    <label for="listings-per-export">Maximum Listings / Export</label>
                    <input id="listings-per-export" type="text" name="listings_per_export" value="100">
                </div>
                <div class="field">
                    <label for="terms-options-data">Current Page</label>
                    <p>Assume we wish to export all listings from 1 - 30 (inclusive). You should enter Maximum Listings
                        = 30
                        and Current Page. Current page = 2 means it will export start on 31.</p>
                    <input id="listings-page" type="text" name="listing_page" value="1">
                </div>

                <input type="hidden" name="run_export_custom_fields" value="1">
                <div class="field">
                    <button class="ui button green">Export Custom Fields</button>
                </div>
            </form>
        </div>
		<?php
	}
}
