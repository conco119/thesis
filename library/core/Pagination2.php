<?php

class Pagination{

	public function paging($page, $fields, $pagesize = 20) {
		$module = THIS_LINK;
		if ($fields % $pagesize == 0) {
			$maxpage = $fields / $pagesize;
		} else {
			$maxpage = ceil($fields / $pagesize);
		}
		if(strpos($module, "?page=") == true){
			$module = explode("?page=", $module);
		}
		else{
			$module = explode("&page=", $module);
		}
		$module = current($module);

		$getpage = explode("?", $module);
		$sour = "?";
		if(count($getpage) > 1){
			$sour = "&";
		}

		$str = "";
		$str .= "<ul class='pagination'>";

		$first = "";
		$str .= "<li><a href='" . $module . $sour . "page=1'>First</a></li>";
		if($page >1){
			$PrevStart=$page-1;
			$str .= "<li><a href='" . $module . $sour . "page=" . $PrevStart . "'>&laquo;</a></li>";
		}
		$currentPage = 0;
		$pf = $page - 2;
		$pt = $page + 2;
		If ($pf < 1)
		$pf = 1;

		If ($pt > $maxpage)
		$pt = $maxpage;
		if (empty($page)) $page = 1;
		if (empty($pagesize)) $pagesize = 1;
		if (empty($recordcount)) $recordcount = 1;
		for($currentPage=$pf;$currentPage<=$pt;$currentPage++){
			if($currentPage < $maxpage){
				if($currentPage == $page){
					if($currentPage % $pagesize){
						$str.= "<li class='active'><a>$currentPage</a></li>";
					}else{
						$str.= "<li class='active'><a>$currentPage</a></li>";
					}
				}elseif($currentPage % $pagesize){
					$str.= "<li><a class='link' href='" .$module . $sour . "page=" . $currentPage . "'>$currentPage</a></li>";
				}else{
					$str.= "<li><a class='link' href='" .$module . $sour . "page=" . $currentPage . "'>$currentPage</a></li>";
				}
			}else{
				if($page == $maxpage){
					$str.= "<li class='active'><a>$currentPage</a>";
					break;
				}else{
					$str.="<li><a href='" .$module . $sour . "page=" . $currentPage . "'>$currentPage</a></li>";
					break;
				}
			}
		}
		if($page < $maxpage){
			$NextPage=$page+1;
			$str.= "<li class=''><a href='" .$module . $sour . "page=" . $NextPage . "'>&raquo;</a></li>";
		}
		$str.= "<li><a href='" .$module . $sour . "page=" . $maxpage . "'>Last</a></li>";
		$str .= "</ul>";
		return $str;
	}



	/*
	 * Hàm phân trang
	*/
	function get_content($fields, $pagesize=50){
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$start = ($page - 1) * $pagesize;

		$paging = $this->paging($page, $fields, $pagesize);

		$sql_add = " LIMIT $start,$pagesize";

		return array(
				"paging" => $paging,
				"sql_add" => $sql_add
		);
	}


}