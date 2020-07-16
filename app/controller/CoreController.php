<?php
namespace Aljdic;

class CoreController extends Controller{
	CONST PLUGIN_NAME = 'alj-dic';
	CONST ENDPOINT_TRANSLATE = 'traduction-japonais';
	CONST ENDPOINT_DICT = 'dictionnaire-japonais-francais';
	CONST DATA_FOLDER = 'data';

	public static $instance;
	protected $frontend;
	private $plugin_dir_url = null;
	private $loader_file = null;
	private $end_point_dictionary = null;
	private $end_point_translate = null;

	public static function get_instance() {
		if(is_null(self::$instance)) {
			self::$instance = new CoreController();;
		}
		return self::$instance;
	}

	public function __construct(){
		$this->plugin_dir_url = plugin_dir_url( dirname(dirname(__FILE__)) );
		$this->loader_file = dirname(dirname(dirname(__FILE__))).'/loader.php';

		$this->end_point_dictionary = CoreController::ENDPOINT_DICT;
		$this->end_point_translate = CoreController::ENDPOINT_TRANSLATE;
	}

	public function add_hooks(){
		add_action('init', array( $this, 'add_rewrite_endpoint'));
		add_action('init', array( $this, 'load_locale'));
		add_action('wp_enqueue_scripts', array($this,'add_scripts'));
		$this->frontend = new PublicController();
		add_action('template_redirect', array($this->frontend, 'template_redirect'));

		register_sidebar( array (
			'name' => 'Alj dictionary sidebar',
			'id' => 'aljdic-sidebar',
			'before_widget' => '<div id="%1$s" class="sidebar-widget widget %2$s" role="complementary">',
			'after_widget' => "</div>",
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',
		) );
	}

	public function add_rewrite_endpoint() {
		add_rewrite_endpoint($this->end_point_translate, EP_ROOT);
		add_rewrite_endpoint($this->end_point_dictionary, EP_ROOT);
	}

	public function activate_plugin() {
		update_option(CoreController::PLUGIN_NAME.'_activated',true);
		$this->add_rewrite_endpoint();
		flush_rewrite_rules();
	}

	public function deactivate_plugin() {
		delete_option(CoreController::PLUGIN_NAME.'_activated');
		flush_rewrite_rules();
	}

	public function __destruct(){
		self::$instance = null;
		$this->loader_file = null;
		$this->plugin_dir_url = null;
		$this->end_point_dictionary = null;
		$this->end_point_translate = null;
		$this->frontend = null;
	}

	public function get_plugin_dir_url(){
		return $this->plugin_dir_url;
	}

	public function get_plugin_dir_data_url(){
		return $this->plugin_dir_url.self::DATA_FOLDER.'/';
	}

	public function get_end_point_translate(){
		return $this->end_point_translate;
	}

	public function get_end_point_dictionary(){
		return $this->end_point_dictionary;
	}
	
	public function add_scripts() {
		
		$enqueue = false;
		if (strpos($_SERVER['REQUEST_URI'], self::ENDPOINT_TRANSLATE) !== false) {
			$enqueue = true;
		}
		if (strpos($_SERVER['REQUEST_URI'], self::ENDPOINT_DICT) !== false) {
			$enqueue = true;
		}
		if($enqueue){
			if(!wp_script_is('jquery','enqueued')){
		    	wp_enqueue_script('jquery');
			}

			wp_enqueue_style('alj-css', $this->plugin_dir_url . 'css/alj-min.css');
			/*$now = date('YmdHis');
			wp_enqueue_script( 'lib1', $this->plugin_dir_url. 'js/dmak.js'."?$now",array('jquery'),true,true);
			wp_enqueue_script( 'lib2', $this->plugin_dir_url. 'js/jquery.dmak.js'."?$now",array('jquery'),true,true);
			wp_enqueue_script( 'lib3', $this->plugin_dir_url. 'js/raphael-min.js'."?$now",array('jquery'),true,true);
			wp_enqueue_script( 'lib4', $this->plugin_dir_url. 'js/alj.js'."?$now",array('jquery'),true,true);*/
			wp_enqueue_script( 'alj-js', $this->plugin_dir_url. 'js/lib.js',array('jquery'),true,true);
		}
	}

	public function load_locale(){
		$path = plugin_basename(dirname(dirname(dirname(__FILE__)))) . '/languages';
	    $loaded = load_plugin_textdomain( CoreController::PLUGIN_NAME , false, $path);
	}
}

?>
