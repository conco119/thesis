<?php

class Times{
	
	public $filter;
	public $years, $months;
		
	function __construct(){
		
	}
	
	function time_posts($timestamp){
		$time = time() - $timestamp;
		$t = 0;
		$result = $time;
		if($time < 60){
			$result = "Cách đây " . $time . " giây";
		}
		elseif ($time >= 60 && $time < 60*60){
			$t = ceil($time / 60);
			$result = "Cách đây " . $t . " phút";
		}
		elseif ($time >= 60*60 && $time < 60*60*24){
			$t = ceil($time / (60*60));
			$result = "Cách đây " . $t . " giờ";
		}
		else {
			$result = gmdate("H:i", $timestamp+7*3600);
			$result .= " ngày ";
			$result .= gmdate("d.m.Y", $timestamp+7*3600);
		}
		
		return $result;
	}
	
	
	function get_day_th($time){
		$day = gmdate("D", $time+7*3600);
		switch (strtoupper($day)){
			case "MON":
				$result = "Mo";
				break;
			case "TUE":
				$result = "Tu";
				break;
			case "WED":
				$result = "We";
				break;
			case "THU":
				$result = "Th";
				break;
			case "FRI":
				$result = "Fr";
				break;
			case "SAT":
				$result = "Sa";
				break;
			case "SUN":
				$result = "Su";
				break;
		}
		return $result;
	}
	
	function get_date_from_date($date, $type="d.m.Y"){
		$date = strtotime($date);
		return gmdate($type, $date+7*3600);
	}
	

	function get_week($date, $time=1){
		if($time != 1)
			$date = strtotime($date);
		return gmdate("W", $date+7*3600);
	}
	
	
	function get_month($date, $time=1){
		if($time != 1)
			$date = strtotime($date);
		return gmdate("m", $date+7*3600);
	}
	

	function get_year($date, $time=1){
		if($time != 1)
			$date = strtotime($date);
		return gmdate("Y", $date+7*3600);
	}
	
	
	function get_diff_date($date1, $date2=NULL, $timestamp=1){
		if($date2==NULL && $timestamp==1)
			$date2 = time();
		if($date2!=NULL && $timestamp!=1)
			$date2 = strtotime($date2);
		
		if($timestamp != 1){
			$date1 = strtotime($date1);
		}
		if($date1 < $date2)
			return 0;
		
		$time = $date1 - $date2;
		$day = $time / (60*60*24);
		
		return round($day);
	}
	
	
	function set_filter(){
		$years = array();
		$this_year = date("Y");
		for($i=$this_year; $i>=2005; $i--){
			$years[$i] = $i;
		}
		$this->years = $years;
	
		$months = array();
		for ($i=1; $i<=12; $i++){
			$months[$i] = "Tháng " . $i;
		}
		$this->months = $months;
	
		$this->filter = array(
				1 => "Lọc theo ngày",
				2 => "Lọc theo tháng/ năm"
		);
	}
	
}