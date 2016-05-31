<?php
namespace Apple_Exporter\Components;

/**
 * Frontline Pull Quote representation.
 *
 */
class Fl_Quote extends Component {

	/**
	 * Look for node matches for this component.
	 *
	 * @param DomNode $node
	 * @return mixed
	 * @static
	 * @access public
	 */
	public static function node_matches( $node ) {
		if (( 'div' == $node->nodeName ) && self::node_has_class( $node, 'quote__quote' )) {
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
		preg_match( '#<div class="quote__quote".*?>(.*?)</div>#si', $text, $matches );
		$text = $matches[1];

		$this->json = array(
			'role'   => 'quote',
			'text'   => $this->markdown->parse( $text ),
			'format' => 'markdown',
		);

		$this->set_style();
		$this->set_layout();
	}

	/**
	 * Set the layout for the component.
	 *
	 * @access private
	 */
	private function set_layout() {
		$this->json['layout'] = 'quote-layout';
		$this->register_layout( 'quote-layout', array(
			'margin' => array( 'top' => 0, 'bottom' => 5 ),
		) );
	}

	/**
	 * Set the style for the component.
	 *
	 * @access private
	 */
	private function set_style() {
		$this->json[ 'textStyle' ] = 'fl-pullquote';
		$this->register_style( 'fl-pullquote', array(
			'fontName'      => $this->get_setting( 'pullquote_font' ),
			'fontSize'      => intval( $this->get_setting( 'pullquote_size' ) ),
			'textColor'     => $this->get_setting( 'pullquote_color' ),
			'textTransform' => $this->get_setting( 'pullquote_transform' ),
			'lineHeight'    => intval( $this->get_setting( 'pullquote_line_height' ) ),
			'textAlignment' => 'center',
		) );
	}

}

