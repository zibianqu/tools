<?php 
/**
 * 调用微信接口服务类
 * @author Administrator
 *
 */
namespace Home\Service;
use Think\Model;
class WeiXinService extends Model{
	private static $access_token;
	private $accesstokenurl='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential';//获取accesstoken接口
	private $createmenuurl='https://api.weixin.qq.com/cgi-bin/menu/create';//创建菜单
	private $getmenuurl='https://api.weixin.qq.com/cgi-bin/menu/get';//获取菜单
	private $setindustryurl='https://api.weixin.qq.com/cgi-bin/template/api_set_industry';//设置所属行业
	private $gettemplateidurl='https://api.weixin.qq.com/cgi-bin/template/api_add_template';
	private $sendtemplateurl='https://api.weixin.qq.com/cgi-bin/message/template/send';
	private $menu=array(
				'button'=>array(
					 array('type'=>'click','name'=>'今日新番','key'=>'Today_a_new_fan'),
					 array(
							'name'=>'菜单',
							'sub_button'=>array(
									array('type'=>'view','name'=>'嘀哩嘀哩','url'=>'http://www.dilidili.wang/'),
									array('type'=>'view','name'=>'哔哩哔哩','url'=>'http://www.bilibili.com/'),
								),
							
						),
					),
			);
	
	public function __construct(){
		self::getAccessToken();
	}
	
	/**
	 * 获取access_token
	 * @return string
	 */
	public function getAccessToken(){
// 		if (!isset($this->access_token)){
			$APPID=C('appID');
			$APPSECRET=C('appsecret');
			$url=$this->accesstokenurl."&appid={$APPID}&secret={$APPSECRET}";
			$curl=new CurlService();
			$res=$curl->getinfo($url);
			$res=json_decode($res,true);
			if($res['expires_in']==7200){
				$this->access_token=$res['access_token'];
			}else{
				LogService::writelog(date('Y-m-d H:i:s').'     access_token获取出错或access_token有效');
				$this->access_token='';
			}
// 		}
		return $this->access_token;
	}
	
	/**
	 * 创建菜单
	 */
	public function createMenu(){
		$access_token=empty($this->access_token)?'':$this->access_token;
		$url=$this->createmenuurl."?access_token={$access_token}";
		$curl=new CurlService();
		$res=$curl->getinfo($url,json_encode($this->menu,JSON_UNESCAPED_UNICODE),'post');
		$res=json_decode($res,true);
		if($res['errcode']==200){
			LogService::writelog(date('Y-m-d H:i:s').'     菜单创建成功');
		}else{
			LogService::writelog(date('Y-m-d H:i:s').'     菜单创建失败     errormsg:'.$res['errmsg']);
		}
	}
	
	/**
	 * 查询菜单
	 */
	public function getMenu(){
		$access_token=empty($this->access_token)?'':$this->access_token;
		$url=$this->getmenuurl."?access_token={$access_token}";
		$curl=new CurlService();
		$res=$curl->getinfo($url);
		$res=json_decode($res,true);
		var_export($res);
		if($res['errcode']==200){
			LogService::writelog(date('Y-m-d H:i:s').'     查询菜单成功');
		}else{
			LogService::writelog(date('Y-m-d H:i:s').'     查询菜单失败     errormsg:'.$res['errmsg']);
		}
	}
	
	
	//设置所属行业
	public function setIndustry(){
		$access_token=empty($this->access_token)?'':$this->access_token;
		$url=$this->setindustryurl."?access_token={$access_token}";
		$industry=array('industry_id1'=>"37",'industry_id2'=>"39");
		$curl=new CurlService();
		$res=$curl->getinfo($url,json_encode($industry,JSON_UNESCAPED_UNICODE),'post');
		$res=json_decode($res,true);
		var_export($res);
	}
	
	
	//获取模板id
	public function getTemplateId($id){
		$access_token=empty($this->access_token)?'':$this->access_token;
		$url=$this->gettemplateidurl."?access_token={$access_token}";
		$templateid=array('template_id_short'=>$id);
		$curl=new CurlService();
		$res=$curl->getinfo($url,json_encode($templateid,JSON_UNESCAPED_UNICODE),'post');
		$res=json_decode($res,true);
		var_export($res);
	}
	
	/**
	 * 发送模板信息
	 * @param unknown $touser  发送给某个用户
	 */
	public function sendTemplateId($touser){
		$access_token=empty($this->access_token)?'':$this->access_token;
		$url=$this->sendtemplateurl."?access_token={$access_token}";
		$template=array(
				'touser'=>$touser,
				'template_id'=>'wJ89HM6z9oLJgrbrUcY0I8l-IJhh8oDiHtDmuf6buv8',
				'url'=>'http://www.bilibili.com/mobile/video/av8471651.html',
				'data'=>array(
					'first'=>array('value'=>'好看的动漫','color'=>'#173177'),
					'keyword1'=>array('value'=>'幼女战记','color'=>'#173177'),
					'keyword2'=>array('value'=>'6','color'=>'#173177'),
					'keyword3'=>array('value'=>date('Y-m-d H:i:s'),'color'=>'#173177'),
					'remark'=>array('value'=>'敬请期待。。。','color'=>'#173177'),
				),
		);
		$curl=new CurlService();
		$res=$curl->getinfo($url,json_encode($template,JSON_UNESCAPED_UNICODE),'post');
		$res=json_decode($res,true);
		var_export($res);
		
	}
	
