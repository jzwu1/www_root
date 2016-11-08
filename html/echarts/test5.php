<?php
  require("db_config.php");
  $pdo=new PDO("mysql:host=$mysql_server_name;dbname=$mysql_database",$mysql_username,$mysql_password) or die("error connecting") ;
  $pdo->query("set names 'utf8'"); //数据库输出编码
  #mysql_select_db($mysql_database); //打开数据库

  $result = $pdo->query("SELECT fetch_time, average_price, number_for_sale,deals_in_90days,visitors_for_yesterday FROM crawler_lianjia where district = '上海' order by fetch_time desc");

  $data="";
  $array= array();

  class User {
    public $fetch_time;
    public $number_for_sale;
    public $average_price;
  };
 
  foreach ($result as $row){
    $user=new User();
    $user->fetch_time = $row['fetch_time'];
    $user->currency_name = '上海';
    $user->average_price = $row['average_price'];
    $array[]=$user;
  }
  $data=json_encode($array);

  echo $data;
?>
