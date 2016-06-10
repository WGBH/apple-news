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
		if ( 'div' == $node->nodeName && self::node_has_class( $node, 'fl-img-caption-credit' ) ) {
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
		$caption_text = preg_match( '#<span class="fl-img-caption article__credit-hero".*?>(.*?)</span>#si', $text, $caption_matches ) ? $caption_matches[1] : '';

		$credit_text = preg_match( '#<span class="fl-img-credit article__credit-hero".*?>(.*?)</span>#si', $text, $credit_matches ) ? $credit_matches[1] : '';

		$joined_text = $caption_text;
		if( ($caption_text != '') && ($credit_text != '') ) {
			$joined_text .= ' ';
		}
		$joined_text .= $credit_text;

		$this->json = array(
			'role' => 'caption',
			'text' => $joined_text,
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
		$this->json[ 'textStyle' ] = 'fl-image-caption';
		$this->register_style( 'fl-image-caption', array(
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
		$this->json[ 'layout' ] = 'fl-image-caption-layout';
		$this->register_layout( 'fl-image-caption-layout', array(
			'margin'      => array( 'top' => 10, 'bottom' => 10 ),
		) );
	}

}

