<?php

/**
 * @author edv-mueller.com
 * @copyright 2012
 * Basis-Object
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/config/init.php";
require_once join(array(__VID__, "lib", "utils", "Singleton.php"), DS);
require_once join(array(__VID__, "lib", "utils", "JSON.php"), DS);

class aObject
{
	/**
	 * @var Services_JSON
	 * */
	var $json;

	function aObject() {
		$this->json = &singleton('Services_JSON');
	}

  var $__dbMapping = array();
  var $_dbMappingCheckbox = array();
  var $_checkboxes = array();
  function load($id, $src, $data)  { /* overwrite */ }

  function _loadDB($vars, $data) {

    foreach($vars as $name => $value) {
      if (substr($name, 0, 1) == "_") continue;

      list($obType, $objName) = explode("_", $name, 2);
      $dbName = $objName;
      if (isset($this->_dbMapping[$objName])) $dbName = $this->_dbMapping[$objName];

      if (isset($data[$dbName])) {
        if ($obType == "date")
          $this->{$name} = $data[$dbName] == "" ? "" : strftime("%d.%m.%Y", $data[$dbName]);
        else
          $this->{$name} = $data[$dbName];
      }
    }

    //checkboxen auslesen
    if (isset($data["checkboxes"]) && $data["checkboxes"] != null) {
      foreach(explode("|", $data["checkboxes"]) as $pair) {
        list($name, $value) = explode(":", $pair);
        if (in_array($name, $this->_dbMappingCheckbox)) {
          $this->_checkboxes[$name] = ($value == "x" ? "on" : "off" );
        }
      }
    }

  }

  function _loadPost($vars, $data) {
    $prefix = isset($data["_prefix"]) ? $data["_prefix"] : "";
    if (isset($data["id"])) {
      $this->load($data["id"], "db", null); // alte Daten aus DB, falls nicht über Seite kommt
    }

    //checkboxen auslesen
    foreach($this->_dbMappingCheckbox as $name) {
      $this->_checkboxes[$name] = (isset($data[$prefix . $name]) ? "x" : "-" );
    }

    foreach($vars as $name => $value) {
      if (substr($name, 0, 1) == "_") continue;
      list($elType, $elName) = explode("_", $name, 2);
      $dataName = $prefix . $elName;
      if (!isset($data[$dataName])) continue;
      $data[$dataName] = $data[$dataName];

      if ($elType == "num")
        $this->{$name} = baseUtil::getDouble( $data[$dataName] );
      else
        $this->{$name} = baseUtil::decodeURL( $data[$dataName] );
    }
  }

  function aGetObject($kind = "php", $vars) {
    if ($kind == "php")
      return $this;

    else if ($kind == "json") {
      $obj = array();
      foreach($vars as $name => $value) {
        if (substr($name, 0, 1) == "_") continue;
        list($type, $clsName) = split("_", $name);
        if ($type == "txt") $obj[$clsName] = utf8_encode($this->{$name});
        if ($type == "idx") $obj[$clsName] = $this->{$name};
        if ($type == "date") $obj[$clsName] = $this->{$name};
        if ($type == "num") $obj[$clsName] = $this->{$name};
      }
      return $this->json->encode($obj);
    }

    else
      return "NN";
  }

  function _getDefaults() {
    $defaults = array();
    $db = &singleton('mySQL');
    $sql = "select kind_id, id from `meta_object_type` group by kind_id  order by prio desc";
    $db->execute($sql);
    while($rec = $db->getNext()) {
      $defaults[$rec["kind_id"]] = $rec["id"];
    }

    return $defaults;
  }


	function sortObjectOnField(&$objects, $fld, $order = 'ASC') {
    $comparer = ($order === 'DESC')
        ? "return -strcmp(\$a->{$fld},\$b->{$fld});"
        : "return strcmp(\$a->{$fld},\$b->{$fld});";
    usort($objects, create_function('$a,$b', $comparer));
  }

	function sortArrayOnField(&$objects, $fld, $order = 'ASC') {
    $comparer = ($order === 'DESC')
        ? "return -strcmp(\$a['$fld'],\$b['$fld']);"
        : "return strcmp(\$a['$fld'],\$b['$fld']);";
    usort($objects, create_function('$a,$b', $comparer));
  }
  
	function getUid() {
    return uniqid(rand());
	}
}