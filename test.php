<?php
$num = $_GET['num'];
$num = 2;
$data = [
    'w_id' => 118,
];
$url = 'http://zbz.legaldaily.com.cn/works/index.php/home/works/addVote';
for ($i = 0; $i > $num; $i++ ){
    $postdata = http_build_query($data);
    $opts = array('http' =>
        array( 'method'  => 'POST','header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata ) );
    $context = stream_context_create($opts);
    $result = file_get_contents($url, false, $context);
    var_dump($result);

}