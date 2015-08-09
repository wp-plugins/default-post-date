<?php # -*- coding: utf-8 -*-

namespace tf\DefaultPostDate\Views;

use tf\DefaultPostDate\Models\Settings;

/**
 * Class SettingsField
 *
 * @package tf\DefaultPostDate\Views
 */
class SettingsField {

	/**
	 * @var string
	 */
	private $id = 'default-post-date';

	/**
	 * @var string
	 */
	private $option_name;

	/**
	 * @var Settings
	 */
	private $settings;

	/**
	 * Constructor. Set up the properties.
	 *
	 * @param Settings $settings Settings model.
	 */
	public function __construct( Settings $settings ) {

		$this->settings = $settings;

		$this->option_name = $settings->get_option_name();
	}

	/**
	 * Add the settings field to the general options.
	 *
	 * @wp-hook admin_init
	 *
	 * @return void
	 */
	public function add() {

		$title = esc_html_x( 'Default Post Date', 'Settings field title', 'default-post-date' );
		$title = sprintf(
			'<label for="%s">%s</label>',
			$this->id,
			$title
		);

		add_settings_field(
			$this->option_name,
			$title,
			array( $this, 'render' ),
			'general'
		);
	}

	/**
	 * Render the HTML.
	 *
	 * @return void
	 */
	public function render() {

		$value = $this->settings->get();

		$description = esc_html_x(
			'Please enter the default post date according to the %s date format.',
			'Settings field description, %s = date format',
			'default-post-date'
		);
		?>
		<input type="text" id="<?php echo $this->id; ?>" name="<?php echo $this->option_name; ?>"
			value="<?php echo esc_attr( $value ); ?>" maxlength="10" placeholder="YYYY-MM-DD">
		<p class="description">
			<?php printf( $description, '<code>YYYY-MM-DD</code>' ); ?>
		</p>
	<?php
	}

}
