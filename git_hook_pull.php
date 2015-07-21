<?php  
/*    $www_folder = "/var/www/html/Maplestory"; 
    $git = "/usr/bin/git"; 
      
    //在这里获取到了用户提交的内容, 以及提交者等等, 可以记录到数据库中供以后使用  
    $raw_json = file_get_contents('php://input');  
    print_r(json_decode($raw_json, true));  
      
    echo shell_exec("cd $www_folder ; whoami ; $git pull 2>&1");  
*/
    error_reporting ( E_ALL );

	$dir = '/var/www/html/Maplestory/';//该目录为git检出目录

	$handle = popen('cd '.$dir.'; whoami && git pull 2>&1','r');

	$read = stream_get_contents($handle);

	printf($read);

	pclose($handle);

?>
