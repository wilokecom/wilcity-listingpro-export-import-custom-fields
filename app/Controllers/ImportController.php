<?php

namespace WilcityListingProExportImport\Controllers;

use WilcityListingProExportImport\Helpers\CustomFields;

/**
 * Class ImportController
 * @package WilcityListingProExportImport\Controllers
 */
class ImportController
{
	/**
	 * ImportController constructor.
	 */
	public function __construct()
	{
		add_action('admin_menu', [$this, 'wilokeImportListingProData']);
		add_action('wp_ajax_wilcity_import_listingpro_custom_fields', [$this, 'wilcityImportListingProCustomFields']);

	}

	public function wilokeImportListingProData()
	{
		add_menu_page(
			'Import ListingPro Custom Fields',
			'Import ListingPro Custom Fields',
			'manage_options',
			'import-listingpro-custom-fields',
			[$this, 'wilokeImportListingProCustomFields']);
	}

	public function wilokeImportListingProCustomFields()
	{
		?>
        <div class="ui segment">
            <form id="wilcity-import-listingpro-custom-fields"
                  action="<?php echo admin_url('admin.php?page=import-listingpro-custom-fields'); ?>" method="POST"
                  class="form ui wilcity-import-listingpro" data-ajax="wilcity_import_listingpro_custom_fields">
                <div class="field">
                    <label for="listingpro_custom_field_data">Paste ListingPro Custom Fields Data To The Field
                        below</label>
                    <textarea name="listingpro_custom_field_data" id="listingpro_custom_field_data" class="data"
                              cols="30"
                              rows="10"></textarea>
                </div>
				<?php echo wp_nonce_field('wilcity_nonce_action', 'wilcity_nonce_fields'); ?>
                <input type="hidden" name="run_import_custom_fields" value="1">
                <div class="field">
                    <button type="submit" class="ui button green">Import Now</button>
                </div>
            </form>
        </div>
		<?php
	}

	public function wilcityImportVerifyNonce()
	{
		$status = check_ajax_referer('wilcity_nonce_action', 'nonce', false);
		if (!$status) {
			wp_send_json_success(array('msg' => 'Invalid Nonce'));
		}
	}

	/**
	 * wilcityImportListingProCustomFields
	 */
	public function wilcityImportListingProCustomFields()
	{
		$this->wilcityImportVerifyNonce();

		if (current_user_can('administrator')) {
			$aCustomFieldData = [];
			if (!empty($_POST['data'])) {
				$aCustomFieldData = $_POST['data'];
			}

			if (!empty($aCustomFieldData)) {
				if (is_string($aCustomFieldData)) {
					$aParseData = unserialize(base64_decode($aCustomFieldData));
				} else if (is_array($aCustomFieldData)) {
					$aParseData = unserialize(base64_decode($aCustomFieldData)['custom_field']);
				}

				if (!empty($aParseData)) {
					foreach ($aParseData as $slug => $aCustomFields) {
						$postID = CustomFields::wilokeImportFindPostIDBySlug($slug);
						if (empty($postID)) {
							continue;
						}
						$postID = abs($postID);
						foreach ($aCustomFields as $fieldKey => $data) {
							\WilokeListingTools\Framework\Helpers\SetSettings::setPostMeta($postID, 'custom_' .
								$fieldKey, $data);
						}
					}
				}
			}
			wp_send_json_success(array('msg' => 'Congratulations! The custom fields have been imported successfully'));
		} else {
			wp_send_json_error(array('msg' => 'You do not have permission to access this page.'));
		}

	}
}


