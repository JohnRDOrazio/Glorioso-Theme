<script type="text/javascript">

$(document).ready(function(){
  $("form").submit(function(){
      $("span.formcheck-icon").removeClass("ui-icon ui-icon-check ui-icon-alert");
      $("#msg",$(this)).html("");
      if ( $(this).attr("id")=="linkoldaccount"){
        if($("input#choice1").is(':checked')===false&&$("input#choice2").is(':checked')===false ){
          $("[for^='choice']").each(function(){
            $(this).parent().next().children(".formcheck-icon").addClass("ui-icon ui-icon-alert");
          }); 
          $("#msg",$(this)).html("Devi scegliere quale username preferisci utilizzare.");
          return false;
        }
      }
      if ( $("input#password",$(this)).val() == $("input#password2",$(this)).val() ){
        $("[type='password']").each(function(){
          $(this).parent().next().children(".formcheck-icon").addClass("ui-icon ui-icon-check");
        }); 
        username = $("input#username",$(this)).val();
        password = $("input#password",$(this)).val();
        $.get("themes/glorioso/ajax/userpasscheck.php",{"username":username,"password":password},function(data){
          if ( data=="not a user" ){
            $("#username").parent().next().children(".formcheck-icon").addClass("ui-icon ui-icon-alert");
            $("#msg").html("Questo username non esiste! Si prega indicare uno username valido.");
            return false;            
          }
          else if ( data=="incorrect password" ) {
            $("[type='password']:first").parent().next().children(".formcheck-icon").removeClass("ui-icon-check").addClass("ui-icon-alert");
            $("#msg").html("La password non è corretta per lo username indicato. Riprova a digitare la password.");
            return false;
          }
          else if ( data=="password correct" ) {
            //alert(data);
            //$(this).submit();
            return true;          
            //$("div#socialregistration").dialog("close");
          }
        });
        
        return false;
      }
      else{
        $("[type='password']").each(function(){
          $(this).parent().next().children(".formcheck-icon").addClass("ui-icon ui-icon-alert");
        }); 
        $("#msg",$(this)).html("Le password non coincidono! Riprova a digitare le password.");
        return false;
      }
  });

  $("input#associatewithold","form#usernamealreadyexists").click(function(){
      $(".associatewithold").fadeIn("slow");
      $("button","form#usernamealreadyexists").fadeOut("slow").text("ASSOCIA ACCOUNT").fadeIn("slow");
  });
  $("input#alternativeusername","form#usernamealreadyexists").click(function(){
      $(".associatewithold").fadeOut("slow");
      $("button","form#usernamealreadyexists").fadeOut("slow").text("CREA NUOVO CON NOME UTENTE ALTERNATIVO").fadeIn("slow");
      $("form#usernamealreadyexists").submit(function(){
        return true;
      });
  });
});
</script>
<?php
/*******************************************************/
/* WELCOME TO NEW USERS                                */
/*******************************************************/
  if (!isset($_GET['stato']) ){
?>
<div style="text-align:center">
  <span>Ti sei iscritto al sito con successo utilizzando Facebook Connect!</span><br />
  <span>Se avevi già un account su questo sito, puoi anche collegarlo con il nuovo account Facebook Connect.</span><br />
  <span>Se vuoi collegarlo ad un account esistente, inserisci qui di seguito username e password del tuo account esistente.</span>
</div>
<div style="margin:15px;padding:10px;border:ridge 2px LightGray;">
  <form id="linkoldaccount" name="linkoldaccount" action="index.php?spec=linkoldaccount" method="post">
    <table>
      <tr>
        <td colspan=3 id="msg" style="text-align:center;color:#FF0000;height:15px;"></td>
      </tr>
      <tr>
        <td><label for="username">Username: </label></td>
        <td><input type="text" name="username" id="username" /></td>
        <td><span class="formcheck-icon"></span></td>
      </tr>
      <tr>
        <td><label for="password">Password: </label></td>
        <td><input type="password" name="password" id="password" /></td>
        <td><span class="formcheck-icon"></span></td>
      </tr>
      <tr>
        <td><label for="password2">Verifica password: </label></td>
        <td><input type="password" name="password2" id="password2" /></td>
        <td><span class="formcheck-icon"></span></td>
      </tr>
      <tr>
        <td><input name="choiceusername" id="choice1" type="radio" value="preferfb" /></td>
        <td><label for="choice1"> Preferisci username facebook, sovrascrivendo il vecchio username</label></td>
        <td><span class="formcheck-icon"></span></td>
      </tr>
      <tr>
        <td><input name="choiceusername" id="choice2" type="radio" value="preferold" /></td>
        <td><label for="choice2"> Preferisci username account esistente, sovrascrivendo username di facebook</label></td>
        <td><span class="formcheck-icon"></span></td>
      </tr>
    </table>
    <div style="text-align:center;"><button type="submit">COLLEGA AD ACCOUNT ESISTENTE</button></div>
  </form>	
</div>
<?php  
  }
