<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/6/14
 * Time: 9:34
 */
//exec('git pull origin master');

error_reporting ( E_ALL );
$dir = '/home/wwwroot/ng_server/';//该目录为git检出目录
$handle = popen('cd '.$dir.' && git pull origin master 2>&1','r');
$read = stream_get_contents($handle);
printf($read);
pclose($handle);
