<?php
namespace Aljdic;

class KeywordFactory
{
	private $keyword = '';
	private $words = null;

	public function __destruct() {
		$this->keyword = null;
		$this->words = null;
	}

	public function __construct($keyword){
		$this->keyword = $keyword;
	}

	public function get_word(){
		return $this->examine_word($this->keyword);
	}

	public function get_words(){
		return $this->examine_words($this->keyword);
	}

	public function examine_word($value){
		$words = array();
		$word['value'] = $value;
		$dictionary_factory = new DictionaryFactory();
		if($dictionary_factory->is_japanese($value)){
			//$raw_features = $node->getFeature();
			//$features = explode(',',$raw_features);
			//$word['type'] = $this->get_type($features[0]);
			//$word['kana'] = $features[7];
			//$word['romaji'] = $romaji_factory->conv($features[7]);
			$word['characters'] = $this->get_characters($value);
			$definition = $dictionary_factory->get_definition_fr_en($value);
			$word['meanings_french'] = $definition['meanings_french'];
			$word['meanings_english'] = $definition['meanings_english'];	
		} else {
			$definition = $dictionary_factory->get_definition_jp($value);
			$word['meanings_japanese'] = $definition['meanings_japanese'];
		}

		unset($definition);
		$definition = null;
		$words[] = $word;
		return $words;
	}

	public function examine_words($str){
		$words = array();
        $mecab_tagger = new \MeCab\Tagger();
 
        $romaji_factory = new RomajiFactory();
        $dictionary_factory = new DictionaryFactory();

		for($node=$mecab_tagger->parseToNode($str); $node; $node=$node->getNext()){
			$word = null;
			if($node->getStat() != 2 && $node->getStat() != 3){
				$value = $node->getSurface();
				$word['value'] = $value;
				
				if($dictionary_factory->is_japanese($value)){
					$raw_features = $node->getFeature();
					$features = explode(',',$raw_features);
					$word['type'] = $this->get_type($features[0]);
					//$word['kana'] = $features[7];
					$word['romaji'] = $romaji_factory->conv($features[7]);
					$word['characters'] = $this->get_characters($value);
					$definition = $dictionary_factory->get_definition_fr_en($value);

					$word['meanings_french'] = $definition['meanings_french'];
					$word['meanings_english'] = $definition['meanings_english'];
						
				} else {
					$definition = $dictionary_factory->get_definition_jp($value);
				}
				
				
				unset($definition);
				$definition = null;
				$words[] = $word;
			}
		}
		unset($dictionary_factory);
		unset($romaji_factory);
		$romaji_factory = null;
		$dictionary_factory = null;
		return $words;
	}

	public function get_characters($str){
		$characters = array();
		$strlen = mb_strlen($str);
		$core = CoreController::get_instance();
		for( $i = 0; $i < $strlen; $i++ ) {
			$char = mb_substr( $str, $i, 1, 'UTF-8' );

			$codepoint = $this->get_codepoint($char);
			$codepoint_svg = str_pad($codepoint, 5, "0", STR_PAD_LEFT);

			$path_svg = dirname ( dirname ( dirname (__FILE__) ) ).'/data/'. $codepoint_svg . '.svg';
			if(!file_exists($path_svg)){
				$codepoint_svg = null;
			} 

			$character = array('value' => $char,
							'codepoint' => $codepoint,
							'type' => null,
							'grade' => null,
							'jlpt' => null,
							'stroke_count' => null,
							'onyomi' => null,
							'kunyomi' => null,
							'meanings_french' => null,
							'meanings_english' => null,
							'codepoint_svg' => $codepoint_svg,
							);

			if(KanaFactory::is_hiragana($char) || KanaFactory::is_katakana($char)) {
				$kana_factory = new KanaFactory();

				$info = $kana_factory->get_info_kana($char);
				$character['type'] = $info['type'];
				$character['stroke_count'] = $info['stroke_count'];
				$character['jlpt'] = $info['jlpt'];

				unset($kana_factory);
				$kana_factory = null;
				unset($info);

			} else {
				$kanji_factory = new KanjiFactory();
				$info = $kanji_factory->get_kanji_info($character['codepoint']);
				if(!empty($info['id'])){
					$character['type'] = 'kanji';
					$character['grade'] = $info['grade'];
					$character['jlpt'] = $info['jlpt'];
					$character['stroke_count'] = $info['stroke_count'];
					$character['onyomi'] = $info['onyomi'];
					$character['kunyomi'] = $info['kunyomi'];
					$character['meanings_french'] = $info['meanings_french'];
					$character['meanings_english'] = $info['meanings_english'];
				} else {
					$character['type'] = __('character', CoreController::PLUGIN_NAME);
				}
				unset($kanji_factory);
				$kanji_factory = null;
				unset($info);
			}

			$info = null;
			
			$characters[] = $character;

		}
		return $characters;

	}

	public function get_codepoint($char){
		$char_code = $this->utf8_to_char_code($char);
		return $this->char_code_to_codepoint($char_code);
	}

	public function get_type($mecab_type){

		$types = array('名詞'   => __('noun', CoreController::PLUGIN_NAME),
					   '動詞'   => __('verb', CoreController::PLUGIN_NAME),
					   '形容詞' => __('adjective', CoreController::PLUGIN_NAME),
					   '副詞'   => __('adverb', CoreController::PLUGIN_NAME),
					   '助詞'   => __('particle', CoreController::PLUGIN_NAME),
					   '接続詞' => __('conjunction', CoreController::PLUGIN_NAME),
					   '助動詞' => __('auxiliary', CoreController::PLUGIN_NAME),
					   '連体詞' => __('pre-noun', CoreController::PLUGIN_NAME),
					   '感動詞' => __('interjection', CoreController::PLUGIN_NAME),
					);
		if(array_key_exists($mecab_type, $types)){
			return $types[$mecab_type];
		};

		return null;
	}

	public function char_code_to_codepoint($char_code){
		if(isset($char_code)){
			return dechex($char_code);
		};
		return null;
	}

	public function utf8_to_char_code($char) {
	    if (mb_check_encoding($char, 'UTF-8')) {
	        $ret = mb_convert_encoding($char, 'UTF-32BE', 'UTF-8');
	        $ret = hexdec(bin2hex($ret));
	        if($ret != '0'){
	        	return $ret;
	        }
	    }
	    return null;
	}
}