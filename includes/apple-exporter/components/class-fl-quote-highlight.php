<?php
namespace Apple_Exporter\Components;

/**
 * Frontline Pull Quote representation.
 *
 */
class Fl_Quote_Highlight extends Component {

	/**
	 * Look for node matches for this component.
	 *
	 * @param DomNode $node
	 * @return mixed
	 * @static
	 * @access public
	 */
	public static function node_matches( $node ) {
		if (( 'div' == $node->nodeName ) && self::node_has_class( $node, 'quote__highlight' )) {
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
		preg_match( '#<div class="quote__highlight".*?>(.*?)</div>#si', $text, $matches );
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
		$this->json['layout'] = 'quote-highlight-layout';
		$this->register_layout( 'quote-highlight-layout', array(
			'margin' => array( 'top' => 5, 'bottom' => 0 ),
		) );
	}

	/**
	 * Set the style for the component.
	 *
	 * @access private
	 */
	private function set_style() {
		$this->json[ 'textStyle' ] = 'fl-pullquote-highlight';
		$this->register_style( 'fl-pullquote-highlight', array(
			'fontName'      => $this->get_setting( 'pullquote_font' ),
			'fontSize'      => 100,
			'textColor'     => '#CF1515',
			'textTransform' => $this->get_setting( 'pullquote_transform' ),
			'lineHeight'    => intval( $this->get_setting( 'pullquote_line_height' ) ),
			'textAlignment' => 'center',
		) );
	}

}

