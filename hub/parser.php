<?php

echo 'hello ^^';

//$file = file('input/debris_alerts.xml');
$file = file_get_contents('input/debris_alerts.xml');
//$XML = simplexml_load_file($file);
echo $file;
//foreach ($line in $file) {
    //echo $line;
//}

# //notice hub to update feed
# if($_REQUEST['notification']!='' && $_REQUEST['topic']!=''){
#   $content = file_get_contents($_REQUEST['topic']);
#   $file = 'url_temporary/'.md5($_REQUEST['topic']);
#   file_put_contents($file,$content);
# 
#   $subscriber_list = file('subscriber/'.md5($_REQUEST['topic']));
#   foreach($subscriber_list as $value){
#     postdata($value,$_REQUEST['topic'],$content);
#   }
# }
# 
# //subscribe action
# if($_REQUEST['callback']!=''){
#   $filename = 'subscriber/'.md5($_REQUEST['topic']);
#   $subscriber_list = file($filename);
#   if(!in_array($_REQUEST['callback']."\n",$subscriber_list)){
#     file_put_contents($filename,$_REQUEST['callback']."\n",FILE_APPEND);
#   }
#   echo file_get_contents('url_temporary/'.md5($_REQUEST['topic']));
# }
# 
# function postdata($callback,$topic,$msg){
#   $post_data = array();
#   $post_data['topic'] = $topic;
#   $post_data['msg'] = $msg;
#   $url=$callback;
#   $o="";
#   foreach ($post_data as $k=>$v){
#     $o.= "$k=".urlencode($v)."&";
#   }
#   $post_data=substr($o,0,-1);
#   $ch = curl_init();
#   curl_setopt($ch, CURLOPT_POST, 1);
#   curl_setopt($ch, CURLOPT_HEADER, 0);
#   curl_setopt($ch, CURLOPT_URL,$url);
#   curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
#   curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
#   $result = curl_exec($ch);
# }

?>