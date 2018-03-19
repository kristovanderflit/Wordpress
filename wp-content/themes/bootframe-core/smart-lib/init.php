<?php

/*DEFINITIONS*/
define('SMART_LIB_DIRECTORY', '/smart-lib/');
define('SMART_TEMPLATE_DIRECTORY', get_template_directory());
define('SMART_TEMPLATE_DIRECTORY_URI', get_template_directory_uri());
define('SMART_STYLESHEET_DIRECTORY', get_stylesheet_directory_uri());
define('SMART_ADMIN_DIRECTORY_URI', SMART_TEMPLATE_DIRECTORY_URI.'/admin');
define('SMART_KIRKI_URI', SMART_TEMPLATE_DIRECTORY_URI .SMART_LIB_DIRECTORY. 'vendor/kirki/');
define('SMART_ADMIN_DIRECTORY', SMART_TEMPLATE_DIRECTORY.'/admin');





class Smartlib_Init{


	public $default_config;

	/*list of widgets from class custom widgets file*/

	public $project_widgets = array(
		'Smart_Widget_Recent_Posts',
		'Smart_Widget_One_Author',
		'Smart_Widget_Social_Icons',

		'Smart_Widget_Recent_Videos',

		'Smart_Widget_Last_Articles_Columns',
		'Smartlib_Widget_Sangar_Slider',
		'Smart_Widget_Recent_Galleries'


	);


	function __construct(){

		/* load all required php files*/
		$this->requires();

		/*Load Default Config*/

		$this->default_config = Smartlib_Config::getInstance();

		//pass admin object to the constructor
		$this->customizer_project = new Smartlib_Customizer();

		$this->customizer_style = Smartlib_Custom_Styles::getInstance($this->default_config);

		//initialize smartlib actions & filters

		new Smartlib_Filters($this->default_config);
		new Smartlib_Actions($this->default_config);

		new Smartlib_Features($this->default_config);


		//Setup the Theme Customizer settings and controls
		add_action( 'customize_register', array( $this->customizer_project, 'register' ) );

		/*Load all scripts*/

		add_action( 'wp_enqueue_scripts',   array( $this, 'smartlib_scripts' ), 1 );

		/*Load admin scripts*/
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_print_css_js' ) );

		add_filter( 'kirki/config',         array( $this, 'kirki_customizer_config' ) );

		add_action('wp_head',  array( $this,'header_scripts'),  1000); //add google analytics code - at the very end

		add_action('wp_footer',  array( $this,'dropdown_hover'),  1000);


		//add customizer fonts
		add_action('wp_head',  array( $this->customizer_style,'header_fonts_output'), 2);




		add_action( 'wp_enqueue_scripts', array( $this->customizer_style,'header_css_output'), 1000);


		//add custom code - header
		add_action('wp_head', array($this, 'custom_code_header'));
		//add custom code - footer
		add_action('wp_footer', array($this, 'custom_code_footer'));

		/*
		 * Register all widgets
		 */
		add_action( 'widgets_init', array($this, 'register_theme_widgets'));



		/*
		 * Widget global class filter
		 */

		add_filter('dynamic_sidebar_params',array($this, 'global_box_shadow'));



	}


	public function requires(){

		$files = array(
			'smart-lib/class-config.php',
			'smart-lib/classes/class-bootstrap-menu-walker.php',
			'smart-lib/classes/class-features.php',
			'smart-lib/classes/class-tgm-plugin-activation.php',
			'smart-lib/classes/smartlib-customizer.php',
			'smart-lib/classes/class-smartlib-actions.php',
			'smart-lib/classes/class-smartlib-filters.php',
			'smart-lib/classes/class-smartlib-layout-helpers.php',
			'smart-lib/classes/class-helpers.php',
			'smart-lib/class-customizer-options.php',
			'smart-lib/template-tags.php',
			'smart-lib/classes/class-smartlib-custom-styles.php',
			'smart-lib/integrations/page-builder-integration.php',//page builder integration
			'smart-lib/integrations/woocommerce-integration.php',//woocommerce integration

			'smart-lib/classes/class-custom-widgets.php'





		);

		foreach ( $files as $file ) {
			locate_template( $file , true);
		}
	}

