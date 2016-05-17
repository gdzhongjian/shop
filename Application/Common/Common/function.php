<?php 

/**
 *	生成随机字符串,用于对密码进行加密
 *	@return [type] $s    [随机字符串]
 */
function RandStrings(){
	$str="0123456789abcdefghijklmnopqrstuvwxyz";  //使用的字符串
	$n=20;  //产生的随机数的长度
	$s='';  //产生的随机数字符串
	$len=strlen($str)-1;
	for($i=0;$i<$n;$i++){
		$s.=$str[rand(0,$len)];
	}
	//产生的$s即是长度为20位的随机字符串
	return $s;
}


/**
 * 	加密算法
 * 	生成两个随机字符串，和表单提交的密码组合成新的字符串，
 * 	然后再对密码进行md5加密
 * @param [type] $password [需要加密的字段]
 * @param [type] $rand1    [随机字符串1]
 * @param [type] $rand2    [随机字符串2]
 */
function Encrypt($password,$rand1,$rand2){
	$password=md5($password);
	$password=$rand1.$password.$rand2;
	$password=md5($password);
	return $password;
}


/**
 * 	使用自带的Org\Net\IpLocation类获取IP所在地址
 * @param  [type] $ip [ip地址]
 * @return [type]     [所在地]
 */
function getIpLocation($ip){
	$Ip=new \Org\Net\IpLocation('UTFWry.dat');
	$area=$Ip->getlocation($ip);
	return $area['country'];
}


/**
 * 	验证码检测正确与否
 * @param  [type] $code [验证码]
 * @param  string $id   [description]
 * @return [type]       [结果]
 */
function checkVerify($code,$id=""){
	$verify=new \Think\Verify;
	$verify->reset=false;
	return $verify->check($code,$id);
}

/**
 * 	分页方法
 * @param  [type]  $count    [数据总数]
 * @param  integer $pagesize [每页大小]
 * @return [type]            [分页链接]
 */
function getpage($count,$pagesize=10){
	$Page=new \Think\Page($count,$pagesize);
	// $Page->setConfig('first','首页');
	// $Page->setConfig('last','末页');
	// $Page -> setConfig('last','共%TOTAL_PAGE%页');
	$Page->setConfig('prev','上一页');
	$Page->setConfig('next','下一页');
	$Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
	// $Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
	$Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
	$Page->lastSuffix=false;
	return $Page;
}

/**
 * 分页显示的数据编号
 * @param  [type] $a [页数]
 * @param  [type] $b [每页显示的数量]
 * @param  [type] $i [当前页第i个数据]
 * @return [type]    [编号]
 */
function getnumber($a,$b,$i){
	return ($a-1)*$b+$i;
}

/**
 * 上传文件的文件名生成规则
 * @return [type] [文件名字符串]
 */
function fileRandNumber(){
	$str="0123456789abcdefghijklmnopqrstuvwxyz";  //使用的字符串
	$n=20;  //产生的随机数的长度
	$s=date('Ymd');  //产生的随机数字符串
	$len=strlen($str)-1;
	for($i=0;$i<$n;$i++){
		$s.=$str[rand(0,$len)];
	}
	return $s;
}
/**
 * 正则验证日期格式是否正确
 * @param  [type] $date [待检查的日期]
 * @return [type]       [返回检查结果，true为正确，false为错误]
 */
function checkDateByPost($date){
	$regex="/^((((1[6-9]|[2-9]\d)\d{2})-(0?[13578]|1[02])-(0?[1-9]|[12]\d|3[01]))|(((1[6-9]|[2-9]\d)\d{2})-(0?[13456789]|1[012])-(0?[1-9]|[12]\d|30))|(((1[6-9]|[2-9]\d)\d{2})-0?2-(0?[1-9]|1\d|2[0-8]))|(((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))-0?2-29-)) (20|21|22|23|[0-1]?\d):[0-5]?\d:[0-5]?\d$/";
	if(preg_match($regex,$date)){
		return true;
	}else{
		return false;
	}
}
/**
 * 正则验证数字是否是小数点两位小数
 * @param  [type] $data [待检查的数字]
 * @return [type]       [返回检查结果，true为正确，false为错误]
 */
function checkNumber($data){
	$regex="/^\d*\.\d{2}$/";
	if(preg_match($regex,$data)){
		return true;
	}else{
		return false;
	}
}

/**
 * 倒计时
 * @param  [type] $type [倒计时显示类型]
 * @param  [type] $time [待比较时间]
 * @return [type]       [倒计时情况]
 */
function daoJiShi($type,$time){
	$curtime=time();
	if($type=="d"){
		//返回天数
		$data=$time-$curtime;
		if($data<0){
			return 0;
		}
		$day=$data/(60*60*24);
		return (int)$day;
	}
	if($type=="H"){
		//返回小时
		$data=$time-$curtime;
		if($data<0){
			return 0;
		}
		$data=$data%(60*60*24);	//求余，得到除了天数以外的数字
		$hour=$data/(60*60);
		return (int)$hour;
	}
	if($type=="i"){
		//返回分钟
		$data=$time-$curtime;
		if($data<0){
			return 0;
		}
		$data=$data%(60*60*24)%(60*60);
		$minute=$data/60;
		return (int)$minute;
	}
	if($type=="s"){
		//返回秒
		$data=$time-$curtime;
		if($data<0){
			return 0;
		}
		$data=$data%(60*60*24)%(60*60)%60;
		$second=$data;
		return (int)$second;
	}
}


/**
 * 邮件发送
 * @param  [type] $to      [发送目标]
 * @param  [type] $title   [邮件主题]
 * @param  [type] $content [邮件内容]
 * @return [type]          [返回发送状态]
 */
function sendMail($to, $title, $content) {
 
    Vendor('PHPMailer.PHPMailerAutoload');     
    $mail = new PHPMailer(); //实例化
    $mail->IsSMTP(); // 启用SMTP
    $mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
    $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
    $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
    $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
    $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
    $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
    $mail->AddAddress($to,"尊敬的会员");
    $mail->WordWrap = 50; //设置每行字符长度
    $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
    $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
    $mail->Subject =$title; //邮件主题
    $mail->Body = $content; //邮件内容
    $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
    return($mail->Send());
}

/**
 * 订单号生成规则
 * @return [type] [订单号]
 */
function makeOrderCode(){
	$result="";
	$curtime=time();
	$result=date('YmdHis');
	$number=mt_rand(100000,999999);
	$result.=$number;
	return $result;
}

 ?>