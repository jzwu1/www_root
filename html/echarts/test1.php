<?php
  require("db_config.php");
  $pdo=new PDO("mysql:host=$mysql_server_name;dbname=$mysql_database",$mysql_username,$mysql_password) or die("error connecting") ;
  $pdo->query("set names 'utf8'"); //数据库输出编码
  #mysql_select_db($mysql_database); //打开数据库

  $result = $pdo->query("SELECT fetch_time, currency_name, XCH_BUYIN FROM crawler_currency where currency_name = '美元' order by fetch_time desc");

  $data="";
  $array= array();

  class User {
    public $fetch_time;
    public $currency_name;
    public $XCH_BUYIN;
  };
 
  foreach ($result as $row){
    $user=new User();
    $user->fetch_time = $row['fetch_time'];
    $user->currency_name = $row['currency_name'];
    $user->XCH_BUYIN = $row['XCH_BUYIN'];
    $array[]=$user;
  }
  $data=json_encode($array);

  echo $data;
?>