/**********************************************/
/* NEL CASO CHE USERNAME GIA' ESISTE SUL SITO */
/**********************************************/
  if (isset($_GET['stato']) && $_GET['stato'] == 'esistente' ){
?> 
<br /><br />
<div style="text-align:center;">
  <span>Ti stai registrando a questo sito attraverso Facebook Connect.</span><br />
  <span>Vedo che c&apos;è già un account con lo stesso tuo username &apos;<?php echo $_GET['username']; ?>&apos;.</span><br />
  <span>Se l&apos;account utente sul sito è tuo, puoi collegarlo con l&apos;account creato con Facebook Connect</span><br />
  <span>semplicemente inserendo la password:</span>
</div>
<div style="margin:15px;padding:10px;border:ridge 2px LightGray;">
  <form id="existandsameusername" name="existandsameusername" action="index.php?spec=existandsameusername" method="post">
  <div id="msg" style="text-align:center;color:#FF0000;"></div>
    <span>Devi immettere la password del tuo account esistente:</span><br /><br />
    <table>
      <tr><td colspan=2><input type="hidden" id="username" name="username" value="<?php echo $_GET['username']; ?>" /></td></tr>
      <tr>
        <td><label for="password">Password: </label></td>
        <td><input type="password" name="password" id="password" /></td>
      </tr>
      <tr>
        <td><label for="password2">Verifica password: </label></td>
        <td><input type="password" name="password2" id="password2" /></td>
      </tr>
    </table>
    <div style="text-align:center;"><button>COLLEGA ACCOUNT</button></div>
  </form>	
</div>
<div style="text-align:center;">
  <span>Se invece l&apos;account non è tuo, ma sei già registrato sul sito,</span><br />
  <span>puoi inserire qui le tue credenziali per collegare l&apos;account di Facebook Connect con il vecchio account.</span><br />
  <span>Se invece non hai ancora un account sul sito, dovrai scegliere un altro nome utente</span><br />
  <span>per completare la registrazione, perché il tuo nome utente di Facebook è già preso da un altro.</span><br />
  <span>Si prega in tal caso di indicare un nome utente alternativo (non c&apos;è bisogno di una password):</span>
</div>
<div style="margin:15px;padding:10px;border:ridge 2px LightGray;">
  <form name="usernamealreadyexists" id="usernamealreadyexists" action="index.php?spec=usernamealreadyexists" method="post">
  <div id="msg" style="text-align:center;color:#FF0000;"></div>
    <input type="radio" name="alreadyusername" id="associatewithold" value="associatewithold" />
    <input type="radio" name="alreadyusername" id="alternativeusername" value="alternativeusername" />
      <tr>
        <td><label for="username">Nome utente: </label></td>
        <td><input type="text" name="username" id="username" /></td>
      </tr>
      <!-- case associate with old -->
      <tr class="associatewithold" style="display:none;">
        <td><label for="password">Password: </label></td>
        <td><input type="password" name="password" id="password" /></td>
      </tr>
      <tr class="associatewithold" style="display:none;">
        <td><label for="password2">Verifica password: </label></td>
        <td><input type="password" name="password2" id="password2" /></td>
      </tr>
    <!-- end case associate with old -->
    </table>
    <div style="text-align:center;display:none;"><button type="submit"></button></div>
  </form>
</div>
<?php
  }
  elseif(isset($_GET['stato']) && $_GET['stato'] == 'collegato' ){
    echo "<div style='text-align:center;'>";
    echo "<span>Congratulazioni! Hai collegato con successo il tuo account di Facebook Connect con il tuo account sul sito.</span>";
    echo "</div>";
  }
  elseif(isset($_GET['stato']) && $_GET['stato'] == 'altuser' ){
    echo "<div style='text-align:center;'>";
    echo "<span>Congratulazioni, ti sei registrato con successo attraverso Facebook Connect e indicando un username alternativo!</span>";
    echo "</div>";
  }
  elseif(isset($_GET['stato']) && $_GET['stato'] == 'linkedtoold' ){
    echo "<div style='text-align:center;'>";
    echo "<span>Congratulazioni, hai collegato con successo il nuovo account Facebook Connect con il tuo account precedente.</span>";
    echo "</div>";
  }
  elseif(isset($_GET['stato']) && $_GET['stato'] == 'revoke' ){
    echo "<div style='text-align:center;'>";
    echo "<div id=\"msg\" style=\"text-align:center;color:#FF0000;\"></div>";
    echo "<span>Hai chiesto di revocare le autorizzazioni di questa applicazione su facebook. Vuoi anche cancellare il tuo account su questo sito?</span>";
    echo "<form id=\"revoke\" name=\"revoke\" method='POST' action=\"index.php?spec=deleteaccount\">";
    echo "<label>USERNAME: <input type='text' name='username' /></label><br />";
    echo "<label>PASSWORD: <input type='password' name='password' /></label><br />";
    echo "<label>Verifica password: <input type='password' name='password2' /></label>";
    echo "<div style=\"text-align:center;\"><button type=\"submit\">CANCELLA ACCOUNT</button></div>";
    echo "</form>";
    echo "</div>";
  }
  elseif(isset($_GET['stato']) && $_GET['stato'] == 'deleted' ){
    echo "<div style='text-align:center;'>";
    echo "<span>Oltre a revocare le autorizzazioni di questa applicazione su facebook hai anche cancellato il tuo account utente. Non puoi più effettuare il login su questo sito.</span>";
    echo "<span>Ti è stato inviato un email di conferma di questa azione. Chiediamo scusa se c'è stato qualche disservizio o inconveniente, anzi preghiamo di comunicarci i modi in cui possiamo migliorare il nostro servizio.</span>";
    echo "</div>";
  }
?>