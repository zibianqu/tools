<?php 
/**
 * 标签
 * @author Administrator
 *
 */
namespace Home\Behavior;
use Think\Behavior;
use Home\Model\CommModel;
class KeyWordsBehavior extends Behavior{
	/* (non-PHPdoc)
	 * @see \Think\Behavior::run()
	 */
	public function run(&$params) {
		// TODO Auto-generated method stub
		$startstr='tcolor=0x333333&amp;tcolor2=0x333333&amp;hicolor=0x000000&amp;tspeed=100&amp;distr=true&amp;mode=both&amp;tagcloud=';
		$comm=new CommModel();
		$res=$comm->keyWordList(30);
		$str='<tags>';
		foreach ($res as $key=>$val){
			$str.='<a href="'.U('/art/lists',array('t'=>$val['name']),true,true).'" class="tag-link-'.($key).'" title="6 topics" style="font-size: 11.1204819277pt;">'.$val['name'].'</a>';	
		}
		$str.='</tags>';
		echo $startstr.urlencode($str);
	}


}