<?php
namespace Aljdic;

class PublicController extends Controller
{
	CONST MAX_SIZE = 30;

	private $title = '';
	private $description = '';
	private $h1 = '';
	private $url = '';

	public function filter_wpseo_title($title) {
	    $title = $this->title;
	    return $title;
	}

	public function filter_wpseo_metadesc($desc){
		$desc = $this->description;
		return $desc;
	}

	public function filter_wpseo_canonical($url) {
	    $url = $this->url;
	    return $url;
	}

	public function filter_wpseo_next($url) {
	    return '';
	}

	public function template_redirect(){

		$translate_index = site_url().'/'.CoreController::ENDPOINT_TRANSLATE;
		$definition_index = site_url().'/'.CoreController::ENDPOINT_DICT;

		global $wp_query;
		$include_views_before = array('header');
		$include_views_after = array('footer');
	    $core = CoreController::get_instance();
	    $endpoint = null;

	    $params = array();
	    $params['plugin_name'] = CoreController::PLUGIN_NAME;
	    $params['depth1_url'] = '';
		$params['depth1_label'] = '';
		$params['depth2_label'] = '';

		if (isset($wp_query->query[CoreController::ENDPOINT_TRANSLATE])) {
			$params['base_url'] = $translate_index;
			$endpoint = CoreController::ENDPOINT_TRANSLATE;
		} else if(isset($wp_query->query[CoreController::ENDPOINT_DICT])){
			$params['base_url'] = $definition_index;
			$endpoint = CoreController::ENDPOINT_DICT;
		}

		if(!empty($endpoint)){

	        $encoded_param = $wp_query->query_vars[$endpoint];
	        $keyword = urldecode($encoded_param);
	        $size = mb_strlen($keyword);

	        if($size < self::MAX_SIZE){
	        	if(!empty($keyword)){

			        $keyword_factory = new KeywordFactory($keyword);
			        $params['keyword'] = $keyword;
			        $params['data_dir_url'] = $core->get_plugin_dir_data_url();
			        $params['type'] = 'entry';
			        $params['depth2_label'] = $keyword;

			        if($endpoint == CoreController::ENDPOINT_TRANSLATE){
			        	$this->title = "Traduction de japonais à français : $keyword";
			        	$this->description = "Comment traduire $keyword en japonais ? Voici la traduction en français de l'expression $keyword via le site apprendrelejaponais.net.";

			        	$params['depth1_url'] = $translate_index;
						$params['depth1_label'] = 'Traduction en ligne japonais français';
						
			    		$params['title'] = $this->title;
			        	$params['words'] = $keyword_factory->get_words();
			        	
			        	
			    	} else {
			    		$this->title = "Définition de : $keyword";

			    		$params['depth1_url'] = $definition_index;
						$params['depth1_label'] = 'Dictionnaire japonais français';
			    		$params['title'] = $this->title;

			    		$word = $keyword_factory->get_word();
			    		$empty = false;
			    		if(count($word)){
			    			if (empty($word[0]['meanings_french']) && empty($word[0]['meanings_english']) ){
								$empty = true;
							}
			    		}

			    		if($empty){
			    			header('Location: '. $translate_index.'/'.$keyword);
			    		} else {
			    			$definition = '';
			    			$this->description = "La définition de $keyword en japonais via le site apprendrelejaponais.net";
			    			if(!empty($word[0]['meanings_french'])){
			    				foreach($word[0]['meanings_french'] as $meaning_set){
			    					$definition = implode(', ',$meaning_set['meanings']);
			    					break;
			    				}
			    				$this->description = "La définition de $keyword en japonais : $keyword dans la langue japonaise, signifie ou peut se traduire par $definition dans la langue française.";
			    			} 
			    			
			    			$params['words'] = $word;
			    		}
			    	}
			    } else {
			    	$params['type'] = 'index';
			    	if($endpoint == CoreController::ENDPOINT_TRANSLATE){
			    		$this->title = "Outil de traduction de japonais français en ligne";
			    		$this->description = "L'outil de traduction en ligne du site apprendrelejaponais.net vous permet de traduire et décomposer les mots, kana et kanji de japonais à français.";

			    		$params['placeholder'] = 'Tapez une expression à traduire (ex : 猫が好きです)';
			    		$params['depth2_label'] = 'Traduction en ligne japonais français';
			    		$params['title'] = $this->title;
			    	} else {
			    		$this->title = "Dictionnaire de japonais français en ligne";

			    		$params['placeholder'] = 'Tapez un mot en japonais (ex : 学生)';
			    		$params['depth2_label'] = 'Dictionnaire japonais français';
			    		$params['title'] = $this->title;
			    	}
			    }
			    $this->url = $params['base_url'].'/'.$keyword;
			    add_filter('wpseo_next_rel_link', array($this,'filter_wpseo_next'));
			    add_filter('wpseo_canonical', array($this,'filter_wpseo_canonical'));
			    add_filter('wpseo_title', array($this,'filter_wpseo_title'));
			    add_filter('wpseo_metadesc', array($this,'filter_wpseo_metadesc')); 
			    $this->renderView($params['type'],$params,$include_views_before,$include_views_after);
	    	}
			exit;
		}
	}
}
?>