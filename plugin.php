<?php
/*
Plugin Name: Sample
Description: Sample
Author:      Zarrar Muhammad
Version:     1.0
Author URI:  https://zailetzone.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
defined( 'ABSPATH' ) or die( 'Action will be taken' );

class Sample{
    public $controller;

    private static $instance = null;

    private function __construct() {
    }
 
    public static function getInstance() {
       if (self::$instance == null) {
          self::$instance = new Sample();
       }
       return self::$instance;
    }

    private function init(){
        $this->demo_define_constants();
        $this->demo_includes();
        $this->controller = new EndpointController();
        add_action('rest_api_init', array($this, 'register_routes') );
        add_action( 'wp_enqueue_scripts', array( $this, 'frontend_enqueue' ));
        register_activation_hook( __FILE__, array( $this, 'plugin_install' ) );
        register_deactivation_hook( __FILE__, array( $this, 'plugin_uninstall' ) );
    }

    public function register_routes(){
        $this->controller->activate_register_routes();
    }

    public function demo_define_constants(){
        $this->demo_define( 'path_demo', plugin_dir_path( __FILE__ ) );
        $this->demo_define( 'basename_inpsdye', dirname( __FILE__ ) );
        $this->demo_define( 'demo_id', dirname( __FILE__ ) );
    }

    private function demo_define( $name, $value ){
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    public function demo_includes(){
        include_once path_demo . '/includes/EndpointController.php';
        include_once path_demo . '/includes/jsonplaceholder_api.php';
    }

    public function frontend_enqueue() {
        wp_enqueue_style( 'customcss', path_demo.'style.css', false );
    }
    
    public function plugin_install() {
    }

    public function plugin_uninstall() {
    }

}

$instance = Sample::getInstance();
$instance->init();