<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	$titelBase = "Massnahmen - Verwaltung " . $_VERSION;
	if (!isset($titel)) $titel = "";
	if (!isset($pageTitelDescritpion)) $pageTitelDescritpion = $titelBase;
	if (!defined("BASE")) define ("BASE", "");

?>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
		<link rel="shortcut icon" type="image/x-icon" href="<?= BASE ?>/report_user.png">
		<meta name="language" content="de">
		<meta name="robots" content="index, follow">
		<meta name="revisit-after" content="30 days">
		<meta http-equiv="expires" content="21600">
		<meta name="description" content="<?= $pageTitelDescritpion ?>">
		<title><?= ( $titelBase . $titel ) ?></title>

<?
	if (!isset($showStyles) || in_array("default", $showStyles)) {
?>
		<link rel="stylesheet" media="screen" type="text/css" href="<?= BASE ?>/styles/screen.css">
<?php
	}

	if (isset($showStyles)) {
		foreach ($showStyles as $style)
		{
			if ($style != "default") {
				echo "\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"$style\">\n";
			}
		}
	}
?>
		<script src="<?= BASE . $_JS["%prototype"] ?>" type="text/javascript"></script>
		<script src="<?= BASE ?>/js/util.js" type="text/javascript"></script>
		<script src="<?= BASE ?>/js/page.js" type="text/javascript"></script>
		<script type="text/javascript">
		window.urlBase = "http://<?= $_SERVER['HTTP_HOST'] ?>";
		window.menuMainBlocked = false;
		Event.observe(window, "load", function(){
			Layout.SKIN = "<?php echo $_SESSION["__SKIN__"]; ?>";
			Layout.init();
		});
		</script>
<?php
	if (!isset($showJS)) $showJS = array();
	foreach ($showJS as $script) {
		if (isset($_JS[$script]))
			echo "\t\t<script  language=\"javascript\" src=\"" . BASE . $_JS[$script] . "\" type=\"text/javascript\"></script>\n";
		else {
			foreach($_JS as $s => $r) { $script = str_replace($s, $r, $script);	}
			echo "\t\t<script language=\"javascript\" src=\"$script\" type=\"text/javascript\"></script>\n";
			if (strpos($script, "jquery") > -1) echo "\t\t<script>jQuery.noConflict();</script>\n";
		}
	}
?>
