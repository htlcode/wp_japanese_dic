<?php
/*
Plugin Name: ALJ Dictionnary
Plugin URI: http://www.apprendrelejaponais.net
Description: Apprendrelejaponais.net japanese dictionnary
Author: CAISSON Frederic
Version: 2.1
Author URI: http://www.apprendrelejaponais.net
*/

require_once(dirname(__FILE__).'/app/base/Db.php');
require_once(dirname(__FILE__).'/app/base/View.php');
require_once(dirname(__FILE__).'/app/base/Controller.php');

require_once(dirname(__FILE__).'/app/controller/CoreController.php');
require_once(dirname(__FILE__).'/app/lib/KanaFactory.php');
require_once(dirname(__FILE__).'/app/lib/RomajiFactory.php');
require_once(dirname(__FILE__).'/app/lib/KanjiFactory.php');
require_once(dirname(__FILE__).'/app/lib/DictionaryFactory.php');
require_once(dirname(__FILE__).'/app/lib/KeywordFactory.php');
require_once(dirname(__FILE__).'/app/controller/PublicController.php');

function wp_alj_dic_initialize() {
    $core = Aljdic\CoreController::get_instance();
    $core->add_hooks();
}
add_action( 'plugins_loaded', 'wp_alj_dic_initialize' );
register_activation_hook( __FILE__, array( Aljdic\CoreController::get_instance(), 'activate_plugin' ) );
register_deactivation_hook( __FILE__, array( Aljdic\CoreController::get_instance(), 'deactivate_plugin' ) );
?>
