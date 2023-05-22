$(document).ready(function(){


    updateUserInfo();

    document.getElementById("confirmar-modal-edit-dev").onclick = function () {

        let username = document.getElementById("nome-dev-edit").value;
        let password = document.getElementById("password-dev-edit").value;
        let email = document.getElementById("email-dev-edit").value;
        let birthday = document.getElementById("birthday-dev-edit").value;
        let status = document.getElementById("status-dev-edit").value;
        let role = null;

        sendRequest("/users/editInfoUser.php",{
            username:username,
            password:password,
            email:email,
            birthday:birthday,
            status:status,
            role:role,
        }).then((res)=>{
            console.log("result",res);
            updateUserInfo();
            $('#modal-edit-dev').modal('hide');
        });

    };

    document.getElementById("confirmar-modal-createuser-dev").onclick = function () {
        let username = document.getElementById("dev-create-username").value;
        let email = document.getElementById("dev-create-email").value;
        let password = document.getElementById("dev-create-password").value;
        let password2 = document.getElementById("dev-create-Confirm-password").value;
        let birthday = document.getElementById("dev-create-birthday").value;
        if(password === password2){
            sendRequest("/users/createUser.php",{username:username, email:email, password:password, birthday:birthday}).then((res)=>{
                console.log("result",res);
                $('#modal-edit-dev').modal('hide');
            })
        }else{
            let Error = "A palavra-passe não coincide."
            throwError(Error);
        }
    };
});

function updateUserInfo(){
    sendRequest("/users/getInfoUser.php",{}).then((res)=>{

        $("#nome-dev-edit").attr("placeholder", res.username );
        $("#birthday-dev-edit").attr("placeholder", res.birthday );
        $("#status-dev-edit").val(res.statusObj["value"]);
        $("#email-dev-edit").attr("placeholder", res.email);

        $("[data-autofill]").each(function() {
            let value = res[$(this).data("autofill")] === undefined || res[$(this).data("autofill")] == null ? defaultObj.role : res[$(this).data("autofill")];
            $(this).html(value);
        });

    });}