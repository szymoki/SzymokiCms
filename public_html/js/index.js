function gra_rejestruj(user_id){
    $.getJSON( "/rest.php?action=gra_user_add&id="+user_id, function( data ) {
      console.log("Zarejestrowano nowego użytkownika gry!")
 });
}


function zaladuj(){
  $.getJSON( "/rest.php?action=numerek_get", function( data ) {
   $(".numerek").html( data["numerek"] );
 });


  if(!localStorage.getItem('numerek')){
    $("#twojnumer").val("0");
  }else{
    $("#twojnumer").val(localStorage.getItem('numerek'));
  }

  if(!localStorage.getItem('klasa')){
   $("#twojaklasa").text("?");
 }else{
  $("#twojaklasa").text(localStorage.getItem('klasa'));
}

if(!localStorage.getItem('user_id')){
  $.get( "create_id.php", function( data ) {
    localStorage.setItem('user_id',data);
    $(".user_id").text(localStorage.getItem('user_id'));
    gra_rejestruj(data);

  });

}else{
  $(".user_id").text(localStorage.getItem('user_id'));
}

}


function getArtykul(id){
  artykul="";
  $.getJSON( "/rest.php?action=artykul_get&id="+id, function( data ) {
 //console.log(data["artykul"]["tresc"]);
    artykul=data["artykul"]["tresc"];
  });
  return artykul;
}

 function ladnanazwa(index){
  if(index==0) return "Parter";
  else if(index==1) return "Pierwsze piętro";
  else if(index==2) return "Drugie pietro";
  else if(index==3) return "Hala";
 }


