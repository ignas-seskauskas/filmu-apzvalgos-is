<?php
$_mysqlConnection = new mysqli($_mysqlHost, $_mysqlUsername, $_mysqlPassword, $_mysqlDatabase);

function databaseQuery($query) {
  return $GLOBALS['_mysqlConnection']->query($query);
}

function databaseEscapeString($str) {
  return is_string($str) ? $GLOBALS['_mysqlConnection']->real_escape_string($str) : $str;
}

function databaseEscapeObject($object) {
  foreach($object as $key => &$value) {
    $value = databaseEscapeString($value);
  }
  return $object;
}

function databaseEntryById($table, $id) {
  $escaped_id = databaseEscapeString($id);
  return $GLOBALS['_mysqlConnection']->query("SELECT * FROM $table WHERE id=$escaped_id")->fetch_array(MYSQLI_ASSOC) ?? false;
}

function databaseRowsAffected() {
  return $GLOBALS['_mysqlConnection']->affected_rows;
}

function databaseInsertId() {
  return $GLOBALS['_mysqlConnection']->insert_id;
}

function databaseGetOneField($query, $fieldName) {
  $result = databaseQuery($query);
  $row = mysqli_fetch_array($result);

  if(!isset($row))
    return null;
  
  return $row[$fieldName];
}

function databaseFillObject($query, $getNewObjectFunc) {
  $result = $GLOBALS['_mysqlConnection']->query($query);
  $row = mysqli_fetch_array($result);

  if(!isset($row)) {
    return null;
  }

  $newObject = $getNewObjectFunc();
  foreach($row as $colName => $colValue) {
    if(property_exists($newObject, $colName)) {
      $newObject->$colName = $colValue;
    }
  }
  
  return $newObject;
}

function databaseFillObjects($query, $getNewObjectFunc) {
  $result = $GLOBALS['_mysqlConnection']->query($query);

  $objects = array();
  while($row = mysqli_fetch_array($result))
  {
    $newObject = $getNewObjectFunc();
    foreach($row as $colName => $colValue) {
      if(property_exists($newObject, $colName)) {
        $newObject->$colName = $colValue;
      }
    }
    $objects[]=$newObject;
  }

  return $objects;
}