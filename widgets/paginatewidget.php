<?php
	
namespace pagescms\widget;

class PaginateWidget extends Widget{

	protected function run(array $optionsArray = array()){

		$optionsArray['maxpages'] = 7;

		if ($optionsArray['display'] == 0) return;
		
		$pagesCount = ceil($optionsArray['total']/$optionsArray['display']);
		if ($pagesCount < 2) return;
		
		$wrapper = '';
		$currentPage = !empty($optionsArray['current']) ? (int)$optionsArray['current'] : 1;

		$pagesArray = array();

		if ($optionsArray['maxpages'] !== false){
			$prevCount = floor($optionsArray['maxpages']/2);
			$nextCount = $optionsArray['maxpages']-$prevCount-1;
			$start = $currentPage-$prevCount;
			$end = $currentPage+$nextCount+1;
			if ($start < 1) {
				$start = 1; 
				$end = $start+$optionsArray['maxpages'];
			}
			if ($end >= $pagesCount){
				$end = $pagesCount+1;
				$start = $end-$optionsArray['maxpages'];
				if ($start < 1) {
					$start = 1; 
				}
			}
		} else {
			$start = 1; 
			$end = $pagesCount+1;
		}

		if ($currentPage > 1){
			$first = '<a href="?q=site" class="first">&lt;&lt;</a>';
			$prevPage = $currentPage-1;
			if ($prevPage > 1){
				$url = '?q=site&page='.$prevPage;
			} else {
				$url = '?q=site';
			}
			$prev = '<a href="'.$url.'" class="prev">&lt;</a>';
		} else {
			$first = '<span class="first">&lt;&lt;</span>';
			$prev = '<span class="prev">&lt;</span>';
		}

		if ($currentPage < $pagesCount){
			$lastPage = $pagesCount;
			$url = '?q=site&page='.$lastPage;
			$last = '<a href="'.$url.'" class="last">&gt;&gt;</a>';
			$nextPage = $currentPage+1;
			$url = '?q=site&page='.$nextPage;
			$next = '<a href="'.$url.'" class="next">&gt;</a>';
		} else {
			$last = '<span class="last">&gt;&gt;</span>';
			$next = '<span class="next">&gt;</span>';
		}			

		$pages = '';
		for ($i=$start,$j=$end;$i<$j;$i++){
			if ($i == $currentPage){
				$pages .= '<span class="current">'.$i.'</span>';
			} else {
				$url = '?q=site&page='.$i;
				if ($i == 1){
					$url = '?q=site';
				}
				$pages .= '<a href="'.$url.'" class="current">'.$i.'</a>';
			}
		}

		$ret = '<div class="paginate">'.$first.$prev.$pages.$next.$last.'</div>';

		return $ret;

	}

}

?>