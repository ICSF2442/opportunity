let datatable = null;

$(document).ready(function(){

    datatable = $('#DataTable').DataTable( {
        responsive: true,
        select: true
    } );

    updateUserInfo();

    updateTable();

    document.getElementById("confirmar-modal-edit-dev").onclick = function () {

        let username = document.getElementById("nome-dev-edit").value;
        let password = document.getElementById("password-dev-edit").value;
        let email = document.getElementById("email-dev-edit").value;
        let birthday = document.getElementById("birthday-dev-edit").value;
        let status = document.getElementById("status-dev-edit").value;
        let role = null;
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
            updateTable();
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

                $('#modal-dev-create-user').modal('hide');
                updateTable();
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
        if(res.status == null){
            $("#status-dev-edit").val(null);
        }else{

            $("#status-dev-edit").val(res.statusObj["value"]);
        }
        $("#email-dev-edit").attr("placeholder", res.email);

        $("[data-autofill]").each(function() {
            let value = res[$(this).data("autofill")] === undefined || res[$(this).data("autofill")] == null ? defaultObj.role : res[$(this).data("autofill")];
            $(this).html(value);
        });

    });}

function updateTable(){

    sendRequest("/users/getUsers.php",{}).then((res) =>{
        datatable.clear().draw();
        for(let i = 0; i < res.length; i++){
            const item = res[i];
            console.log( "item :", item);
            let tr = $("<tr>");

            tr.append(
                $("<td>").html(item.id ? item.id : 'Não definido')
            );
            tr.append(
                $("<td>").html(item.username ? item.username : 'Não definido')
            );
            tr.append(
                $("<td>").html(item.birthday ? item.birthday : 'Não definido')
            );
            tr.append(
                $("<td>").html(item.user_number ? item.user_number : 'Não definido')
            );
            tr.append(
                $("<td>").html(item.team ? item.team : 'Não definido')
            );
            tr.append(
                $("<td>").html(item.status ? item.statusObj["name"] : 'Não definido')
            );
            tr.append(
                $("<td>").html(item.role ? item.roleObj["name"] : 'Não definido')
            );
            tr.append(
                $("<td>").html(item.verification ? item.verification : 'Não verificado')
            );
            tr.append(
                $("<td>").html(item.dev ? "Sim" : 'Não')
            );
            $(tr).dblclick(() => {
                openEditUser(item);

            });
            datatable.rows.add(tr);
        }

       datatable.draw();

    });
}

function openEditUser(item){

    sendRequest("/users/getInfoUser.php",{}).then((res) =>{
        if(res.id === item.id){
            $('#modal-edit-dev').modal('show');
        }else{
            $('#modal-edit-user-user-dev').modal('show');
        }
    });

    $("#username-edit-input-user-dev").attr("placeholder", item.username );
    $("#birthday-edit-input-user-dev").attr("placeholder", item.birthday );
    if(item.role == null){
        $("#role-select-id-user-dev").val(null);
    }else{
        $("#role-select-id-user-dev").val(item.roleObj["value"]);
    }
    if(item.dev == null){
        $("#dev-select-id-user-dev").val(null);
    }else{
        $("#dev-select-id-user-dev").val(item.dev);
    }
    if(item.status == null){
        $("#status-select-id-user-dev").val(null);
    }else{
        $("#status-select-id-user-dev").val(item.statusObj["value"]);
    }
    $("#email-edit-input-user-dev").attr("placeholder", item.email);

    document.getElementById("confirmar-modal-edit-user-dev").onclick = function () {
        let id = item.id;
        let username = document.getElementById("username-edit-input-user-dev").value;
        let password = document.getElementById("password-edit-input-user-dev").value;
        let email = document.getElementById("email-edit-input-user-dev").value;
        let birthday = document.getElementById("birthday-edit-input-user-dev").value;
        let status = document.getElementById("status-select-id-user-dev").value;
        let role = document.getElementById("role-select-id-user-dev").value;
        let dev = document.getElementById("dev-select-id-user-dev").value;
        let self = false;

        sendRequest("/users/editInfoUser.php",{
            id:id,
            username:username,
            password:password,
            email:email,
            birthday:birthday,
            status:status,
            role:role,
            dev:dev,
            self:self
        }).then((res)=>{
            console.log("result",res);
            updateUserInfo();
            updateTable();
            $('#modal-edit-user-user-dev').modal('hide');
        });
    };
    document.getElementById("dev-remove-user").onclick= function (){
        let id = item.id;
        console.log("teste, entrei")
        sendRequest("/users/removeUser.php",{
            id:id
        }).then((res) =>{
            console.log("result",res);
            $('#modal-edit-user-user-dev').modal('hide');
            updateTable();
        })
    }
}

function logout(){
    sendRequest("/users/logoutUser.php",{}).then((res) =>{});
}
