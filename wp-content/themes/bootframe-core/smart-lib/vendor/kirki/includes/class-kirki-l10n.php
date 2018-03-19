<?php
/**
 * Internationalization helper.
 *
 * @package     Kirki
 * @category    Core
 * @author      Aristeides Stathopoulos
 * @copyright   Copyright (c) 2016, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */

if ( ! class_exists( 'Kirki_l10n' ) ) {

	/**
	 * Handles translations
	 */
	class Kirki_l10n {

		/**
		 * The plugin textdomain
		 *
		 * @access protected
		 * @var string
		 */
		protected $textdomain = 'kirki';

		/**
		 * The class constructor.
		 * Adds actions & filters to handle the rest of the methods.
		 *
		 * @access public
		 */
		public function __construct() {

			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		}

		/**
		 * Load the plugin textdomain
		 *
		 * @access public
		 */
		public function load_textdomain() {

			if ( null !== $this->get_path() ) {
				load_textdomain( $this->textdomain, $this->get_path() );
			}
			load_plugin_textdomain( $this->textdomain, false, Kirki::$path . '/languages' );

		}

		/**
		 * Gets the path to a translation file.
		 *
		 * @access protected
		 * @return string Absolute path to the translation file.
		 */
		protected function get_path() {
			$path_found = false;
			$found_path = null;
			foreach ( $this->get_paths() as $path ) {
				if ( $path_found ) {
					continue;
				}
				$path = wp_normalize_path( $path );
				if ( file_exists( $path ) ) {
					$path_found = true;
					$found_path = $path;
				}
			}

			return $found_path;

		}

		/**
		 * Returns an array of paths where translation files may be located.
		 *
		 * @access protected
		 * @return array
		 */
		protected function get_paths() {

			return array(
				WP_LANG_DIR . '/' . $this->textdomain . '-' . get_locale() . '.mo',
				Kirki::$path . '/languages/' . $this->textdomain . '-' . get_locale() . '.mo',
			);

		}

		/**
		 * Shortcut method to get the translation strings
		 *
		 * @static
		 * @access public
		 * @param string $config_id The config ID. See Kirki_Config.
		 * @return array
		 */
		public static function get_strings( $config_id = 'global' ) {

			$translation_strings = array(
				'background-color'      => esc_attr__( 'Background Color', 'bootframe-core'),
				'background-image'      => esc_attr__( 'Background Image', 'bootframe-core'),
				'no-repeat'             => esc_attr__( 'No Repeat', 'bootframe-core'),
				'repeat-all'            => esc_attr__( 'Repeat All', 'bootframe-core'),
				'repeat-x'              => esc_attr__( 'Repeat Horizontally', 'bootframe-core'),
				'repeat-y'              => esc_attr__( 'Repeat Vertically', 'bootframe-core'),
				'inherit'               => esc_attr__( 'Inherit', 'bootframe-core'),
				'background-repeat'     => esc_attr__( 'Background Repeat', 'bootframe-core'),
				'cover'                 => esc_attr__( 'Cover', 'bootframe-core'),
				'contain'               => esc_attr__( 'Contain', 'bootframe-core'),
				'background-size'       => esc_attr__( 'Background Size', 'bootframe-core'),
				'fixed'                 => esc_attr__( 'Fixed', 'bootframe-core'),
				'scroll'                => esc_attr__( 'Scroll', 'bootframe-core'),
				'background-attachment' => esc_attr__( 'Background Attachment', 'bootframe-core'),
				'left-top'              => esc_attr__( 'Left Top', 'bootframe-core'),
				'left-center'           => esc_attr__( 'Left Center', 'bootframe-core'),
				'left-bottom'           => esc_attr__( 'Left Bottom', 'bootframe-core'),
				'right-top'             => esc_attr__( 'Right Top', 'bootframe-core'),
				'right-center'          => esc_attr__( 'Right Center', 'bootframe-core'),
				'right-bottom'          => esc_attr__( 'Right Bottom', 'bootframe-core'),
				'center-top'            => esc_attr__( 'Center Top', 'bootframe-core'),
				'center-center'         => esc_attr__( 'Center Center', 'bootframe-core'),
				'center-bottom'         => esc_attr__( 'Center Bottom', 'bootframe-core'),
				'background-position'   => esc_attr__( 'Background Position', 'bootframe-core'),
				'background-opacity'    => esc_attr__( 'Background Opacity', 'bootframe-core'),
				'on'                    => esc_attr__( 'ON', 'bootframe-core'),
				'off'                   => esc_attr__( 'OFF', 'bootframe-core'),
				'all'                   => esc_attr__( 'All', 'bootframe-core'),
				'cyrillic'              => esc_attr__( 'Cyrillic', 'bootframe-core'),
				'cyrillic-ext'          => esc_attr__( 'Cyrillic Extended', 'bootframe-core'),
				'devanagari'            => esc_attr__( 'Devanagari', 'bootframe-core'),
				'greek'                 => esc_attr__( 'Greek', 'bootframe-core'),
				'greek-ext'             => esc_attr__( 'Greek Extended', 'bootframe-core'),
				'khmer'                 => esc_attr__( 'Khmer', 'bootframe-core'),
				'latin'                 => esc_attr__( 'Latin', 'bootframe-core'),
				'latin-ext'             => esc_attr__( 'Latin Extended', 'bootframe-core'),
				'vietnamese'            => esc_attr__( 'Vietnamese', 'bootframe-core'),
				'hebrew'                => esc_attr__( 'Hebrew', 'bootframe-core'),
				'arabic'                => esc_attr__( 'Arabic', 'bootframe-core'),
				'bengali'               => esc_attr__( 'Bengali', 'bootframe-core'),
				'gujarati'              => esc_attr__( 'Gujarati', 'bootframe-core'),
				'tamil'                 => esc_attr__( 'Tamil', 'bootframe-core'),
				'telugu'                => esc_attr__( 'Telugu', 'bootframe-core'),
				'thai'                  => esc_attr__( 'Thai', 'bootframe-core'),
				'serif'                 => _x( 'Serif', 'font style', 'bootframe-core'),
				'sans-serif'            => _x( 'Sans Serif', 'font style', 'bootframe-core'),
				'monospace'             => _x( 'Monospace', 'font style', 'bootframe-core'),
				'font-family'           => esc_attr__( 'Font Family', 'bootframe-core'),
				'font-size'             => esc_attr__( 'Font Size', 'bootframe-core'),
				'font-weight'           => esc_attr__( 'Font Weight', 'bootframe-core'),
				'line-height'           => esc_attr__( 'Line Height', 'bootframe-core'),
				'font-style'            => esc_attr__( 'Font Style', 'bootframe-core'),
				'letter-spacing'        => esc_attr__( 'Letter Spacing', 'bootframe-core'),
				'top'                   => esc_attr__( 'Top', 'bootframe-core'),
				'bottom'                => esc_attr__( 'Bottom', 'bootframe-core'),
				'left'                  => esc_attr__( 'Left', 'bootframe-core'),
				'right'                 => esc_attr__( 'Right', 'bootframe-core'),
				'center'                => esc_attr__( 'Center', 'bootframe-core'),
				'justify'               => esc_attr__( 'Justify', 'bootframe-core'),
				'color'                 => esc_attr__( 'Color', 'bootframe-core'),
				'add-image'             => esc_attr__( 'Add Image', 'bootframe-core'),
				'change-image'          => esc_attr__( 'Change Image', 'bootframe-core'),
				'no-image-selected'     => esc_attr__( 'No Image Selected', 'bootframe-core'),
				'add-file'              => esc_attr__( 'Add File', 'bootframe-core'),
				'change-file'           => esc_attr__( 'Change File', 'bootframe-core'),
				'no-file-selected'      => esc_attr__( 'No File Selected', 'bootframe-core'),
				'remove'                => esc_attr__( 'Remove', 'bootframe-core'),
				'select-font-family'    => esc_attr__( 'Select a font-family', 'bootframe-core'),
				'variant'               => esc_attr__( 'Variant', 'bootframe-core'),
				'subsets'               => esc_attr__( 'Subset', 'bootframe-core'),
				'size'                  => esc_attr__( 'Size', 'bootframe-core'),
				'height'                => esc_attr__( 'Height', 'bootframe-core'),
				'spacing'               => esc_attr__( 'Spacing', 'bootframe-core'),
				'ultra-light'           => esc_attr__( 'Ultra-Light 100', 'bootframe-core'),
				'ultra-light-italic'    => esc_attr__( 'Ultra-Light 100 Italic', 'bootframe-core'),
				'light'                 => esc_attr__( 'Light 200', 'bootframe-core'),
				'light-italic'          => esc_attr__( 'Light 200 Italic', 'bootframe-core'),
				'book'                  => esc_attr__( 'Book 300', 'bootframe-core'),
				'book-italic'           => esc_attr__( 'Book 300 Italic', 'bootframe-core'),
				'regular'               => esc_attr__( 'Normal 400', 'bootframe-core'),
				'italic'                => esc_attr__( 'Normal 400 Italic', 'bootframe-core'),
				'medium'                => esc_attr__( 'Medium 500', 'bootframe-core'),
				'medium-italic'         => esc_attr__( 'Medium 500 Italic', 'bootframe-core'),
				'semi-bold'             => esc_attr__( 'Semi-Bold 600', 'bootframe-core'),
				'semi-bold-italic'      => esc_attr__( 'Semi-Bold 600 Italic', 'bootframe-core'),
				'bold'                  => esc_attr__( 'Bold 700', 'bootframe-core'),
				'bold-italic'           => esc_attr__( 'Bold 700 Italic', 'bootframe-core'),
				'extra-bold'            => esc_attr__( 'Extra-Bold 800', 'bootframe-core'),
				'extra-bold-italic'     => esc_attr__( 'Extra-Bold 800 Italic', 'bootframe-core'),
				'ultra-bold'            => esc_attr__( 'Ultra-Bold 900', 'bootframe-core'),
				'ultra-bold-italic'     => esc_attr__( 'Ultra-Bold 900 Italic', 'bootframe-core'),
				'invalid-value'         => esc_attr__( 'Invalid Value', 'bootframe-core'),
				'add-new'           	=> esc_attr__( 'Add new', 'bootframe-core'),
				'row'           		=> esc_attr__( 'row', 'bootframe-core'),
				'limit-rows'            => esc_attr__( 'Limit: %s rows', 'bootframe-core'),
				'open-section'          => esc_attr__( 'Press return or enter to open this section', 'bootframe-core'),
				'back'                  => esc_attr__( 'Back', 'bootframe-core'),
				'reset-with-icon'       => sprintf( esc_attr__( '%s Reset', 'bootframe-core'), '<span class="dashicons dashicons-image-rotate"></span>' ),
				'text-align'            => esc_attr__( 'Text Align', 'bootframe-core'),
				'text-transform'        => esc_attr__( 'Text Transform', 'bootframe-core'),
				'none'                  => esc_attr__( 'None', 'bootframe-core'),
				'capitalize'            => esc_attr__( 'Capitalize', 'bootframe-core'),
				'uppercase'             => esc_attr__( 'Uppercase', 'bootframe-core'),
				'lowercase'             => esc_attr__( 'Lowercase', 'bootframe-core'),
				'initial'               => esc_attr__( 'Initial', 'bootframe-core'),
				'select-page'           => esc_attr__( 'Select a Page', 'bootframe-core'),
				'open-editor'           => esc_attr__( 'Open Editor', 'bootframe-core'),
				'close-editor'          => esc_attr__( 'Close Editor', 'bootframe-core'),
				'switch-editor'         => esc_attr__( 'Switch Editor', 'bootframe-core'),
				'hex-value'             => esc_attr__( 'Hex Value', 'bootframe-core'),
			);

			// Apply global changes from the kirki/config filter.
			// This is generally to be avoided.
			// It is ONLY provided here for backwards-compatibility reasons.
			// Please use the kirki/{$config_id}/l10n filter instead.
			$config = apply_filters( 'kirki/config', array() );
			if ( isset( $config['i18n'] ) ) {
				$translation_strings = wp_parse_args( $config['i18n'], $translation_strings );
			}

			// Apply l10n changes using the kirki/{$config_id}/l10n filter.
			return apply_filters( 'kirki/' . $config_id . '/l10n', $translation_strings );

		}
	}
}
