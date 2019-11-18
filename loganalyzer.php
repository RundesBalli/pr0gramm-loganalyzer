<?php
/**
 * Loganalyzer
 * 
 * CLI Tool zum Auswerten der verschiedenen Votes aus dem Sync-Log.
 * 
 * @author    RundesBalli <webspam@rundesballi.com>
 * @copyright 2019 RundesBalli
 * @version   1.0
 * @license   MIT-License
 * @see       https://github.com/RundesBalli/pr0gramm-loganalyzer
 */

/**
 * Einbinden des apiCalls.
 * Download: https://github.com/RundesBalli/pr0gramm-apiCall
 * 
 * Beispielwert: /home/user/apiCall/apiCall.php
 * 
 * @param string
 */
require_once("");

/**
 * 1. Holen des kompletten Logs
 * 2. Nur den 'log'-Teil behalten
 * 3. Base64 Dekodieren
 * 4. In Teile zu je 5 Zeichen splitten
 */
$log = str_split(base64_decode(apiCall("https://pr0gramm.com/api/user/sync?offset=0")['log']), 5);

/**
 * Verschiedene Vote-Typen als Array anlegen.
 */
$itemcount = array();
for($i=1;$i<16;$i++) {
  $itemcount[$i] = 0;
}

/**
 * Verschiedene Vote-Typen benennen.
 * Danke an @Mopsalarm:
 * @see https://github.com/mopsalarm/Pr0/blob/62b3e13a5961424ae32e918a10736eba5710d7fa/app/src/main/java/com/pr0gramm/app/services/VoteService.kt#L241-L258
 */
$types = array(
  1=>"VOTE\tITEM\tDOWN",
  2=>"VOTE\tITEM\tNEUT",
  3=>"VOTE\tITEM\tUP",
  4=>"VOTE\tCOMMENT\tDOWN",
  5=>"VOTE\tCOMMENT\tNEUT",
  6=>"VOTE\tCOMMENT\tUP",
  7=>"VOTE\tTAG\tDOWN",
  8=>"VOTE\tTAG\tNEUT",
  9=>"VOTE\tTAG\tUP",
  10=>"VOTE\tITEM\tFAVO",
  11=>"VOTE\tCOMMENT\tFAVO",
  12=>"FOLLOW\tFOLLOW\t",
  13=>"FOLLOW\tNONE\t",
  14=>"FOLLOW\tSUBSCRIBED",
  15=>"FOLLOW\tFOLLOW\t"
);

/**
 * Die einzelnen Votes durchgehen und die Typen zählen.
 */
foreach($log as $key => $logvalue) {
  /**
   * Danke an @Mopsalarm für die unpack-Formel.
   * 
   * @see https://www.php.net/unpack
   */
  $byteArray = unpack("V1id/c1action", $logvalue); 
  $itemcount[$byteArray['action']]++;
}

/**
 * Anzeige der verschiedenen Vote-Typen.
 */
foreach($itemcount as $key => $val) {
  echo str_pad($key.".", 3, " ", STR_PAD_LEFT)." ".$types[$key]."\t".$val."\n";
}
echo "\nErgänzungen:\n";
echo "Item = Post\nNEUT = Vote entfernt\n";
echo "12: Stelzen\n13: Entfolgen\n14: Folgen + Benachrichtigen\n15: Benachrichtigungen wieder aus\nGezählt werden nicht die gestelzten Nutzer, sondern die Anzahl an Handlungen.\n";
echo "\n".count($log)." Gesamtvotes\n";
?>
