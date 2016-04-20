<?php
//DB.class.php

class DB {

protected $db_name = 'radio';
protected $db_user = 'root';
protected $db_pass = 'vertrigo';
protected $db_host = 'localhost';

// Открывает соединение к БД. Убедитесь, что
// эта функция вызывается на каждой странице 
public function connect() {
$connection = mysql_connect($this->db_host, $this->db_user, $this->db_pass);
mysql_select_db($this->db_name);
return true;
}

// Берет ряд mysql и возвращает ассоциативный массив, в котором
// названия колонок являются ключами массива. Если singleRow - true,
// тогда выводится только один ряд
public function processRowSet($rowSet, $singleRow=false)
{
$resultArray = array();
while($row = mysql_fetch_assoc($rowSet))
{
array_push($resultArray, $row);
}
if($singleRow === true)
return $resultArray[0];
return $resultArray;
}

//Выбирает ряды из БД
//Выводит полный ряд или ряды из $table используя $where 
public function select($table, $where) {
$sql = "SELECT * FROM $table WHERE $where";
$result = mysql_query($sql);
if(mysql_num_rows($result) == 1)
return $this->processRowSet($result, true);
return $this->processRowSet($result);
}

//Вносит изменения в БД
public function update($data, $table, $where) {
foreach ($data as $column => $value) {
$sql = "UPDATE $table SET $column = $value WHERE $where";
mysql_query($sql) or die(mysql_error());
}
return true;
}

//Вставляет новый ряд в таблицу
public function insert($data, $table) {

$columns = "";
$values = "";
foreach ($data as $column => $value) {
$columns .= ($columns == "") ? "" : ", ";
$columns .= $column;
$values .= ($values == "") ? "" : ", ";
$values .= $value;
}

$sql = "insert into $table ($columns) values ($values)";
mysql_query($sql) or die(mysql_error());

//Выводит ID пользователя в БД.
return mysql_insert_id();
}
}

?>