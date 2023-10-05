<?php
session_start();

$name = $_SESSION["username"] ;
$namebool = $name . "bool";
//清空session信息
$_SESSION["username"] = array();
$_SESSION[$namebool] = false;
  
//清楚客户端sessionid
if(isset($_COOKIE[session_name()]))
{
  setCookie(session_name(),'',time()-3600,'/');
}
//彻底销毁session
session_destroy();

exit("True");