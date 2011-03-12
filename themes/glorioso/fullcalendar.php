<?php global $_THEME_CFG,$_FN; ?>
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
    <tr><td><label for="fc_ev_startDate">COMINCIA:</label></td><td><input type="text" name="fc_ev_startDate" id="fc_ev_startDate" value="" /></td></tr>
    <tr><td><label for="fc_ev_startTime">ORARIO INIZIO:</label></td><td><select name="fc_ev_startTime" id="fc_ev_startTime">
    <option>01:00</option>
    <option>01:30</option>
    <option>02:00</option>
    <option>02:30</option>
    <option>03:00</option>
    <option>03:30</option>
    <option>04:00</option>
    <option>04:30</option>
    <option>05:00</option>
    <option>05:30</option>
    <option>06:00</option>
    <option>06:30</option>
    <option>07:00</option>
    <option>07:30</option>
    <option>08:00</option>
    <option>08:30</option>
    <option>09:00</option>
    <option>09:30</option>
    <option>10:00</option>
    <option>10:30</option>
    <option>11:00</option>
    <option>11:30</option>
    <option>12:00</option>
    <option>12:30</option>
    <option>13:00</option>
    <option>13:30</option>
    <option>14:00</option>
    <option>14:30</option>
    <option>15:00</option>
    <option>15:30</option>
    <option>16:00</option>
    <option>16:30</option>
    <option>17:00</option>
    <option>17:30</option>
    <option>18:00</option>
    <option>18:30</option>
    <option>19:00</option>
    <option>19:30</option>
    <option>20:00</option>
    <option>20:30</option>
    <option>21:00</option>
    <option>21:30</option>
    <option>22:00</option>
    <option>22:30</option>
    <option>23:00</option>
    <option>23:30</option>
    <option>24:00</option>
    <option>24:30</option>
  </select>
  </td></tr>
  <tr><td><label for="fc_ev_endDate">FINISCE:</label></td><td><input type="text" name="fc_ev_endDate" id="fc_ev_endDate" value="" /></td></tr>
  <tr><td><label for="fc_ev_endTime">ORARIO FINE:</label></td><td><select name="fc_ev_endTime" id="fc_ev_endTime">
    <option>01:00</option>
    <option>01:30</option>
    <option>02:00</option>
    <option>02:30</option>
    <option>03:00</option>
    <option>03:30</option>
    <option>04:00</option>
    <option>04:30</option>
    <option>05:00</option>
    <option>05:30</option>
    <option>06:00</option>
    <option>06:30</option>
    <option>07:00</option>
    <option>07:30</option>
    <option>08:00</option>
    <option>08:30</option>
    <option>09:00</option>
    <option>09:30</option>
    <option>10:00</option>
    <option>10:30</option>
    <option>11:00</option>
    <option>11:30</option>
    <option>12:00</option>
    <option>12:30</option>
    <option>13:00</option>
    <option>13:30</option>
    <option>14:00</option>
    <option>14:30</option>
    <option>15:00</option>
    <option>15:30</option>
    <option>16:00</option>
    <option>16:30</option>
    <option>17:00</option>
    <option>17:30</option>
    <option>18:00</option>
    <option>18:30</option>
    <option>19:00</option>
    <option>19:30</option>
    <option>20:00</option>
    <option>20:30</option>
    <option>21:00</option>
    <option>21:30</option>
    <option>22:00</option>
    <option>22:30</option>
    <option>23:00</option>
    <option>23:30</option>
    <option>24:00</option>
    <option>24:30</option>
  </select>
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