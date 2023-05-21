$(document).ready(function(){
sendRequest("/users/getInfoUser.php",{}).then((res)=>{
    let defaultObj = {
        "role": "Role não escolhida"
    };
    $("[data-autofill]").each(function() {
        let value = res[$(this).data("autofill")] === undefined || res[$(this).data("autofill")] == null ? defaultObj.role : res[$(this).data("autofill")];
        $(this).html(value);
    });



    document.getElementById("confirmar-modal-edit").onclick = function () {
        console.log("sucesso");
        let username = document.getElementById("username-edit-input").value;
        let password = document.getElementById("password-edit-input").value;
        let email = document.getElementById("email-edit-input").value;
        let birthday = document.getElementById("birthday-edit-input").value;
        let status = document.getElementById("status-select-id").value;
        let role = document.getElementById("role-select-id").value;
        console.log("teste");
        console.log(username);

        sendRequest("/users/editInfoUser.php",{username:username,password:password,email:email,birthday:birthday,status:status,role:role}).then((res)=>{
            console.log("result",res);
        });

    };



/*$("#nome-jogador-text").html(res.username);
$("#birthday-jogador-text").html(res.birthday);
$("#status-jogador-text").html(res.status);
$("#player-text-card-username").html(res.username);*/


})
})

