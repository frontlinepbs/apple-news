<?php
namespace Apple_Exporter;

/**
 * Settings used in exporting. In a WordPress context, these can be loaded
 * as WordPress options defined in the plugin.
 */
class Settings {

	/**
	 * Exporter's default settings.
	 *
	 * @var array
	 * @access private
	 */
	private $settings = array(
		// API information.
		'api_key'         => '',
		'api_secret'      => '',
		'api_channel'     => '',
		'api_autosync'    => 'yes',
		'api_autosync_update'    => 'yes',
		'api_async'    => 'no',

		'post_types'      => array( 'post' ),
		'show_metabox'    => 'no',

		'layout_margin'   => 100,
		'layout_gutter'   => 20,

		'body_font'        => 'Roboto-Regular',
		'body_size'        => 18,
		'body_color'       => '#000',
		'body_link_color'  => '#428BCA',
		'body_orientation' => 'left',
		'body_line_height' => 24,

		'initial_dropcap' => 'yes',
		'dropcap_font'    => 'Roboto-Regular',
		'dropcap_color'   => '#000',

		'byline_font'     => 'Roboto-Regular',
		'byline_size'     => 17,
		'byline_color'    => '#53585F',
		'byline_format'		=> 'by #author# | #M j, Y | g:i A#',

		'header_font'     => 'CooperHewitt-Medium',
		'header_color'    => '#000',
		'header1_size'    => 48,
		'header2_size'    => 32,
		'header3_size'    => 24,
		'header4_size'    => 21,
		'header5_size'    => 18,
		'header6_size'    => 16,
		'header_line_height' => 52,

		'pullquote_font'  => 'Roboto-Regular',
		'pullquote_size'  => 48,
		'pullquote_color' => '#53585F',
		'pullquote_transform' => 'uppercase',
		'pullquote_line_height' => 48,

		'fl_quote_font'  => 'Roboto-Regular',
		'fl_quote_size'  => 48,
		'fl_quote_color' => '#53585F',
		'fl_quote_line_height' => 48,

		'fl_quote_highlight_font'  => 'Roboto-Regular',
		'fl_quote_highlight_size'  => 72,
		'fl_quote_highlight_color' => '#53585F',
		'fl_quote_highlight_line_height' => 72,

		'fl_quote_attribution_font'  => 'Roboto-Regular',
		'fl_quote_attribution_size'  => 12,
		'fl_quote_attribution_color' => '#53585F',
		'fl_quote_attribution_line_height' => 12,

		'covercaption_font'  => 'Roboto-Regular',
		'covercaption_size'  => 14,
		'covercaption_color' => '#53585F',
		'covercaption_transform' => 'uppercase',
		'covercaption_line_height' => 14,

		'component_alerts' => 'none',

		// This can either be gallery or mosaic.
		'gallery_type'   => 'gallery',

		// Ad settings
		'enable_advertisement' => 'yes',
		'ad_frequency' => 1,
		'ad_margin' => 15,

		// Default component order
		'meta_component_order' => array( 'title', 'cover', 'cover_caption', 'byline' ),
	);

	/**
	 * Get a setting.
	 *
	 * @param string $name
	 * @return mixed
	 * @access public
	 */
	public function get( $name ) {
		// Check for computed settings
		if ( method_exists( $this, $name ) ) {
			return $this->$name();
		}

		// Check for regular settings
		if ( ! array_key_exists( $name, $this->settings ) ) {
			return null;
		}

		return $this->settings[ $name ];
	}

	/**
	 * Set a setting.
	 *
	 * @param string $name
	 * @param mixed $value
	 * @return mixed
	 * @access public
	 */
	public function set( $name, $value ) {
		$this->settings[ $name ] = $value;
		return $value;
	}

	/**
	 * Get all settings.
	 *
	 * @return array
	 * @access public
	 */
	public function all() {
		return $this->settings;
	}

	// COMPUTED SETTINGS are those settings which are not shown in the frontend
	// and cannot be changed directly, instead, they are a logical representation
	// of a combination of other settings. For example, if the body orientation
	// is "center", the layout_width computed property is 768, otherwise, it's
	// 1024.
	// -------------------------------------------------------------------------

	/**
	 * Get the layout width.
	 *
	 * @return string
	 * @access public
	 */
	public function layout_width() {
		return 'center' == $this->get( 'body_orientation' ) ? 768 : 1024;
	}

	/**
	 * Get the layout columns.
	 *
	 * @return string
	 * @access public
	 */
	public function layout_columns() {
		return 'center' == $this->get( 'body_orientation' ) ? 9 : 7;
	}

	/**
	 * Get the body column span.
	 *
	 * @return string
	 * @access public
	 */
	public function body_column_span() {
		return 'center' == $this->get( 'body_orientation' ) ? 7 : 5;
	}

	/**
	 * When a component is displayed aligned relative to another one, slide the
	 * other component a few columns. This varies for centered and non-centered
	 * layouts, as centered layouts have more columns.
	 *
	 * @since 0.4.0
	 * @return string
	 * @access public
	 */
	public function alignment_offset() {
		return 'center' == $this->get( 'body_orientation' ) ? 3 : 2;
	}

}
