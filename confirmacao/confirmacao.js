$(document).ready(function(){
    document.getElementById("submeter-codigo-button").onclick = function () {

        let code = document.getElementById("Confirmation-user-code").value;

        sendRequest("/users/validateUser.php",{code:code}).then((res)=>{
            console.log("result",res);
            location.reload();
        })

    }
});