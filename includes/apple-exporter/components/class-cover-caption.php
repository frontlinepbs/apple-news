<?php
namespace Apple_Exporter\Components;

use \Apple_Exporter\Exporter as Exporter;

/**
 *
 * @since 0.2.0
 */
class Cover_Caption extends Component {
	/**
	 * Build the component.
	 *
	 * @param string $text
	 * @access protected
	 */
	protected function build( $text ) {
		$this->json = array(
			'role' => 'caption',
			'text' => $text,
		);

		$this->set_style();

	}

	/**
	 * Set the style for the component.
	 *
	 * @access private
	 */
	private function set_style() {
		$this->json[ 'textStyle' ] = 'cover-caption';
		$this->register_style( 'cover-caption', array(
			"fontName" => $this->get_setting( 'covercaption_font' ),
		     "fontSize" => intval( $this->get_setting( 'covercaption_size' ) ),
		     "textColor" => "#999",
		) );
	}

}

