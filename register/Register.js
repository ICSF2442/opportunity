$(document).ready(function(){
    $("#form-register").on("submit",function (e){
        e.preventDefault();

        let username = $("#username-input").val();
        let email = $("#email-input").val();
        let password = $("#password-input").val();
        let password2 = $("#password-input2").val();
        let birthday = $("#birthday-input").val();

        if(password === password2){
            sendRequest("/users/createUser.php",{username:username, email:email, password:password, birthday:birthday}).then((res)=>{
                console.log("result",res);
            })
        }else{
            $('#ErrorModal').modal('show');
        }

    })

})