$(document).ready(function(){
    $("#form-login").on("submit",function (e){
        e.preventDefault();
        let email = $("#email-input").val();
        let password = $("#password-input").val();
        sendRequest("/users/accessUser.php",{email:email, password:password}).then((res)=>{
            console.log("result",res);
           // window.location.href = "http://localhost/Opportunity/user/";
            window.location.href = "http://localhost/ATW_TP1/user/";

        })
    })

})