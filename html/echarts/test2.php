<?php
  require("db_config.php");
  $mysql_database='stock_finance_report';
  $pdo=new PDO("mysql:host=$mysql_server_name;dbname=$mysql_database",$mysql_username,$mysql_password) or die("error connecting") ;
  $pdo->query("set names 'utf8'"); //数据库输出编码
  #mysql_select_db($mysql_database); //打开数据库

  $stock_code = $_POST["stock_code"];
  $result = $pdo->query("SELECT fetch_time, market_open_price, market_price, market_top_price, market_bottom_price, cash_quantity FROM stock_daily_price where stock_code = $stock_code");

  $data="";
  $array= array();

  class Stock {
    public $fetch_time;
    public $top_price;
    public $bottom_price;
    public $open_price;
    public $close_price;
    public $volume;
  };
 
  foreach ($result as $row){
    $stock_array= array();
    $stock=new Stock();
    $stock_array[] = $stock->fetch_time = $row['fetch_time'];
    $stock_array[] = $stock->open_price = (float)$row['market_open_price'];
    $stock_array[] = $stock->close_price = (float)$row['market_price'];
    $stock_array[] = $stock->bottom_price = (float)$row['market_bottom_price'];
    $stock_array[] = $stock->top_price = (float)$row['market_top_price'];
    $stock_array[] = $stock->volume = (int)$row['cash_quantity'];
    #$array[]=$stock;
    $array[]=$stock_array;
  }
  $data=json_encode($array);

  echo $data;
?>
