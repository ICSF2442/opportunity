$(document).ready(function(){
sendRequest("/users/getInfoUser.php",{}).then((res)=>{
    let defaultObj = {
        "role": "Role não escolhida"
    };
    $("[data-autofill]").each(function() {
        let value = res[$(this).data("autofill")] === undefined || res[$(this).data("autofill")] == null ? defaultObj.role : res[$(this).data("autofill")];
        $(this).html(value);
    });



/*$("#nome-jogador-text").html(res.username);
$("#birthday-jogador-text").html(res.birthday);
$("#status-jogador-text").html(res.status);
$("#player-text-card-username").html(res.username);*/


})
})

