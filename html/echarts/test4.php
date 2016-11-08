<?php
  require("db_config.php");
  $pdo=new PDO("mysql:host=$mysql_server_name;dbname=$mysql_database",$mysql_username,$mysql_password) or die("error connecting") ;
  $pdo->query("set names 'utf8'"); //数据库输出编码
  #mysql_select_db($mysql_database); //打开数据库

  $result = $pdo->query("SELECT fetch_time, fund_name, fund_value  FROM crawler_fund order by fetch_time desc");

  $data="";
  $array= array();
  

   foreach ($result as $row){
    $row_in_array = array();
    $row_in_array[] = $row['fetch_time'];
    $row_in_array[] = $row['fund_name'];
    $row_in_array[] = $row['fund_value'];
    $array[]=$row_in_array;
  }
  

  echo json_encode(array('data' =>$array));
?>
