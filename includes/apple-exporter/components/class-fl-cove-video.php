<?php
namespace Apple_Exporter\Components;

/**
 * An HTML video tag representation.
 *
 * @since 0.2.0
 */
class FL_Cove_Video extends Component {

	/**
	 * Look for node matches for this component.
	 *
	 * @param DomNode $node
	 * @return mixed
	 * @static
	 * @access public
	 */
	public static function node_matches( $node ) {
		if (( 'div' == $node->nodeName ) && self::node_has_class( $node, 'fl-cove-video' )) {
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
		// Remove initial and trailing tags: <video><p>...</p></video>
		if ( ! preg_match( '/data-permalink="([^"]+)"/', $text, $match ) ) {
			return null;
		}

		$url = $match[1];

		$message = '[View this video on the original post](' . $url . ')';

		$this->json = array(
			'role' => 'title',
			'text'   => $this->markdown->parse($message),
			'format' => 'markdown'
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
		$this->json['layout'] = 'fl-cove-video-layout';
		$this->register_layout( 'fl-cove-video-layout', array(
			'margin' => array( 'top' => 5, 'bottom' => 5 ),
		) );
	}
	/**
	 * Set the style for the component.
	 *
	 * @access private
	 */
	private function set_style() {
		$this->json[ 'textStyle' ] = 'fl-cove-video';
		$this->register_style( 'fl-cove-video', array(
			'fontName'      => 'Roboto-Regular',
			'fontSize'      => 15,
			'textColor'     => '#CF1515',
			'lineHeight'    => 15,
			'textAlignment' => 'center'
		) );
	}
}

