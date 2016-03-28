<?php
namespace Apple_Exporter\Components;

class Title extends Component {

	/**
	 * Build the component.
	 *
	 * @param string $text
	 * @access protected
	 */
	protected function build( $text ) {
		$this->json = array(
			'role' => 'title',
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
		$this->json[ 'textStyle' ] = 'default-title';
		$this->register_style( 'default-title', array(
			'fontName'      => $this->get_setting( 'header_font' ),
			'fontSize'      => intval( $this->get_setting( 'header1_size' ) ),
			'lineHeight'    => intval( $this->get_setting( 'header_line_height' ) ),
			'textColor'     => $this->get_setting( 'header_color' ),
			'textAlignment' => $this->find_text_alignment(),
		) );
	}

	/**
	 * Set the default layout for the component.
	 *
	 * @access private
	 */
	private function set_default_layout() {
		$this->json[ 'layout' ] = 'title-layout';
		$this->register_layout( 'title-layout', array(
			'margin'      => array( 'top' => 25, 'bottom' => 25 ),
		) );
	}

}

