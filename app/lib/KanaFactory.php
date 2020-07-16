<?php
namespace Aljdic;

class KanaFactory
{
	var $hiragana_strokes = array("あ" => 3,
								  "か" => 3,
								  "さ" => 3,
								  "た" => 4,
								  "な" => 4,
								  "は" => 3,
								  "ま" => 3,
		                          "や" => 3,
		                          "ら" => 2,
								  "わ" => 2,
								  "が" => 5,
								  "ざ" => 5,
								  "だ" => 6,
								  "ば" => 5,
								  "ぱ" => 5,
								  "ぁ" => 3,
								  "ゃ" => 3,
								  "い" => 2,
								  "き" => 4,
								  "し" => 1,
								  "ち" => 2,
								  "に" => 3,
								  "ひ" => 1,
								  "み" => 2,
								  "り" => 2,
								  "ぎ" => 6,						  
								  "じ" => 3,
								  "ぢ" => 4,
								  "び" => 3,
								  "ぴ" => 2,
								  "ぃ" => 2,
								  "う" => 2,
								  "く" => 1,
								  "す" => 2,
								  "つ" => 1,
								  "ぬ" => 2,
								  "ふ" => 4,
								  "む" => 3,
								  "ゆ" => 2,
								  "る" => 1,
								  "ん" => 1,
								  "ぐ" => 2,
								  "ず" => 3,
								  "づ" => 3,
								  "ぶ" => 6,
								  "ぷ" => 5,
								  "ぅ" => 2,
								  "ゅ" => 2,
								  "っ" => 1,
								  "え" => 2,
								  "け" => 3,
								  "せ" => 3,
								  "て" => 1,
								  "ね" => 2,
								  "へ" => 1,
								  "め" => 2,
								  "れ" => 2,
								  "げ" => 5,
								  "ぜ" => 5,
								  "で" => 3,
								  "べ" => 3,
								  "ぺ" => 2,
								  "ぇ" => 2,
								  "お" => 3,
								  "こ" => 2,
								  "そ" => 1,
								  "と" => 2,
								  "の" => 1,
								  "ほ" => 4, 
								  "も" => 3,
								  "よ" => 2,
								  "ろ" => 1,
								  "を" => 3,
								  "ご" => 4,
								  "ぞ" => 3,
								  "ど" => 4,
								  "ぼ" => 6,
								  "ぽ" => 5,
								  "ぉ" => 3,
								  "ょ" => 2);

	var $katakana_strokes = array("ア" => 2,
								  "カ" => 2,
								  "サ" => 3,
								  "タ" => 3,
								  "ナ" => 2,
								  "ハ" => 2,
								  "マ" => 2,
		                          "ヤ" => 2,
		                          "ラ" => 2,
								  "ワ" => 2,
								  "ガ" => 4,
								  "ザ" => 5,
								  "ダ" => 5,
								  "バ" => 4,
								  "パ" => 3,
								  "ァ" => 2,
								  "ャ" => 2,
								  "イ" => 2,
								  "キ" => 3,
								  "シ" => 3,
								  "チ" => 3,
								  "ニ" => 2,
								  "ヒ" => 2,
								  "ミ" => 3,
								  "リ" => 2,
								  "ギ" => 5,						  
								  "ジ" => 5,
								  "ヂ" => 5,
								  "ビ" => 5,
								  "ピ" => 3,
								  "ィ" => 2,
								  "ウ" => 3,
								  "ク" => 2,
								  "ス" => 2,
								  "ツ" => 3,
								  "ヌ" => 3,
								  "フ" => 1,
								  "ム" => 2,
								  "ユ" => 2,
								  "ル" => 1,
								  "ン" => 2,
								  "グ" => 4,
								  "ズ" => 4,
								  "ヅ" => 4,
								  "ブ" => 3,
								  "プ" => 2,
								  "ゥ" => 3,
								  "ュ" => 2,
								  "ッ" => 3,
								  "エ" => 3,
								  "ケ" => 3,
								  "セ" => 2,
								  "テ" => 3,
								  "ネ" => 4,
								  "ヘ" => 1,
								  "メ" => 2,
								  "レ" => 1,
								  "ゲ" => 5,
								  "ゼ" => 4,
								  "デ" => 5,
								  "ベ" => 3,
								  "ペ" => 2,
								  "ェ" => 3,
								  "オ" => 3,
								  "コ" => 2,
								  "ソ" => 2,
								  "ト" => 2,
								  "ノ" => 1,
								  "ホ" => 4, 
								  "モ" => 3,
								  "ヨ" => 3,
								  "ロ" => 3,
								  "ヲ" => 3,
								  "ゴ" => 4,
								  "ゾ" => 4,
								  "ド" => 4,
								  "ボ" => 6,
								  "ポ" => 5,
								  "ォ" => 3,
								  "ョ" => 2);

	public function __destruct(){
		$this->hiragana_strokes = null;
		$this->katakana_strokes = null;
	}

	public static function is_hiragana($char){
		if (preg_match("/^[ぁ-ん]+$/u", $char)) {
			return true;
		} else {
			return false;
		}
	}

	public static function is_katakana($char){
		if (preg_match("/^[ァ-ヶ]+$/u", $char)) {
			return true;
		} else {
			return false;
		}
	}

	public function get_info_kana($char){
		$info = array();
		if(self::is_hiragana($char)){
			$info['type'] = 'hiragana';
			if(array_key_exists ( $char , $this->hiragana_strokes )){
				$info['stroke_count'] = $this->hiragana_strokes[$char];
			}
			$info['jlpt'] = 5;
		} elseif (self::is_katakana($char)) {
			$info['type'] = 'katakana';
			if(array_key_exists ( $char , $this->katakana_strokes )){
				$info['stroke_count'] = $this->katakana_strokes[$char];
			}
			$info['jlpt'] = 5;
		}
		return $info;
	}
}

?>