<?php
namespace Apple_Exporter\Components;

use \Apple_Exporter\Exporter as Exporter;

/**
 *
 * @since 0.2.0
 */
class FL_Image_Caption extends Component {

	/**
	 * Look for node matches for this component.
	 *
	 * @param DomNode $node
	 * @return mixed
	 * @static
	 * @access public
	 */
	public static function node_matches( $node ) {
		// Is this an image node?
		if ( 'span' == $node->nodeName && self::node_has_class( $node, 'fl-img-caption' ) ) {
			return $node;
		}

		return null;
	}

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
			"fontName" => "Roboto-Regular",
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

