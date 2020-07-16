<?php
namespace Aljdic;

class KanjiFactory {

	public function get_kanji_info($codepoint){
		$db = new Db();
		$kanji_info = array();
		$kanji_info['id'] = null;
		$kanji_info['grade'] = null;
		$kanji_info['jlpt'] = null;
		$kanji_info['stroke_count'] = null;
		$kanji_info['onyomi'] = null;
		$kanji_info['kunyomi'] = null;

		$codepoint = $db->escape_string($codepoint);

		$sql = "SELECT kanji_character.id,cp_value,literal,grade,jlpt,stroke_count FROM kanji_codepoint,kanji_character,kanji_stroke_count
				WHERE kanji_codepoint.character_id = kanji_character.id
				AND kanji_stroke_count.character_id = kanji_character.id
				AND kanji_codepoint.cp_type = 'ucs'
				AND kanji_codepoint.cp_value = '$codepoint'
				ORDER BY stroke_count ASC";
		$main = $db->execute_query($sql);

		if(count($main) > 0){

			$kanji_info['id'] = $main[0]['id'];
			$kanji_info['grade'] = $main[0]['grade'];
			$kanji_info['jlpt'] = $main[0]['jlpt'];
			$kanji_info['stroke_count'] = intval($main[0]['stroke_count']);

			$character_id = $main[0]['id'];

			$sql = "SELECT r_type,reading FROM kanji_reading
				    WHERE character_id = $character_id 
				    AND (r_type = 'ja_on' OR r_type = 'ja_kun')";

			$readings = $db->execute_query($sql);
			foreach($readings as $reading){
				if($reading['r_type'] == 'ja_on'){
					$key = 'onyomi';
				} else {
					$key = 'kunyomi';
				}
				
				$kanji_info[$key][] = $reading['reading'];
			}

			unset($readings);
			$readings = null;

			$sql = "SELECT m_lang,meaning FROM kanji_meaning
				    WHERE character_id = $character_id 
				    AND (m_lang = 'en' OR m_lang = 'fr')";

			$meanings = $db->execute_query($sql);	
			
			foreach($meanings as $meaning){
				if($meaning['m_lang'] == 'fr'){
					$key = 'meanings_french';
				} else {
					$key = 'meanings_english';
				}

				$kanji_info[$key][] = $meaning['meaning'];
			}    

			unset($meanings);
			$meanings = null;

		}
		unset($main);
		$main = null;
		unset($db);
		$db = null;
		$sql = null;
		return $kanji_info;
	}
}
?>