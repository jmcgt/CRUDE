<?php
$HOME = dirname(__FILE__);
$WIN = 0;
$BOMBED = array();
RecursiveFolder($HOME);
function RecursiveFolder($sHOME) {
  global $BOMBED, $WIN;

  $win32 = ($WIN == 1) ? "\\" : "/";

  $folder = dir($sHOME);

  $foundfolders = array();
  while ($file = $folder->read()) {
    if($file != "." and $file != "..") {
      if(filetype($sHOME . $win32 . $file) == "dir"){
        $foundfolders[count($foundfolders)] = $sHOME . $win32 . $file;
      } else {
        $content = file_get_contents($sHOME . $win32 . $file);
        $BOM = SearchBOM($content);
        if ($BOM) {
          $BOMBED[count($BOMBED)] = $sHOME . $win32 . $file;
		  $content = substr($content,3);
          file_put_contents($sHOME . $win32 . $file, $content);
        }
      }
    }
  }
  $folder->close();

  if(count($foundfolders) > 0) {
    foreach ($foundfolders as $folder) {
      RecursiveFolder($folder, $win32);
    }
  }
}

function SearchBOM($string) { 
    if(substr($string,0,3) == pack("CCC",0xef,0xbb,0xbf)) return true;
    return false; 
}
?>