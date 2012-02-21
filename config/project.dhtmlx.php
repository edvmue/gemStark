<?php

  if (isset($_REQUEST["_loadDHTMLX"])
      || isset($_REQUEST["showJS"])) {
    die();
  }

/*	// Hilfe-System wird immer geladen!	
	if (isset($_loadDHTMLX)) {
		$_loadDHTMLX .= ",helpSystem";
	}
	else { 
		$_loadDHTMLX = "helpSystem";
	}
*/
	$showStyles["d"] = array(); // default - zuerst laden
	$showStyles["c"] = array(); // cusomter - nach den Default-Werten
	
	if (isset($_loadDHTMLX)) {
		$showJS[] = "%dhtmlx%/dhtmlxcommon.js"; // commonClass
		$showJS[] = "%dhtmlx%/message.js"; // commonClass
		$_loadDHTMLX_items = explode(",",$_loadDHTMLX);
		//print_r($_loadDHTMLX_items); die();

		if (in_array("menu", $_loadDHTMLX_items)) {
			$showJS[] = "%dhtmlx%/dhtmlxmenu.js";
			$showJS[] = "%dhtmlx%/ext/dhtmlxmenu_ext.js";
			$showStyles["d"][] = $_CSS["%dhtmlx%"] . "/dhtmlxmenu_" .  $_CSS["%dhtmlxSkin%"] . ".css";
		}
		
		if (in_array("toolbar", $_loadDHTMLX_items)) {
			$showJS[] = "%dhtmlx%/dhtmlxtoolbar.js";
			$showJS[] = "/js/base.toolbar.js";
			$showStyles["d"][] = $_CSS["%dhtmlx%"] . "/dhtmlxtoolbar_" .  $_CSS["%dhtmlxSkin%"] . ".css";
			$showStyles["d"][] = "/styles/dhtmlxtoolbar_customer.css";
		}

		if (in_array("tree", $_loadDHTMLX_items) || in_array("helpSystem", $_loadDHTMLX_items)) {
			$showJS[] = "%dhtmlx%/dhtmlxtree.js";
			$showJS[] = "%dhtmlx%/ext/dhtmlxtree_json.js";
			$showStyles["d"][] = $_CSS["%dhtmlx%"] . "/dhtmlxtree.css";
			$showStyles["d"][] = "/styles/dhtmlxtree_customer.css";
		}

		if (in_array("grid", $_loadDHTMLX_items)) {
			$showJS[] = "%dhtmlx%/dhtmlxgrid.js";
			$showJS[] = "%dhtmlx%/dhtmlxgridcell.js";
			$showJS[] = "/js/base.grid.js";
			$showStyles["d"][] = $_CSS["%dhtmlx%"] . "/dhtmlxgrid.css";
			$showStyles["d"][] = $_CSS["%dhtmlx%"] . "/dhtmlxgrid_dhx_skyblue.css";
			$showStyles["d"][] = "/styles/dhtmlxgrid_customer.css";
		}

 		if (in_array("grid_filter", $_loadDHTMLX_items)) {
			$showJS[] = "%dhtmlx%/dhtmlxgrid_filter.js";
		}
 		if (in_array("grid_drag", $_loadDHTMLX_items)) {
			$showJS[] = "%dhtmlx%/dhtmlxgrid_drag.js";
		}

		if (in_array("tabbar", $_loadDHTMLX_items)) {
			$showJS[] = "%dhtmlx%/dhtmlxtabbar.js";
			$showJS[] = "/js/base.tabbar.js";
			$showStyles["d"][] = $_CSS["%dhtmlx%"] . "/dhtmlxtabbar.css";
			$showStyles["d"][] = "/styles/dhtmlxtabbar_customer.css";
		}

		if (in_array("calendar", $_loadDHTMLX_items)) {
			$showJS[] = "%dhtmlx%/dhtmlxcalendar.js";
			$showJS[] = "/js/base.calendar.js";
			$showStyles["d"][] = $_CSS["%dhtmlx%"] . "/dhtmlxcalendar.css";
		}

		if (in_array("slider", $_loadDHTMLX_items)) {
			$showJS[] = "%scriptaculous";
			$showJS[] = "/js/sliderBase.js";
			$showStyles["d"][] = "/styles/dhtmlxslider_customer.css";
		}

		if (in_array("windows", $_loadDHTMLX_items) || in_array("helpSystem", $_loadDHTMLX_items)) {
			$showJS[] = "%dhtmlx%/dhtmlxwindows.js";
			$showJS[] = "/js/base.window.js";
			$showStyles["d"][] = $_CSS["%dhtmlx%"] . "/dhtmlxwindows.css";
			$showStyles["d"][] = $_CSS["%dhtmlx%"] . "/dhtmlxwindows_" .  $_CSS["%dhtmlxSkin%"] . ".css";
			//$showStyles["c"][] = $_CSS["%dhtmlxCustomer%"] . "/dhtmlxwindows_customer.css";
			//shadow
			$showJS[] = "%dhtmlx%/community/windowsshadow/dhtmlxwindows_shadow.js";
			$showStyles["d"][] = $_CSS["%dhtmlx%"] . "/community/windowsshadow/dhtmlxwindows_shadow.css";
		}
		
		if (in_array("layout", $_loadDHTMLX_items) || in_array("helpSystem", $_loadDHTMLX_items)) {
			$showJS[] = "%dhtmlx%/dhtmlxlayout.js"; // commonClass
			$showStyles["d"][] = $_CSS["%dhtmlx%"] . "/dhtmlxlayout.css";
			$showStyles["d"][] = $_CSS["%dhtmlx%"] . "/dhtmlxlayout_" .  $_CSS["%dhtmlxSkin%"] . ".css";
			//$showStyles["c"][] = "/styles/dhtmlxlayout_customer.css";
		}

		if (in_array("upload", $_loadDHTMLX_items)) {
			$showJS[] = "%dhtmlx%/dhtmlxvault.js"; // Uploader
			$showJS[] = "/js/base.uploader.js";
			$showStyles["d"][] = $_CSS["%dhtmlx%"] . "/dhtmlxvault.css";
			$showStyles["d"][] = "/styles/dhtmlxvault_customer.css";
		}

		if (in_array("message", $_loadDHTMLX_items)) {
			$showStyles["d"][] = $_CSS["%dhtmlx%"] . "/dhtmlxmessage_skyblue.css";
			$showStyles["c"][] = "/styles/dhtmlxmessage_customer.css";
		}

		$showStyles = array_merge(
			$showStyles["d"],
			array("/styles/dhtmlx/dhtmlx_custom.css"),
			$showStyles["c"]);

		$showJS[] = "%dhtmlx%/dhtmlxcontainer.js";
	}
?>