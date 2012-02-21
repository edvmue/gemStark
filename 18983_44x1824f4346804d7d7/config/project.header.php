<?php
	include "version.php";

	if (!isset($justBody)) $justBody = false;
	if (!$justBody) include "project.meta.php";
?>

</head>
<body style="background-image:url(/images/bg.jpg); background-repeat:repeat-x ">
<div id="calendar" style="position:absolute; left:199px; top25px; display:none"></div>
<div id="_httpxLoad" style="display:none">laden .. <img src="/images/loader/indicator_small.gif"></div>
<!-- div id="xtopsection" style="border:0px solid black ">
	<div id="menuData" style="display: none;">
		<div id="php#inputs_booking" text="Buchungen / Kunden"></div>
		<div id="tlSep_02" text="&nbsp;|&nbsp;" disabled="true"></div>
		<div id="m3" text="Datei">
			<div id="url#logout" text="Abmelden"></div>
		</div>
		<div id="m4" text="Abrechnungen">
	     	<div id="php#report_abrechnung_partner" text="Partner"></div>
	     	<div id="php#report_abrechnung_taxi" text="Taxi-Transfer"></div>
     		<div id="m4_s1" type="separator" text="|"></div>
	     	<div id="php#report_abrechnung_tagesbeleg" text="Tagesbeleg"></div>
		</div>
		<div id="m5" text="Kontrollen">
	     	<div id="php#report_controlling_restzahlungen" text="Restzahlungen"></div>
	     	<div id="php#report_controlling_provisionseingang" text="Provisionseingang"></div>
		</div>
		<div id="m6" text="Statistik">
	     	<div id="php#report_adhoc" text="Umsatz - aktuell"></div>
	     	<div id="php#report_chart_index" text="Umsatz - gesamt"></div>
     		<div id="m6_s1" type="separator" text="|"></div>
	     	<div id="php#report_controlling_umsatzbuero" text="Buchungslisten"></div>
     		<div id="m6_s2" type="separator" text="|"></div>
	     	<div id="php#report_controlling_staffranking" text="MA-Wettbewerb"></div>
		</div>
		<div id="analyse" text="Analysen">
	     	<div id="php#report_analyse_frequenz" text="regelm. Buchungen"></div>
	     	<div id="php#report_analyse_struktur" text="Strukturanlayse"></div>
		</div>
		<div id="setup" text="Setup">
	     	<div id="php#setup_staff" text="Angestellte"></div>
	     	<div id="php#setup_office" text="Büros"></div>
	     	<div id="php#setup_partner" text="Partner"></div>
     		<div id="setup_s1" type="separator" text="|"></div>
	     	<div id="php#setup_operator" text="Veranstalter"></div>
	     	<div id="php#setup_tag" text="Eigenschaften (Tags)"></div>
	     	<div id="php#setup_travelkind" text="Leistungsart"></div>
	     	<div id="php#setup_paymentkind" text="Zahlungsart"></div>
     		<div id="setup_s2" type="separator" text="|"></div>
	     	<div id="php#setup_freetext" text="Pulldown-Listen"></div>
	     	<div id="php#setup_customers" text="Kunden-Liste"></div>
	     	<div id="php#adminData_geodata" text="GeoData"></div>
     		<div id="setup_s3" type="separator" text="|"></div>
	     	<div id="php#setup_staffranking" text="Faktoren MA-Wettbewerb"></div>
	     	<div id="php#mandanten_admin_index" text="Verwaltung"></div>
		</div>
		<div id="tlSep_03" text="&nbsp;|&nbsp;" disabled="true"></div>
		<div id="extra" text="Extras">
			<div id="php#mdl_priceGraber_search" text="HolidayCheck - Auswahl"></div>
     		<div id="extra_s1" type="separator" text="|"></div>
			<div id="php#misc_changelog_index" text="Changelog"></div>
			<div id="php#misc_phpinfo" text="php-Info"></div>
			<div id="url#pear" text="PEAR Admin"></div>
			<div id="url#db_dumper" text="DB-Dump Admin"></div>
     		<div id="extra_s2" type="separator" text="|"></div>
			<div id="javascript#KV.HelpSystem.show()" text="Hilfe"></div>
			<div id="php#sonst_info" text="Info"></div>
		</div>
    </div -->
	<!-- div id="_marquee_top" ></div -->

<!-- script src="<?= BASE ?>/config/menu.js" type="text/javascript"></script -->