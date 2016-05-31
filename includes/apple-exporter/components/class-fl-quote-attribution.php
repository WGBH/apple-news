<?php
namespace Apple_Exporter\Components;

/**
 * Frontline Pull Quote Attribution representation.
 *
 */
class Fl_Quote_Attribution extends Component {

	/**
	 * Look for node matches for this component.
	 *
	 * @param DomNode $node
	 * @return mixed
	 * @static
	 * @access public
	 */
	public static function node_matches( $node ) {
		if (( 'div' == $node->nodeName ) && self::node_has_class( $node, 'quote__attribution' )) {
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
		preg_match( '#<div class="quote__attribution".*?>(.*?)</div>#si', $text, $matches );
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
		$this->json['layout'] = 'quote-attribution-layout';
		$this->register_layout( 'quote-attribution-layout', array(
			'margin' => array( 'top' => 0, 'bottom' => 5 ),
		) );
	}

	/**
	 * Set the style for the component.
	 *
	 * @access private
	 */
	private function set_style() {
		$this->json[ 'textStyle' ] = 'fl-pullquote-attribution';
		$this->register_style( 'fl-pullquote-attribution', array(
			'fontName'      => $this->get_setting( 'pullquote_font' ),
			'fontSize'      => 12,
			'textColor'     => $this->get_setting( 'pullquote_color' ),
			'textTransform' => $this->get_setting( 'pullquote_transform' ),
			'lineHeight'    => 12,
			'textAlignment' => 'center',
		) );
	}

}