	/**
	 * 相关回复
	 */
	public function responseMsg()
	{
		//$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];//返回回复数据
		$postStr = file_get_contents("php://input");
		LogService::writelog(date('Y-m-d H:i:s').' ------------开始回复信息---------'.json_encode($postStr));
		if (!empty($postStr))
		{
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUsername = $postObj->FromUserName;//发送消息方ID
			$toUsername = $postObj->ToUserName;//接收消息方ID
			$keyword = trim($postObj->Content);//用户发送的消息
			$times = time();//发送时间
			$MsgType = $postObj->MsgType;//消息类型
			$msgType = "text";
			$content="";
			if($MsgType=='event')
			{
				$MsgEvent = $postObj->Event;//获取事件类型
				if ($MsgEvent=='subscribe')
				{
					
					$content="很感谢您的关注，希望在我这里能找到你喜欢的，输入数字键1,2,3,4有惊喜！！！";
					$textTpl="<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $times, "text", $content);
					LogService::writelog(date('Y-m-d H:i:s').' ------------结束回复信息---------');
					echo $resultStr;
					//订阅事件
				}
				elseif ($MsgEvent=='CLICK')
				{
					//点击事件
					$EventKey = $postObj->EventKey;//菜单的自定义的key值，可以根据此值判断用户点击了什么内容，从而推送不同信息
					switch($EventKey)
					{
						case "Today_a_new_fan" :
							$title="今日新番推荐";
							$descript="幼女战记幼女战记幼女战记幼女战记幼女战记幼女战记";
							$content="《幼女战记》";
							$PicUrl="http://f.hiphotos.baidu.com/baike/w%3D268%3Bg%3D0/sign=f7f7624ecb95d143da76e3254bcbe53f/d1a20cf431adcbefc359f04bafaf2edda3cc9f0a.jpg";
							$Url="http://www.bilibili.com/mobile/video/av8471651.html";
							break;
						default:
							$content="您好，感谢你的关注。";
							break;
					}
					$textTpl = "<xml>
				       <ToUserName><![CDATA[%s]]></ToUserName>
				       <FromUserName><![CDATA[%s]]></FromUserName>
				       <CreateTime>%s</CreateTime>
				       <MsgType><![CDATA[%s]]></MsgType>
				       <Content><![CDATA[%s]]></Content>
				       <FuncFlag>0</FuncFlag>
				       </xml>";
					$textTpl="<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[news]]></MsgType>
								<ArticleCount>1</ArticleCount>
								<Articles>
									<item>
										<Title><![CDATA[%s]]></Title>
										<Description><![CDATA[%s]]></Description>
										<PicUrl><![CDATA[%s]]></PicUrl>
										<Url><![CDATA[%s]]></Url>
									</item>
								</Articles>
							</xml> ";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $times,$title,$descript,$PicUrl,$Url);
					LogService::writelog(date('Y-m-d H:i:s').' ------------结束回复信息---------');
					echo $resultStr;
				}
			}elseif($MsgType=='text'){
				$c=$postObj->Content;//接收的消息内容
				switch ($c){
					case 1:
						$content="首推新番《幼女战记》";
						break;
					case 2:
						$content="《All Out》";
						break;
					case 3:
						$content="《三月的狮子》";
						break;
					default :
						$content="《海贼王》，《龙珠超》";
						break;
				}
				$textTpl="<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $times, "text", $content);
				LogService::writelog(date('Y-m-d H:i:s').' ------------结束回复信息---------');
				echo $resultStr;
				
			}
		}
		else
		{
			echo '没有任何消息传递';
		}
	}
	
	
	private $menu1=' {
				     "button":[
				     {
				          "type":"click",
				          "name":"今日新番",
				          "key":"Today_a_new_fan"
				      },
				      {
				           "name":"菜单",
				           "sub_button":[
				           {
				               "type":"view",
				               "name":"搜索",
				               "url":"http://www.soso.com/"
				            },
				            {
				               "type":"view",
				               "name":"视频",
				               "url":"http://v.qq.com/"
				            },
				            {
				               "type":"click",
				               "name":"赞一下我们",
				               "key":"V1001_GOOD"
				            }]
				       }]
				 }';
	private $menu2='{
				    "button": [
				        {
				            "name": "扫码",
				            "sub_button": [
				                {
				                    "type": "scancode_waitmsg",
				                    "name": "扫码带提示",
				                    "key": "rselfmenu_0_0",
				                    "sub_button": [ ]
				                },
				                {
				                    "type": "scancode_push",
				                    "name": "扫码推事件",
				                    "key": "rselfmenu_0_1",
				                    "sub_button": [ ]
				                }
				            ]
				        },
				        {
				            "name": "发图",
				            "sub_button": [
				                {
				                    "type": "pic_sysphoto",
				                    "name": "系统拍照发图",
				                    "key": "rselfmenu_1_0",
				                   "sub_button": [ ]
				                 },
				                {
				                    "type": "pic_photo_or_album",
				                    "name": "拍照或者相册发图",
				                    "key": "rselfmenu_1_1",
				                    "sub_button": [ ]
				                },
				                {
				                    "type": "pic_weixin",
				                    "name": "微信相册发图",
				                    "key": "rselfmenu_1_2",
				                    "sub_button": [ ]
				                }
				            ]
				        },
				        {
				            "name": "发送位置",
				            "type": "location_select",
				            "key": "rselfmenu_2_0"
				        },
				        {
				           "type": "media_id",
				           "name": "图片",
				           "media_id": "MEDIA_ID1"
				        },
				        {
				           "type": "view_limited",
				           "name": "图文消息",
				           "media_id": "MEDIA_ID2"
				        }
				    ]
				}';
}
?>