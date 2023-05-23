$(document).ready(function(){


    updateUserInfo();

    document.getElementById("confirmar-modal-edit").onclick = function () {

        let username = document.getElementById("username-edit-input").value;
        let password = document.getElementById("password-edit-input").value;
        let email = document.getElementById("email-edit-input").value;
        let birthday = document.getElementById("birthday-edit-input").value;
        let status = document.getElementById("status-select-id").value;
        let role = document.getElementById("role-select-id").value;
        let self = true;


        sendRequest("/users/editInfoUser.php",{
            username:username,
            password:password,
            email:email,
            birthday:birthday,
            status:status,
            role:role,
            self:self
        }).then((res)=>{
            console.log("result",res);
            updateUserInfo();
            $('#modal-edit-user').modal('hide');
        });

    };



/*$("#nome-jogador-text").html(res.username);
$("#birthday-jogador-text").html(res.birthday);
$("#status-jogador-text").html(res.status);
$("#player-text-card-username").html(res.username);*/


});

function updateUserInfo(){
    sendRequest("/users/getInfoUser.php",{}).then((res)=>{

        console.log(res);
        $("#username-edit-input").attr("placeholder", res.username );
        $("#birthday-edit-input").attr("placeholder", res.birthday );
        if(res.role == null){
            $("#role-select-id").val(null);
        }else{
            $("#role-select-id").val(res.roleObj["value"]);
        }
        if(res.status == null){
            $("#status-select-id").val(null);
        }else{
            $("#status-select-id").val(res.statusObj["value"]);
        }
        $("#email-edit-input").attr("placeholder", res.email);
        let defaultObj = {
            "role": "Role não escolhida"
        };
        $("[data-autofill]").each(function() {
            let value = res[$(this).data("autofill")] === undefined || res[$(this).data("autofill")] == null ? defaultObj.role : res[$(this).data("autofill")];
            $(this).html(value);
        });

});}


