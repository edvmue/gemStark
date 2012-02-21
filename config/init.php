<?php
  if (isset($_REQUEST["_noSessionStart"])
      || isset($_REQUEST["_noLoad"])) {
    die();
  }

	if (!isset($_noSessionStart)) $_noSessionStart = false;
	if (!isset($_noLoad)) $_noLoad = false;
	define("__VID__", "18983_44x1824f4346804d7d7");

	// set locals
	setlocale (LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');
	setlocale (LC_NUMERIC, 'en_US'); // interne Zahlendarstellung

	// set paths
	if (!defined("DS")) define("DS", DIRECTORY_SEPARATOR);
	if (!defined("PS")) define("PS", PATH_SEPARATOR);

	ini_set('include_path', 
			 $_SERVER['DOCUMENT_ROOT'] . PS
			. $_SERVER['DOCUMENT_ROOT'] . "config" . DS . PS
	);

	if (@preg_match_all("/.*(xxx\.de)$/", $_SERVER['HTTP_HOST'], $items)) {
      if (!defined("IS_WEB"))     define("IS_WEB", "true");
      if (!defined("SHOW_DEBUG")) define("SHOW_DEBUG", false);
	  	error_reporting(0);
	}
	else {
      if (!defined("IS_WEB"))     define("IS_WEB", "false");
      if (!defined("SHOW_DEBUG")) define("SHOW_DEBUG", true);
 }

  if (!$_noLoad) {
  	if (!$_noSessionStart) {
  	    if (isset($_REQUEST["psi"])) session_id($_REQUEST["psi"]);
      	session_start();
  	}

    $_SESSION["__SKIN__"] = "dhx_skyblue";
  	include_once "project.stdpaths.php";

  	// sonstiges
  	if (!isset($_loadDHTMLX)) $_loadDHTMLX = "dummy";
  	$_loadDHTMLX .= ",layout,menu,toolbar,message";
  	require_once "project.dhtmlx.php"; // alle benötigten dHTMLX-Komponenten laden

  	$_strNowGerman = strftime("%d.%m.%Y");
  } // ? $_noLoad
