<?php
// create selectvals array
$hour = 0;
for($i=0;$i<=47;$i++){
  if($i % 2 == 0){ if($hour<10){$hour = "0".$hour;} $selectvals[] = $hour.":00"; }
  else{ $selectvals[] = $hour.":30"; $hour += 1; } 
}
$slctd = $_POST['selected'];

function fillselectoptions($vals,$min=false,$max=false,$selected=false){
  $str = "";
  $selecval = "";
  if($min){
    while($i=array_shift($vals)){ if($i==$min){ break; } }
    if($min==$selected){ $selecval=" SELECTED"; }
    $str .= "<option".$selecval.">{$min}</option>";
    while($i=array_shift($vals)){     
      if($min==$selected){ $selecval=" SELECTED"; }
      $str.= "<option".$selecval.">{$i}</option>"; 
    }
    return $str;
  }
  if($max){
    while($i=array_shift($vals)){ 
      if($i==$max){ 
        if($max==$selected){ $selecval=" SELECTED"; }
        $str .= "<option".$selecval.">{$i}</option>"; 
        return $str; 
      } 
      if($max==$selected){ $selecval=" SELECTED"; }      
      $str .= "<option".$selecval.">{$i}</option>"; 
    }
    return $str;
  }
  while($i=array_shift($vals)){ 
    if($i==$selected){ $selecval=" SELECTED"; }
    $str .= "<option".$selecval.">{$i}</option>"; 
  }
  return $str;
}

if(isset($_POST['minval'])){
  echo fillselectoptions($selectvals,$_POST['minval'],false,$slctd);
}
elseif(isset($_POST['maxval'])){
  echo fillselectoptions($selectvals,false,$_POST['maxval'],$slctd);
}
else{
  echo fillselectoptions($selectvals,false,false,$slctd);
}
?>