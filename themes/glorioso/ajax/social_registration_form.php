<script type="text/javascript">

$(document).ready(function(){
  $("form").submit(function(){
      $(".formcheck-icon").removeClass("ui-icon ui-icon-check ui-icon-alert");
      $(".ui-state-error",$(this)).removeClass("ui-state-error");
      $("#msg",$(this)).html("");
      if ( $(this).attr("id")=="linkoldaccount"){
        if($("#choice1").is(':checked')===false&&$("#choice2").is(':checked')===false ){
          $("#choice1,#choice2").addClass("ui-state-error");
          $("[for^='choice']").each(function(){
            $(this).parent().next().children(".formcheck-icon").addClass("ui-icon ui-icon-alert");
          }); 
          $("#msg",$(this)).html("Devi scegliere quale username preferisci utilizzare.");
          return false;
        }
      }
      if ( $("#password",$(this)).val() == "" ){
        $("#password",$(this)).addClass("ui-state-error").parent().next().children(".formcheck-icon").addClass("ui-icon ui-icon-alert");
        $("#msg",$(this)).html("Password non può essere vuoto!");
        return false;
      }
      if ( $("#username",$(this)).val() == "" ){
        $("#username",$(this)).addClass("ui-state-error").parent().next().children(".formcheck-icon").addClass("ui-icon ui-icon-alert");
        $("#msg",$(this)).html("Username non può essere vuoto!");
        return false;
      }
      if ( $("#password",$(this)).val() != $("#password2",$(this)).val() ){
        $("[type='password']").each(function(){
          $(this).addClass("ui-state-error").parent().next().children(".formcheck-icon").addClass("ui-icon ui-icon-alert");
        }); 
        $("#msg",$(this)).html("Le password non coincidono! Riprova a digitare le password.");
        return false;
      }
      else{
        $("[type='password']").each(function(){
          $(this).parent().next().children(".formcheck-icon").addClass("ui-icon ui-icon-check");
        }); 
        var username = $("#username",$(this)).val(),
            password = $("#password",$(this)).val(),
            cont = false;
        $.ajax({
          url: "themes/glorioso/ajax/userpasscheck.php",
          data: {"username":username,"password":password},
          success: function(data){
            if ( data=="not a user" ){
              $("#username").addClass("ui-state-error").parent().next().children(".formcheck-icon").addClass("ui-icon ui-icon-alert");
              $("#msg").html("Questo username non esiste! Si prega indicare uno username valido.");
            }
            else if ( data=="incorrect password" ) {
              $("[type='password']:first").addClass("ui-state-error").parent().next().children(".formcheck-icon").removeClass("ui-icon-check").addClass("ui-icon-alert");
              $("#msg").html("La password non è corretta per lo username indicato. Riprova a digitare la password.");
            }
            else if ( data=="password correct" ) {
              //$("div#socialregistration").dialog("close");
              cont = true;          
            }
          },
          async: false
        });
        return cont;
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
  <span>Ti sei iscritto con successo a <?php echo $_FN["sitename"] ?> utilizzando <?php echo $_GET["container"] ?>!</span><br />
  <span>Se avevi già un account su questo sito, puoi anche collegarlo con il nuovo account che è stato creato utilizzando <?php echo $_GET["container"] ?>.</span><br />
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
        <td><label for="choice1"> Preferisci username <?php echo $_GET["container"] ?>, sovrascrivendo username di <?php echo $_FN["sitename"] ?></label></td>
        <td><span class="formcheck-icon"></span></td>
      </tr>
      <tr>
        <td><input name="choiceusername" id="choice2" type="radio" value="preferold" /></td>
        <td><label for="choice2"> Preferisci username <?php echo $_FN["sitename"] ?>, sovrascrivendo username di <?php echo $_GET["container"] ?></label></td>
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
<div style="text-align:center;">
  <span>Ti stai registrando a <?php echo $_FN["sitename"] ?> attraverso <?php echo $_GET["container"] ?>.
  C&apos;è già un account sul sito con lo stesso tuo username &apos;<?php echo $_GET['username']; ?>&apos;.
  Se l&apos;account utente sul sito è tuo, puoi collegarlo con l&apos;account appena creato attraverso <?php echo $_GET["container"] ?>
  semplicemente inserendo la password:</span>
</div>
<div style="margin:15px;padding:10px;border:ridge 2px LightGray;">
  <form id="existandsameusername" name="existandsameusername" action="index.php?spec=existandsameusername" method="post">
  <div id="msg" style="text-align:center;color:#FF0000;"></div>
    <table>
      <tr>
        <td><label for="associatewithsame">L'account è mio, devo solo inserire la password</label></td>
        <td><input type="radio" name="alreadyusername" id="associatewithsame" value="associatewithsame" CHECKED onclick="$('.password').show();$('input#username').attr('DISABLED',true).val('<?php echo $_GET['username']; ?>');" /></td>
      </tr>
      <tr>
        <td><label for="alternativeusername">Non ho ancora un account, sceglierò un altro username</label></td>
        <td><input type="radio" name="alreadyusername" id="alternativeusername" value="alternativeusername" onclick="$('.password').hide();$('input#username').attr('DISABLED',false).val('');" /></td>
      </tr>
      <tr>
        <td style="border-bottom:2px groove #FFFFFF;"><label for="associatewithold">Sono già registrato con un altro account, inserirò le credenziali</label></td>
        <td style="border-bottom:2px groove #FFFFFF;"><input type="radio" name="alreadyusername" id="associatewithold" value="associatewithold" onclick="$('.password').show();$('input#username').attr('DISABLED',false).val('');" /></td>
      </tr>
      <tr>
        <td><label for="username">Username: </label></td>
        <td><input type="text" name="username" id="username" value="<?php echo $_GET['username']; ?>" DISABLED size=15 /></td>
      </tr>
      <tr class="password">
        <td><label for="password">Password: </label></td>
        <td><input type="password" name="password" id="password" size=15 /></td>
      </tr>
      <tr class="password">
        <td><label for="password2">Verifica password: </label></td>
        <td><input type="password" name="password2" id="password2" size=15 /></td>
      </tr>
    </table>
    <div style="text-align:center;"><button>COLLEGA ACCOUNT</button></div>
  </form>	
</div>
<?php
  }
  elseif(isset($_GET['stato']) && $_GET['stato'] == 'collegato' ){
    echo "<div style='text-align:center;'>";
    echo "<span>Congratulazioni! Hai collegato con successo il tuo account di {$_GET["container"]} con il tuo account esistente.</span>";
    echo "</div>";
  }
  elseif(isset($_GET['stato']) && $_GET['stato'] == 'altuser' ){
    echo "<div style='text-align:center;'>";
    echo "<span>Congratulazioni, ti sei registrato con successo attraverso {$_GET["container"]} utilizzando un nome utente alternativo.</span>";
    echo "</div>";
  }
  elseif(isset($_GET['stato']) && $_GET['stato'] == 'linkedtoold' ){
    echo "<div style='text-align:center;'>";
    echo "<span>Congratulazioni, hai collegato con successo il nuovo account creato con {$_GET["container"]} con il tuo account esistente.</span>";
    echo "</div>";
  }
  elseif(isset($_GET['stato']) && $_GET['stato'] == 'revoke' ){
    echo "<div style='text-align:center;'>";
    echo "<div id=\"msg\" style=\"text-align:center;color:#FF0000;\"></div>";
    echo "<span>Hai chiesto di revocare le autorizzazioni di questa applicazione su {$_GET["container"]}. Vuoi anche cancellare il tuo account su {$_FN["sitename"]}?</span>";
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
    echo "<span>Oltre a revocare le autorizzazioni di questa applicazione su {$_GET["container"]} hai anche cancellato il tuo account utente su {$_FN["sitename"]}. Non puoi più effettuare il login su questo sito.</span>";
    echo "<span>Ti è stato inviato un email di conferma di questa azione. Chiediamo scusa se c'è stato qualche disservizio o inconveniente, anzi preghiamo di comunicarci i modi in cui possiamo migliorare il nostro servizio.</span>";
    echo "</div>";
  }
?>