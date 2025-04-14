<?php // phpcs:ignore
/**
 * Helpers
 *
 * @package App
 */

namespace App;

/**
 * Helpers
 */
class Helpers {
	/**
	 * Get theme manifest
	 *
	 * @return bool|array
	 */
	public static function get_theme_manifest() {
		$file = get_template_directory() . '/dist/manifest.json';

		return json_decode( file_get_contents( $file ), true ); // phpcs:ignore
	}
}
