<?php

class DString{
	
	public $replace_ini;
	
	function __construct(){
		
		$this->replace_ini = array(
				'hls01' => "=",
		);
		
		
	}

	/** Get short string from first string by custum length */
	public function str_short($str, $length){
		$str = strip_tags($str);
		/*$str = mb_strtolower($str, 'utf8');
			$str = mb_convert_case($str, MB_CASE_TITLE, 'utf8');*/
		$strlen = strlen($str);
		if($strlen <= $length){
			return $str;
		}
		$str = substr($str, 0, $length);
		$arr = explode(" ", $str);
		$end_arr = count($arr) - 1;
		unset($arr[$end_arr]);
		$str = implode(" ", $arr);
		return $str. "...";
	}
	
	
	
	/** Convert string */
	public function str_convert($str){
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|A)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|E)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ|I)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|O)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|U)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ|Y)/", 'y', $str);
		$str = preg_replace("/(đ|Đ|D)/", 'd', $str);
		$str = preg_replace("/(B)/", 'b', $str);
		$str = preg_replace("/(%)/", '', $str);
		$str = preg_replace("/( – )/", '-', $str);
		$str = preg_replace("/( - )/", '-', $str);
		$str = preg_replace("/( )/", '-', $str);
		$str = preg_replace("/(  )/", '-', $str);
		$str = preg_replace("/(   )/", '-', $str);
		$str = preg_replace("/(    )/", '-', $str);
		$str = preg_replace("/(C)/", 'c', $str);
		$str = preg_replace("/(G)/", 'g', $str);
		$str = preg_replace("/(L)/", 'l', $str);
		$str = preg_replace("/(M)/", 'm', $str);
		$str = preg_replace("/(N)/", 'n', $str);
		$str = preg_replace("/(P)/", 'p', $str);
		$str = preg_replace("/(Q)/", 'q', $str);
		$str = preg_replace("/(H)/", 'h', $str);
		$str = preg_replace("/(T)/", 't', $str);
		$str = preg_replace("/(K)/", 'k', $str);
		$str = preg_replace("/(S)/", 's', $str);
		$str = preg_replace("/(R)/", 'r', $str);
		$str = preg_replace("/(V)/", 'v', $str);
		$str = preg_replace("/(Y)/", 'y', $str);
		$str = preg_replace("/(W)/", 'w', $str);
		$str = str_replace('"', "", $str);
		$str = str_replace("?", "", $str);
		$str = str_replace(',', "", $str);
		$str = str_replace(':', "", $str);
		$str = str_replace('/', "-", $str);
	
		return trim($str);
	}
	
	
	function get_price($price, $prefix = "đ"){
		$price = str_replace(",", "", $price);
		$price = intval($price);
		return number_format($price) . " " . $prefix;
	}
	
	function convert_price_to_int($value){
		$value = str_replace(",", "", $value);
		$value = intval($value);
		return $value;
	}
	
	
	/*
	 * Kiem tra danh sach key co ton tai trong array hay khong
	 * input: array, keyname - string chua danh sach key can check
	 * output: true or false
	 */
	function key_exist_inarray($array, $keyname){
		$keyarr = explode(",", $keyname);
		foreach ($keyarr AS $k => $item){
			if(!array_key_exists($item, $array)){
				return false;
			}
		}
		return true;
	}
	
	
	function convert_array_to_ini(array $arr, $th=0, $parent=null){
		$out = '';
		foreach ($arr AS $key => $value){
			if (is_array($value)){
				if($th==0)
					$out .= '[' . $key . ']' . PHP_EOL;
				$out .= $this->convert_array_to_ini($value, $th+1, $th==0?null:(($parent==null) ? $key : $parent.'.'.$key));
			}
			else{
				
				if($parent!=null) 
					$out .= $parent . '.' . $key . ' = ' . '"' . $value . '"' . PHP_EOL;
				else 
					$out .= $key . ' = ' .  '"' . $value . '"' . PHP_EOL;
			}
		}
		return $out;
	}
	
	

	function arr2ini(array $a, array $parent = array()){
		$out = '';
		foreach ($a as $k => $v){
			if (is_array($v)){
				$sec = array_merge((array) $parent, (array) $k);
				$out .= '[' . join(' : ', $sec) . ']' . PHP_EOL;
				$out .= $this->arr2ini($v, $sec);
			}
			else{
				$v = $this->replace_arr2ini($v);
				$out .= $k . ' = ' . '"'.$v.'"' . PHP_EOL;
			}
		}
		return $out;
	}
	
	
	function replace_arr2ini($str){
		foreach ($this->replace_ini AS $k => $item){
			$str = str_replace($item, $k, $str);
		}
		return $str;
	}
	
	
	function convert_replace_arr2ini($arr){
		foreach ($arr as $k => $v){
			if (is_array($v)){
				$arr[$k] = $this->convert_replace_arr2ini($v);
			}
			else{
				foreach ($this->replace_ini AS $k2 => $item){
					$v = str_replace($k2, $item, $v);
				}
				$arr[$k] = $v;
			}
		}
		return $arr;
	}
	
	
	function parse_ini_file_multi($file, $process_sections = false, $scanner_mode = INI_SCANNER_NORMAL) {
		$explode_str = '.';
		$escape_char = "'";
		// load ini file the normal way
		$data = parse_ini_file($file, $process_sections, $scanner_mode);
		if (!$process_sections) {
			$data = array($data);
		}
		foreach ($data as $section_key => $section) {
			// loop inside the section
			foreach ($section as $key => $value) {
				if (strpos($key, $explode_str)) {
					if (substr($key, 0, 1) !== $escape_char) {
						// key has a dot. Explode on it, then parse each subkeys
						// and set value at the right place thanks to references
						$sub_keys = explode($explode_str, $key);
						$subs =& $data[$section_key];
						foreach ($sub_keys as $sub_key) {
							if (!isset($subs[$sub_key])) {
								$subs[$sub_key] = [];
							}
							$subs =& $subs[$sub_key];
						}
						// set the value at the right place
						$subs = $value;
						// unset the dotted key, we don't need it anymore
						unset($data[$section_key][$key]);
					}
					// we have escaped the key, so we keep dots as they are
					else {
						$new_key = trim($key, $escape_char);
						$data[$section_key][$new_key] = $value;
						unset($data[$section_key][$key]);
					}
				}
			}
		}
		if (!$process_sections) {
			$data = $data[0];
		}
		return $data;
	}
	
	
	
	#Dung write 9:52 27/4/2016
	function query_to_csv($data_array, $head_row, $header = true, $filename, $title = false, $title_row=''){
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment;filename='.$filename);
		echo "\xEF\xBB\xBF";
		$fp = fopen('php://output', 'w');
		
		if($title){
			$row = $title_row;
			fputcsv($fp, $row);
		}
		
		if($header){
			$row = $head_row;
			fputcsv($fp, $row);
		}
	
		foreach($data_array as $row){
			fputcsv($fp, $row);
		}
	
		fclose($fp);
	}# end Dung write
	
	
	function convert_number_to_words_money($number) {
		$hyphen      = ' ';
		$conjunction = '  ';
		$separator   = ' ';
		$negative    = 'âm ';
		$decimal     = ' phẩy ';
		$dictionary  = array(
				0                   => 'Không',
				1                   => 'Một',
				2                   => 'Hai',
				3                   => 'Ba',
				4                   => 'Bốn',
				5                   => 'Năm',
				6                   => 'Sáu',
				7                   => 'Bảy',
				8                   => 'Tám',
				9                   => 'Chín',
				10                  => 'Mười',
				11                  => 'Mười một',
				12                  => 'Mười hai',
				13                  => 'Mười ba',
				14                  => 'Mười bốn',
				15                  => 'Mười năm',
				16                  => 'Mười sáu',
				17                  => 'Mười bảy',
				18                  => 'Mười tám',
				19                  => 'Mười chín',
				20                  => 'Hai mươi',
				30                  => 'Ba mươi',
				40                  => 'Bốn mươi',
				50                  => 'Năm mươi',
				60                  => 'Sáu mươi',
				70                  => 'Bảy mươi',
				80                  => 'Tám mươi',
				90                  => 'Chín mươi',
				100                 => 'trăm',
				1000                => 'ngàn',
				1000000             => 'triệu',
				1000000000          => 'tỷ',
				1000000000000       => 'nghìn tỷ',
				1000000000000000    => 'ngàn triệu triệu',
				1000000000000000000 => 'tỷ tỷ'
		);
	
		if (!is_numeric($number)) {
			return false;
		}
	
		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
			'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
			E_USER_WARNING
			);
			return false;
		}
	
		if ($number < 0) {
			return $negative . $this->convert_number_to_words_money(abs($number));
		}
	
		$string = $fraction = null;
	
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
	
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= $conjunction . $this->convert_number_to_words_money($remainder);
				}
				break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = $this->convert_number_to_words_money($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= $this->convert_number_to_words_money($remainder);
				}
				break;
		}
	
		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}
	
		return $string;
	}
	
	
	function get_run_time($time, $finish=0){
		$finish = ($finish==''||$finish<1000000000) ? time() : $finish;
		$time = $finish - $time;
		$number = $time / 3600;
		
		$number = round($number, 1);
		return $number;
	}
	
}