<?php
/**
 * @author Dirk Müller
 * @copyright 2008
 * 
 * meine abstracte Klasse für mySQL
 */

if (!defined("FILE_CONNECT"))
  define('FILE_CONNECT', $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');

class mySQL {

  /**
   * beinhaltet alle Connect-infos
   * @var array 
   * */
  var $_connections;
  var $resultSet;
  var $executeTime;  

  var $debug = false;
  
  function mySQL()
  {
    $mySQL_version = "02";
    include FILE_CONNECT;
    $this->_connections = array();

    if (!is_array($dbName)) {
      $this->_connections['main'] = array(
        'host'    => $dbHost,
        'user'    => $dbUser,
		    'pass'    => $dbPW,
		    'name'    => $dbName,
		    'handle'  => null
      );
    } 
    else {
      foreach ($dbName as $k => $v) {
        if ($k=='0') {
					if (!isset($dbPw)) $dbPw = array("");
          $this->_connections['main'] = array(
            'host'    => $dbHost[0],
            'user'    => $dbUser[0],
    		    'pass'    => (isset($dbPw[0]) ? $dbPw[0] : ""),
    		    'name'    => $dbName[0],
		        'handle'  => null
          );
        }
        else {
          $this->_connections[$k] = array(
            'host'    => (($d = $dbHost[$k])=='' ? $dbHost[0] : $d),
            'user'    => (($d = $dbUser[$k])=='' ? $dbUser[0] : $d),
    		    'pass'    => (($d = $dbPw[$k])=='' ? $dbPw[0] : $d),
    		    'name'    => (($d = $dbName[$k])=='' ? $dbName[0] : $d),
		        'handle'  => null
          );
        }
      }
    } 
  }

  function _getDbHandle($conName = 'main')
  {
    $con = $this->_connections[$conName];

    if ($con['handle']==null) {
		 	$link = mysql_connect($con['host'], $con['user'], $con['pass']) 
				or die("Die Verbindung zur Datenbank ist zur Zeit nicht möglich! Bitte versuchen Sie ... " . mysql_error());

			mysql_select_db($con['name'], $link) 
				or die("Auswahl der Datenbank fehlgeschlagen: " . mysql_error());
			
			$con['handle'] = $link;
    }
    
    return $con['handle'];    
  } 

  /**
  * execute a sql-Statement
  * @param		$sql    text	the SQL-Statement
  * @return		void
  */
  function execute($sql, $conName='main')
  {
    if ($sql==null || $sql=='')
      die("Anfrage fehlgeschlagen: kein SQL-Syntax erkannt!");

    $dbLink = $this->_getDbHandle($conName);  
    $executeStart = explode(" ",microtime());
    
    $this->resultSet = mysql_query($sql, $dbLink)
      or die("Anfrage fehlgeschlagen: " . mysql_error());

		$executeEnd = explode(" ",microtime());		
		$this->executeTime = ($executeEnd[0]+$executeEnd[1]) - ($executeStart[0]+$executeStart[1]);			
  }

  function getNext($methode = MYSQL_ASSOC) 
  {
    if (!$this->resultSet)
      return false;
    else
      return mysql_fetch_array($this->resultSet, $methode);
  }
		
  function getCount() {
    if (!$this->resultSet) 
      return 0;
    else
			return mysql_affected_rows();
  }
  
  function dump($conName='main', $path, $number_of_files=5)
  {
		if (!is_dir($path)) die("path '" . $path . "' not found!");
		if (!is_dir($path)) die("path '" . $_SERVER['DOCUMENT_ROOT'] . "_logs' not found!");

		$autoDelete = true;
		$packed = true;
		$fileName = $this->_connections[$conName]["name"] . "_dump_" . mw_format(mktime(), "DATE", "TIMESTAMP") . ".gz";

		$hndPath = opendir($path);
		unset($files_unlink);

		if ($autoDelete) {
			while ($filename = readdir($hndPath)) {
	    	if (strpos($filename, $this->_connections[$conName]["name"] . "_dump_") !== false) {
					$files_unlink[] = $filename;
	    	}
			}

			@rsort($files_unlink);
//			die(count($files_unlink) . ": " . print_r($files_unlink, true));

		  if (count($files_unlink) >= $number_of_files) {
				for($n = count($files_unlink)-1; $n>=$this->number_of_files; $n--) {
	     		echo("Lösche - '" . $path . $files_unlink[$n] . "' ..<br>\n");
		    	unlink($this->path . $files_unlink[$n]);
		    }
		  } else
		  {
        echo("KEINE Datei gelöscht!<br>\n");
      }
		}

		$dumpFile = $path . "/" . $fileName;
		if (file_exists($dumpFile)) unlink($datei);
		$cmd = "/usr/bin/mysqldump"
					. " -u" . $this->_connections[$conName]["user"]
					. " -p" . $this->_connections[$conName]["pass"]
					. " -h localhost " . $this->_connections[$conName]["name"]
					. " | gzip > "	. $dumpFile;
		echo("call: '" . $cmd . "' ..<br>\n");
//		$sysCall = "/usr/bin/mysqldump -u$this->user -p$this->pass -h localhost $this->database | gzip > "	. $datei;
		//$this->logAdd("Ausführen: '" . $sysCall . "'");
		system($cmd, $fp);
		
		//echo $fp;
  }
		
}
	
	
if (isset($_GET["testLIB"])) {

	$test = new mySQL();
	//echo $test->_getDbHandle('main');
	
  $test->execute('select count(*) from sr_booked_busseats');
	if ($row = $test->getNext()) {
		echo 'main::' . print_r($row, true);
	}

  $test->execute('select count(*) from sr_booked_busseats', 'hist');
	if ($row = $test->getNext()) {
		echo 'hist::' . print_r($row, true);
	}

}		
		
?>