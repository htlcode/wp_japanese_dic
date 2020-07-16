<?php
namespace Aljdic;


class DictionaryFactory {

	public function is_japanese($lang) {
    	return preg_match('/[\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]/u', $lang);
	}

	public function get_definition_jp($keyword){
		
		$db = new Db();
		$keyword = $db->escape_string($keyword);
		$definition = array();
		$definition['meaning_japanese'] = null;

		$sql = "select sense_id,lang 
				from gloss 
				where gloss = '$keyword'
				and (lang='fre')";
		$senses = $db->execute_query($sql);

		if(count($senses) > 0){
			$sense_ids = $db->make_unique_list_of('sense_id',$senses);
			$sense_ids_str = implode(',',$sense_ids);

			$sql = "select entry_ent_seq from sense where id in ($sense_ids_str)";
			$seqs = $db->execute_query($sql);

			if(count($seqs) > 0){
				$seq_ids = $db->make_unique_list_of('entry_ent_seq',$seqs);
				$seq_ids_str = implode(',',$seq_ids);

				$sql = "select keb as 'keyword' 
				from k_ele
				where entry_ent_seq in ($seq_ids_str)
				UNION 
				select reb as 'keyword' 
				from r_ele
				where entry_ent_seq in ($seq_ids_str)";

				$glossaries = $db->execute_query($sql);

				foreach($glossaries as $gloss){
					
    					$definition['meanings_japanese'][]['meanings'][] = $gloss["keyword"];
    				
				}

				return $definition;
			}
		}
	}

	public function get_definition_fr_en($keyword){
		$meanings_french = array();
		$meanings_english = array();
		$db = new Db();
		$definition = array();
		$keyword = $db->escape_string($keyword);
		$sql = "select entry_ent_seq,keb as 'keyword' 
				from k_ele
				where keb = '$keyword'
				UNION 
				select entry_ent_seq,reb as 'keyword' 
				from r_ele
				where reb = '$keyword'";
		$seqs = $db->execute_query($sql);

		if(count($seqs) > 0){
			
			$seq_ids = $db->make_unique_list_of('entry_ent_seq',$seqs);
			$seq_ids_str = implode(',',$seq_ids);


			$sql = "select id from sense where entry_ent_seq in ($seq_ids_str)";
			$senses = $db->execute_query($sql);


			if(count($senses) > 0){
				$sense_ids = $db->make_unique_list_of('id',$senses);
				$sense_ids_str = implode(',',$sense_ids);

				$sql = "select sense_id,gloss,lang 
						from gloss 
						where sense_id in ($sense_ids_str)
						and (lang='eng' or lang='fre')";

				$glossaries = $db->execute_query($sql);	

				$sql = "select sense_id,pos 
						from pos 
						where sense_id in ($sense_ids_str)";
				$poss = $db->execute_query($sql);

				$mapPoss = array();
				foreach($poss as $pos){
					$mapPoss[$pos['sense_id']] = $pos['pos'];
				}

				foreach($glossaries as $gloss){
					$sense_id = $gloss['sense_id'];
					if($gloss['lang'] == 'fre'){
						$key = 'meanings_french';
						if(in_array($gloss['gloss'] , $meanings_french)){
							continue;
						}
					} else {
						$key = 'meanings_english';
						if(in_array($gloss['gloss'] , $meanings_english)){
							continue;
						}
					}
					
					if(array_key_exists($sense_id , $mapPoss)){ 
						$definition[$key][$sense_id]['type'] = $mapPoss[$sense_id];
						$definition[$key][$sense_id]['meanings'][] = $gloss['gloss'];
						if($gloss['lang'] == 'fre'){
							$meanings_french[] = $gloss['gloss'];
						} else {
							$meanings_english[] = $gloss['gloss'];
						}
					}
				}

				unset($glossaries);
				$glossaries = null;

			}
			unset($senses);
			$senses = null;
		}
		unset($db);
		$db = null;
		$sql = null;
		return $definition;
	}

}
?>