	function smartlib_scripts() {

		/*register bootstrap*/

		wp_register_style('smartlib_prettyphoto',  get_template_directory_uri() . '/assets/vendor/prettyPhoto/css/prettyPhoto.css', false);
		wp_enqueue_style('smartlib_prettyphoto');

		/*add icon mooon if widgets bundle isn't loaded */


		wp_register_style('smartlib_iconmoon',  get_template_directory_uri() . '/assets/vendor/iconmoon/style.css', false);
		wp_enqueue_style('smartlib_iconmoon');



		/*ad main stylesheet*/
		wp_register_style('smartlib_main',  get_stylesheet_uri(), false);
		wp_enqueue_style('smartlib_main');


		/*flexislider*/
		wp_register_style('smartlib_flexislider',  get_template_directory_uri() . '/assets/vendor/flexslider/flexslider.css', false);
		wp_enqueue_style('smartlib_flexislider');



		if (is_single() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}

		/*flexislider scripts*/
		wp_register_script('smartlib-flexislider', get_template_directory_uri() . '/assets/vendor/flexslider/jquery.flexslider-min.js', array('jquery'), null, false);
		wp_enqueue_script('smartlib-flexislider');

		/*prettyPhoto scripts*/
		wp_register_script('smartlib-prettyphoto', get_template_directory_uri() . '/assets/vendor/prettyPhoto/js/jquery.prettyPhoto.js', array('jquery'), null, false);
		wp_enqueue_script('smartlib-prettyphoto');


		wp_register_script('smartlib-main-vendor', get_template_directory_uri() . '/assets/js/vendor.min.js', array('jquery'), null, true);

		wp_enqueue_script('smartlib-main-vendor');

		wp_register_script('smartlib-main-js', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery', 'smartlib-main-vendor'), null, true);

		wp_enqueue_script('smartlib-main-js');

		if(function_exists('WC')){

			wp_enqueue_style('smartlib-woocommerce', get_template_directory_uri() . '/assets/plugins-integration/woocommerce.css', false);

		}

	}

	function get_default_config(){
		return $this->default_config;
	}

	/**
	 * The configuration options for Kirki Customizer
	 */
	function kirki_customizer_config() {



		$args = array(



			// If Kirki is embedded in your theme, then you can use this line to specify its location.
			// This will be used to properly enqueue the necessary stylesheets and scripts.
			// If you are using kirki as a plugin then please delete this line.
			'url_path'     =>SMART_KIRKI_URI,

			// If you want to take advantage of the backround control's 'output',
			// then you'll have to specify the ID of your stylesheet here.
			// The "ID" of your stylesheet is its "handle" on the wp_enqueue_style() function.
			// http://codex.wordpress.org/Function_Reference/wp_enqueue_style
			'stylesheet_id' => 'bstarter',

		);

		return $args;

	}


	function header_scripts(){

		//google analitics script
		echo get_theme_mod( 'google_analytics');
	}

	function dropdown_hover(){

		//google analitics script
		$dropdown_hover = get_theme_mod( 'smartlib_dropdown_hover', '0');

		if($dropdown_hover=='1'){
			?>
			<script>
				(function ($) {
					$(".dropdown").hover(
						function() {
							$('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
							$(this).toggleClass('open');
							$('b', this).toggleClass("caret caret-up");
							$(this).find(".dropdown-menu").css('display', 'none');
							$(this).find("> .dropdown-menu").css('display', 'block');

						},
						function() {
							$('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
							$(this).toggleClass('open');
							$('b', this).toggleClass("caret caret-up");
							$(this).find(".dropdown-menu").css('display', 'none');
							$(this).find("> .dropdown-menu").css('display', 'block');

						});

					$(".dropdown a").click(function(e){

						e.stopPropagation();
						return true;

					});
				})(jQuery); // Fully reference jQuery after this point.
			</script>
		<?php

		}
	}

	/*
	 * External admin scripts
	 */
	function admin_print_css_js(){
		wp_enqueue_media();
		wp_enqueue_script( 'smartlib-admin-js',get_template_directory_uri() . '/admin/js/admin-scripts.js', array( 'jquery', 'plupload-all' ), '1', true );
		wp_enqueue_style( 'smartlib-admin-css',get_template_directory_uri() . '/admin/css/css-admin-mod.css');

		if(!defined('SMARTLIB_THEME_INFO')){

			wp_enqueue_script( 'smartlib-customizer-info',get_template_directory_uri() . '/admin/js/customizer-info.js', array( 'jquery' ), '1', true );

		}
	}

	/*
	 * Register widgets
	 */
	public function register_theme_widgets(){

		if(count($this->project_widgets)>0){
			foreach($this->project_widgets as $widget_class){
				if(class_exists($widget_class) ){
					register_widget($widget_class);
				}
			}
		}
	}



	/**
	 * Custom code header action
	 */

	public function custom_code_header(){

		$code = get_theme_mod('custom_code_header', '');

		if(strlen($code)>0){

			echo "\n".$code ."\n";

		}

	}

	/**
	 * Custom code footer action
	 */

	public function custom_code_footer(){

		$code = get_theme_mod('custom_code_footer', '');

		if(strlen($code)>0){

			echo "\n".$code ."\n";

		}

	}

	/**
	 * Add box shadow based on customizer settings
	 * @param $params
	 * @return mixed
	 */

	function global_box_shadow($params) {


		$box_shadow = get_theme_mod('smartlib_box_shadow_switcher', '0');



		if($box_shadow=='1'){

			$class = 'class="smartlib-panel-shadow ';

			$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']);



		}

		return $params;

	}


}

