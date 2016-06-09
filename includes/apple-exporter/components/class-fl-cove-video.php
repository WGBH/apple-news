<?php
namespace Apple_Exporter\Components;

/**
 * Replace Frontline Cove video embeds with a link to original article
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
		// Get the article permalink
		if ( ! preg_match( '/data-permalink="([^"]+)"/', $text, $match ) ) {
			return null;
		}

		$url = $match[1];

		$this->json = array(
			'role' => 'container',
			'style' => array(
					'border' => array(
							'all' => array(
									'color' => '#CCC',
									'width' => 2
								),
							'left' => false,
							'right' => false
						),
				),
			'layout' => array(
					'columnStart' => 0,
					'columnSpan' => 4,
					'contentInset' => true
				),
			'components' => array(
					array(
						'role' => 'body',
						'text'   => ' VIEW THIS VIDEO ON THE ORIGINAL ARTICLE',
						'layout' => array(
								'margin' => array(
										'top' => 20,
										'bottom' => 20
									)
							),
						'additions' => array(
								array(
										'type' => 'link',
										'URL' => $url,
										'rangeStart' => 0,
										'rangeLength' => 41
									)
							),
						"textStyle" => "videoLink",
						'inlineTextStyles' => array(
								array( 
										'rangeStart' => 0,
										'rangeLength' => 1,
										'lineHeight' => 0,
										'textStyle' => array(
												'fontName' => 'icomoon'
										)
								)
						)
				)
			)
		);

		$this->set_style();
	}
	/**
	 * Set the style for the component.
	 *
	 * @access private
	 */
	private function set_style() {
		$this->register_style( 'videoLink', array(
			'dropCapStyle'  => array(
					'numberOfLines' => 2,
					'numberOfCharacters' => 1,
					'padding' => 5
				),
			'fontName'      => 'Roboto-Regular',
			'textAlignment' => 'left',
			'fontSize' 		=> 20,
			'lineHeight'	=> 24,
			'hyphenation'	=> false
		) );
	}
}

