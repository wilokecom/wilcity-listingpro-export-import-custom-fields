<?php
namespace WilcityListingProExportImport\Helpers;

/**
 * Class CustomFields
 * @package WilcityListingProExportImport\Helpers
 */
class CustomFields
{
	public static function replaceUpperCaseWithUnderscore($string): string {
		return preg_replace_callback('/\B([A-Z])/', function ($aMatches) {
			return '_'.strtolower($aMatches[1]);
		}, $string);
	}

	/**
	 * @param $slug
	 * @return string|null
	 */
	public  static function wilokeImportFindPostIDBySlug($slug)
	{
		global $wpdb;
		$postID = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT ID FROM $wpdb->posts WHERE post_name=%s ORDER BY $wpdb->posts.ID DESC",
				$slug
			)
		);
		return $postID;
	}
}
