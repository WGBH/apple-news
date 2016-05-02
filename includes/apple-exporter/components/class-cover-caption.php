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

		$this->set_default_layout();
	}

	/**
	 * Set the style for the component.
	 *
	 * @access private
	 */
	private function set_style() {
		$this->json[ 'textStyle' ] = 'default-caption';
		$this->register_style( 'default-caption', array(
			"fontName" => "HelveticaNeue",
		     "fontSize" => 14,
		     "textColor" => "#999",
		) );
	}

	/**
	 * Set the default layout for the component.
	 *
	 * @access private
	 */
	private function set_default_layout() {
		$this->json[ 'layout' ] = 'caption-layout';
		$this->register_layout( 'caption-layout', array(
			'margin'      => array( 'top' => 0, 'bottom' => 10 ),
		) );
	}

}

