$(document).ready(function(){
sendRequest("/users/getInfoUser.php",{}).then((res)=>{

    $("#nome-jogador-text").innerHTML = res.username;
    $("#birthday-jogador-text").innerHTML = res.birthday;
    $("#status-jogador-text").innerHTML = res.status;


})
})

