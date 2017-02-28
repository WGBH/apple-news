<?php
namespace Apple_Exporter\Components;

use \Apple_Exporter\Exporter as Exporter;

/**
 * A cover is optional and displayed at the very top of the article. It's
 * loaded from the Exporter_Content's cover attribute, if present.
 * This component does not need a node so no need to implement match_node.
 *
 * In a WordPress context, the Exporter_Content's cover attribute is a post's
 * thumbnail, a.k.a featured image.
 *
 * @since 0.2.0
 */
class Cover extends Component {

	/**
	 * Register all specs for the component.
	 *
	 * @access public
	 */
	public function register_specs() {
		$this->register_spec(
			'json',
			__( 'JSON', 'apple-news' ),
			array(
				'role' => 'header',
				'layout' => 'headerPhotoLayout',
				'components' => array(
					array(
						'role' => 'photo',
						'layout' => 'headerPhotoLayout',
						'URL' => '#URL#',
					)
				),
				'behavior' => array(
					'type' => 'parallax',
					'factor' => 0.8,
				),
			)
		);

		$this->register_spec(
			'headerPhotoLayout',
			__( 'Layout', 'apple-news' ),
			array(
				'ignoreDocumentMargin' => true,
				'columnStart' => 0,
				'columnSpan' => '#layout_columns#',
			)
		);

		$this->register_spec(
			'headerBelowTextPhotoLayout',
			__( 'Below Text Layout', 'apple-news' ),
			array(
				'ignoreDocumentMargin' => true,
				'columnStart' => 0,
				'columnSpan' => '#layout_columns#',
				'margin' => array(
					'top' => 30,
					'bottom' => 0,
				),
			)
		);
	}

	/**
	 * Build the component.
	 *
	 * @param string $url
	 * @access protected
	 */
	protected function build( $url ) {
		$this->register_json(
			'json',
			array(
				'components' => array(
					array(
						'URL' => $this->maybe_bundle_source( $url ),
					)
				),
			)
	 	);

		$this->set_default_layout();
	}

	/**
	 * Set the default layout for the component.
	 *
	 * @access private
	 */
	private function set_default_layout() {
		$this->register_full_width_layout(
			'headerPhotoLayout',
			'headerPhotoLayout',
			array(
				'columnSpan' => $this->get_setting( 'layout_columns' ),
			)
		);

		$this->register_full_width_layout(
			'headerBelowTextPhotoLayout',
			'headerBelowTextPhotoLayout',
			array(
				'columnSpan' => $this->get_setting( 'layout_columns' ),
			)
		);
	}

}

