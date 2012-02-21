<?php

/**
 * @author Dirk Müller
 * @copyright 2008
 */

class baseUtil
{
	function getDouble($val)
	{
		$val = trim($val);
		//echo $val;
		if (is_numeric($val)) {
			$val = number_format(doubleval($val), 2, ".", "");
		  return $val;
		}
		else {
			$val = preg_replace('#\s|\.+#', '', $val);
      if (preg_match_all("/[^0-9,-]/", $val, $flg)) return 0;

			$val = str_replace(',', '.', $val);

			if (is_numeric($val))
				return  $val;
			else
			  return 0;
		}
	}

	/**
	 * Parst einen via POST übergebenen search String.
	 * Dabei werden keys, welche NUR in uppercase dargestellt werden, gefiltert (bsp: SID)
	 * @param	uri	string	search OHNE ?
	 * 				decode	boolean decode value with utf8_decode(urldecode(..)) 
	 * 								default is true
	 * @return mixed
	 * */
	function parseSearchURI($uri, $decode = true)
	{
		$form = array();
		$items = explode("&", $uri); 
		if (count($items) > 1) {
			foreach( $items as $item )
			{
				if (strpos($item, "=") !== false) {
					list($k, $v) = explode("=", $item);
					if (strtoupper($k) != $k )
						$form[$k] = ($decode ? utf8_decode(urldecode($v)) : $v);
				}
			}
		}
		
		return $form;
	}
	
	function encodeURL($expr, $debug = false) {
    $var = $expr;
    $var = utf8_encode($var);

    // € - Zeichen
    //$b = strpos($var, "__EURO__");
    $var = str_replace("__EURO__", "EURO", $var);
    //if ($b != false) die($var);

    return $var;
	}

	function decodeURL($expr, $debug = false) {
    $var = $expr;

    // € gibts nicht in Latin1 -> __EURO__ ersetzen
    $_var = rawurlencode($var);
    if(strpos($_var, "%E2%82%AC") !== false) {
      $var = str_replace("%E2%82%AC", "__EURO__", $_var);
      $var = rawurldecode($var);
    }

    if ($debug) echo "(1) " . mb_detect_encoding($var) . "<br/>\n";
    if (mb_detect_encoding($var) == "ASCII") {
      if ($debug) echo("encode url " . $var . "<br/>\n");
      $var = urldecode($expr);
    }

    if ($debug) echo "(2) " . mb_detect_encoding($var) . "<br/>\n";
    $d = baseUtil::_hex_chars($var);
    if (strpos($d["hex"], "{C3}") !== false) {
      if ($debug) echo("encode utf8<br/>\n");
      $var = utf8_decode($var);
    }

    if (strpos($d["hex"], "{E2}{82}{AC}") !== false) {
      if (strpos($var, "€") > -1) echo "find € # ";
      for ($i = 1; $i < 255; $i++) {
        if (($p = strpos($var, chr($i))) !== false) echo "find " . chr($i) . "(" . $i . ") on " . $p . " # \n";
      }

      //die("find hex");
      // Euro Zeichen in ISO-8859-15
    }
    
    $var = htmlspecialchars($var);
    
    if ($debug) echo("return " . $var . "<br/>\n");
    return ($var);
	}
	
  function _hex_chars($data) {
    $mb_chars = '';
    $mb_hex = '';
    for ($i=0; $i<mb_strlen($data, 'UTF-8'); $i++) {
        $c = mb_substr($data, $i, 1, 'UTF-8');
        $mb_chars .= '{'. ($c). '}';
        $o = unpack('N', mb_convert_encoding($c, 'UCS-4BE', 'UTF-8'));
        $mb_hex .= '{'. baseUtil::_hex_format($o[1]). '}';
    }
    $chars = '';
    $hex = '';
    for ($i=0; $i<strlen($data); $i++) {
        $c = substr($data, $i, 1);
        $chars .= '{'. ($c). '}';
        $hex .= '{'. baseUtil::_hex_format(ord($c)). '}';
    }
    return array(
        'data' => $data,
        'encoding' => mb_detect_encoding($data),
        'chars' => $chars,
        'hex' => $hex,
        'mb_chars' => $mb_chars,
        'mb_hex' => $mb_hex,
    );
  }

  function _hex_format($o) {
    $h = strtoupper(dechex($o));
    $len = strlen($h);
    if ($len % 2 == 1)
        $h = "0$h";
    return $h;
  }
  
  /**
   * Löscht ein Verzeichniss (rekursiv)
   * @param text path - Pfad
   * @param bool $removeSelf [true/false] wenn true, wird das Verzeichniss ebenfalls gelöscht
   * */
  function rmPath($path, $removeSelf=false) {
    $files  = scandir($path);
    for ($idx = 0; $idx < count($files); $idx++) {
      $file = $files[$idx];
      if ($file == "." || $file == "..") {
        // do nothing
      }

      else if(is_dir($path . DIRECTORY_SEPARATOR . $file)) {
        baseUtil::rmPath($path . DIRECTORY_SEPARATOR . $file, true);
      }

      else {
        unlink($path . DIRECTORY_SEPARATOR . $file);
      }
    }
    reset($files);

    if ($removeSelf) {
      rmdir($path);
    }
  }

}