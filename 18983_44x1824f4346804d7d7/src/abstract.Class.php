<?php

/**
 * @author Dirk Müller
 * @copyright 2008
 * Basis-Klasse
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/config/init.php";
require_once "abstract.Object.php";
require_once join(array(__VID__, "lib", "db", "class.mySQL.php"), DS);

class aClass extends aObject
{
	/**
	 * @var mySQL
	 * */
	var $db;
	var $debugEnable = false;
	var $logFile = "";
  var $ajaxName = "";
  
	function aClass()
	{
    $this->aObject();
		$this->db = &singleton('mySQL');
		$this->ajaxName = __CLASS__;
		$this->debugEnable = isset($_REQUEST["test"]);
	}

	function debug($msg) { if ($this->debugEnable) echo $msg . "<br>\n"; }
	function log ($msg) {
		if ($this->logFile == "")
		  $this->logFile = $_SERVER['DOCUMENT_ROOT'] . "/src/logs/"  . strftime("%Y%m%d", mktime()) . "." . __CLASS__ . ".log";
		$this->logHandler = fopen($this->logFile, "a");
		fwrite($this->logHandler, $msg . "\n");
	}

	function handleRequest($req) {

		if (isset($req["obj"])) {
			if($req["method"] == "ajax" && $req["obj"] == $this->ajaxName) {
  			if (!isset($req["action"])) return "kein action attribut gefunden!";
				$this->handleAjaxRequest($req);
			}

			else if($req["method"] == "grid" && $req["obj"] == $this->ajaxName) {
				echo $this->getGrid($req);
			}

			else if($req["method"] == "autocomplete" && $req["obj"] == $this->ajaxName) {
				echo $this->getAutocompleter($req);
			}

		}
	}
}