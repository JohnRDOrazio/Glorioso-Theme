<?php 
global $_THEME_CFG,$_FN,$htmlver;
//$htmlver['htmlversion']="xhtml11"; // for debugging purposes!

// create selectvals array
$hour = 0;
for($i=0;$i<=47;$i++){
  if($i % 2 == 0){ if($hour<10){$hour = "0".$hour;} $selectvals[] = $hour.":00"; }
  else{ $selectvals[] = $hour.":30"; $hour += 1; } 
}

function fillselectoptions($vals,$min=false,$max=false){
  $str = "";
  if($min){
    while($i=array_shift($vals)){ if($i==$min){ break; } }
    $str .= "<option>{$min}</option>";
    while($i=array_shift($vals)){ $str.= "<option>{$i}</option>"; }
    return $str;
  }
  if($max){
    while($i=array_shift($vals)){ if($i==$max){ $str .= "<option>{$i}</option>"; return $str; } $str .= "<option>{$i}</option>"; }
    return $str;
  }
  while($i=array_shift($vals)){ $str .= "<option>{$i}</option>"; }
  return $str;
}
?>

<!-- CALENDAR (GOOGLE) -->
<div id="calendarviewer" title="CALENDARIO DEGLI EVENTI - <?php echo $_FN['sitename'] ?>"></div>
<!-- </div> -->
<div id="create_cal_event_wrapper" title="CREA UN NUOVO EVENTO">
<div id="create_cal_event_form" class="ui-corner-bottom ui-corner-tr">
<form id="create_cal_event" method="" action="">
  <table>
    <tr><td><label for="fc_ev_title">TITOLO EVENTO:</label></td><td><input type="text" name="fc_ev_title" id="fc_ev_title" value="" /></td></tr>
    <tr><td><label for="fc_ev_desc">DESCRIZIONE EVENTO:</label></td><td><input type="text" name="fc_ev_desc" id="fc_ev_desc" value="" /></td></tr>
    <tr><td><label for="fc_ev_where">DOVE:</label></td><td><input type="text" name="fc_ev_where" id="fc_ev_where" value="" /></td></tr>
    <tr><td><label for="fc_ev_startDate">COMINCIA:</label></td><td>
<?php
if($htmlver['htmlversion']=="html5"){ 
  echo "<input type='date' name='fc_ev_startDate' id='fc_ev_startDate' value='' />";
}
else{
  echo "<input type='text' name='fc_ev_startDate' id='fc_ev_startDate' value='' class='datepicker' />";
}
?>
    </td></tr>
    <tr><td><label for="fc_ev_startTime">ORARIO INIZIO:</label></td><td>
<?php
if($htmlver['htmlversion']=="html5"){ 
  echo "<input type='time' name='fc_ev_startTime' id='fc_ev_startTime' style='width:70px;' />"; 
}
else{
  echo "<select name='fc_ev_startTime' id='fc_ev_startTime'>";
  echo fillselectoptions($selectvals,false,"04:00");
  echo "</select>";
}
?>    
  </td></tr>
  <tr><td><label for="fc_ev_endDate">FINISCE:</label></td><td>
<?php
if($htmlver['htmlversion']=="html5"){ 
  echo "<input type='date' name='fc_ev_endDate' id='fc_ev_endDate' value='' />";
}
else{
  echo "<input type='text' name='fc_ev_endDate' id='fc_ev_endDate' value='' class='datepicker' />";
}
?>
  </td></tr>
  <tr><td><label for="fc_ev_endTime">ORARIO FINE:</label></td><td>
<?php
if($htmlver['htmlversion']=="html5"){ 
  echo "<input type='time' name='fc_ev_endTime' id='fc_ev_endTime' style='width:70px;' />"; 
}
else{
  echo "<select name='fc_ev_endTime' id='fc_ev_endTime'>";
  echo fillselectoptions($selectvals);
  echo "</select>";
}
?>
  </td></tr>
    <tr>
      <td>
        <input type="hidden" name="actiontodo" id="fc_ev_actiontodo" value="createEvent" />
        <input type="hidden" name="argc" id="argc" value="12" />
        <input type="hidden" name="username" value="<?php echo $_THEME_CFG['gaccount_user'] ?>" />
        <input type="hidden" name="password" value="<?php echo $_THEME_CFG['gaccount_pass'] ?>" />
      </td>
      <td></td>
    </tr>
  </table>
</form>
</div>
</div>
<!-- END CALENDAR -->
<div style="display:none;">
<span>DEBUG INFORMATION:</span>
<div id="debug" style="position:fixed;top:50%;left:50%;margin-top:-50px;margin-left:-40%;border:2px inset Red;padding:5px;margin:5px;height:100px;width:80%;background:LightGray;"></div>
</div>