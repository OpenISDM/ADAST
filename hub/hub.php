<?php

/**
 *
 * DESCRIPTION:
 *     Implement Google Pubsubhubbub Hub.
 *
 * @author     Chung-Min Huang (Charles), Cheng-Wei Yu (Old Yu)
 * @copyright  Open Source
 * @project    OpenISDM (http://openisdm.iis.sinica.edu.tw/)
 *
 */

// notice hub to update feed
if ($_REQUEST['notification'] == 'true' && $_REQUEST['topic'] != '') {
    $content = file_get_contents($_REQUEST['topic']);
    $file = './cached_data/' . md5($_REQUEST['topic']);
    file_put_contents($file, $content);

    $subscriber_list = file('./subscribers/' . md5($_REQUEST['topic']));
    foreach ($subscriber_list as $callback) {
        postdata($callback, $_REQUEST['topic'], $content);
    }
}

// subscribe action
if ($_REQUEST['callback'] != '' && $_REQUEST['topic'] != '') {
    $filename = './subscribers/' . md5($_REQUEST['topic']);
    $subscriber_list = file($filename);
    if (!in_array($_REQUEST['callback']."\n", $subscriber_list)) {
        file_put_contents($filename, $_REQUEST['callback']."\n", FILE_APPEND);
    }
    echo file_get_contents('./cached_data/' . md5($_REQUEST['topic']));
}

// post data
function postdata($callback, $topic, $content) {
    $post_data = array();
    $post_data['topic'] = $topic;
    $post_data['content'] = $content;
    $url = $callback;
    $o = "";
    foreach ($post_data as $k => $v) {
        $o .= "$k=" . urlencode($v) . "&";
    }
    $post_data = substr($o, 0, -1);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $result = curl_exec($ch);
}

?>
