<?php

function substr_startswith($haystack, $needle) {
    return substr($haystack, 0, strlen($needle)) === $needle;
}

function getURL($URL) {


    $sourceUrl = parse_url($URL);
    if (!isset($sourceUrl['host'])) {
        return "";
    }
    $sourceUrl = $sourceUrl['host'];

    return $sourceUrl;
}

function parse_mysql_dump($filename){
     
	  global $success,$msg;
	  $templine = '';
	  
	  $lines = file($filename);
	  foreach ($lines as $line_num => $line) {
//               echo $line;
		  if (substr($line, 0, 2) != '--' && $line != '') {
			  $templine .= $line;
			  if (substr(trim($line), -1, 1) == ';') {
				  if (!mysql_query($templine)) {
					  $success = false;
                                          echo 'asdasdasdasd';
					  $msg = "<div class=\"qerror\">'".mysql_errno()." ".mysql_error()."' during the following query:</div> 
					  <div class=\"query\">{$templine} </div>";
                                          echo $msg;
                                          
				  }
				  $templine = '';
			  }
		  }
	  }
  }
  function writeConfigFile($host, $database_username, $database_password, $database_name, $site_username, $site_password)
  {
      global $success;
      
          $content = "<?php \n" 
		  . "\t \$settings['mysql']['server'] = '".$host."'; \n" 
		  . "\t \$settings['mysql']['username'] ='".$database_username."'; \n"  
		  . "\t \$settings['mysql']['password'] ='".$database_password."'; \n"  
		  . "\t \$settings['mysql']['database'] ='" . $database_name . "';\n"
                  . "\t \$settings['login']['username'] ='" . $site_username . "';\n"
                  . "\t \$settings['login']['password'] ='" . $site_password . "';\n"
		  . "?>";
      
      $confile = 'config.php';
    
      if (is_writable('inc/')) {
          $handle = fopen($confile, 'w');
          fwrite($handle, $content);
          fclose($handle);
          $success = true;
      } else {
          $success = false;
      }
  }

   function mysql_c($server, $user, $pass, $db) {
    mysql_connect($server, $user, $pass) or die(mysql_error());
    mysql_select_db($db) or die(mysql_error());
    
  }
  
  function mysql_q($query) {
    $res = mysql_query($query);
    if(!$res) { die(mysql_error()); }
    return $res;
  }
  

function mysql_idc($table) {
    $r = mysql_fetch_array(mysql_q('SELECT * FROM '.$table.' ORDER BY `id` DESC'));
    return $r['id'] + 1;
  }
  
  
  function crypt_ip($ip) {
    for($i = 0; $i <= 15; $i++) {
      $ip = hash('adler32', hash('ripemd160', md5($ip))); }
    return $ip;
  }
  
  
  function page_c($table) {
    $c = mysql_result(mysql_q('SELECT COUNT(*) FROM '.$table), 0);
    return ($c / 20) + 1;
  }
  
  
function GetIP() 
{ 
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "desconocido")) 
		$ip = getenv("HTTP_CLIENT_IP"); 
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "desconocido")) 
		$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "desconocido")) 
		$ip = getenv("REMOTE_ADDR"); 
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "desconocido")) 
		$ip = $_SERVER['REMOTE_ADDR']; 
	else 
		$ip = "desconocido"; 
	return($ip); 
} 




?>