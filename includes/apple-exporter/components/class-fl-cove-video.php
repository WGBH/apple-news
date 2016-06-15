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
			'layout' => array(
				'columnStart' => 1,
				'columnSpan' => 10
				),
			'style' => array(
				'fill' => array(
					'type' => 'image',
					'URL' => 'http://www-tc.pbs.org/wgbh/frontline/wp-content/uploads/2016/06/video_btn.jpg',
					'fillMode' => 'cover'
					)
				),
			'components' => array(
				array(
					'role' => 'container',
					'layout' => array(
							'contentInset' => true
						),
					'style' => array(
							'backgroundColor' => '#181818A6'
						),
					'components' => array(
							array(
								'role' => 'heading',
								'text' => '',
								'textStyle' => array(
									'textAlignment' => 'center',
									'fontSize' => 56,
									'textColor' => '#FFF',
									'fontName' => 'icomoon',
									'lineHeight' => 56
									),
								'layout' => array(
									'margin' => array(
										'top' => 20
										)
									),
								'additions' => array(
									array(
										'type' => 'link',
										'URL' => $url,
										'rangeStart' => 0,
										'rangeLength' => 3
										)
									)
								),
							array(
								'role' => 'heading',
								'text' => 'View this video in the original article',
								'textStyle' => array(
									'fontName' => 'CooperHewitt-Medium',
									'fontSize' => 36,
									'textColor' => '#FFFFFF',
									'textAlignment' => 'center',
									'hyphenation' => false
									),
								'layout' => array(
									'columnStart' => 2,
									'columnSpan' => 6,
									'margin' => array(
										'top' => 0,
										'bottom' => 0
										)
									),
								'additions' => array(
									array(
										'type' => 'link',
										'URL' => $url,
										'rangeStart' => 0,
										'rangeLength' => 39
										)
									)
								),
							array(
								'role' => 'heading4',
								'text'   => '  WATCH NOW  ',
								'textStyle' => array(
									'backgroundColor' => '#E9E9E9',
									'fontName' => 'CooperHewitt-Medium',
									'textColor' => '#000000',
									'fontSize' => 24,
									'lineHeight' => 30,
									'textAlignment' => 'center'
									),
								'layout' => array(
										'margin' => array(
												'top' => 15,
												'bottom' => 20
											)
									),
								'additions' => array(
										array(
												'type' => 'link',
												'URL' => $url,
												'rangeStart' => 0,
												'rangeLength' => 15
											)
									)
								)
							)
						)
				)
		);

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
					'padding' => 5,
					'textColor' => '#000'
				),
			'fontName'      => 'Roboto-Regular',
			'textAlignment' => 'left',
			'fontSize' 		=> 20,
			'lineHeight'	=> 24,
			'hyphenation'	=> false
		) );
	}
}

