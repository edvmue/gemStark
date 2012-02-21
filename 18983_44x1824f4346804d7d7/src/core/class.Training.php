<?php

/**
 * @author edv-mueller.com
 * @copyright 2012
 *
 * @descr Verwalten der Massnahmen
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/config/init.php";
require_once join(array(__VID__, "src", "abstract.Class.php"), DS);
require_once join(array(__VID__, "src", "abstract.Util.php"), DS);

class Training
	extends aClass
{

  function Training() {
    $this->aClass();
    $this->ajaxName = "coreTraining";
  }
  
  function getGrid($req) {
    return "{ rows : [{\"id\":0,\"data\":[\"0001\", \"ex0001\", \"test\", \"01.01.2012\",\"31.03.2012\",\"12\"]}] }";
  }

	function handleAjaxRequest($req) {
    $action = $req["action"];

    if ($action == "getList") {
      echo $this->getTree();
    }

    else if ($action == "getListXML") {
      $id = isset($req["id"]) ? $req["id"] : "0";
      echo $this->printTreeXML($id);
    }

    else if ($action == "getCount") {
      echo "okay|" . $this->getItemsCount();
    }

    else if ($action == "add") {
      echo "okay|" . $this->add($req["topic"], $req["kind"], $req["idOld"])->getObject("json");
    }

    else if ($action == "get") {
      echo "okay|" . $this->getById($req["id"])->getObject("json");
    }

    else if ($action == "save") {
      echo "okay|" . $this->save($req["id"], $req);
    }

    else if ($action == "del") {
      echo "okay|" . $this->remove($req["id"]);
    }

  }

}
if (isset($_REQUEST["method"])) {
  $clsName = "Training";
	$obj = new $clsName();
	$obj->handleRequest($_REQUEST);
}