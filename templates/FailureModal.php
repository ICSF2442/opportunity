<script>
    function throwError(Error){
        if(Error != null) {
            console.log(Error);
            document.getElementById("text-modal-error-1").innerHTML = Error;
            $('#throw-error-modal-1').modal('show');

        }
    }


</script>

<!-- Login Failure Modal -->
<div class="modal fade" id="throw-error-modal-1" tabindex="-1" role="dialog" aria-labelledby="loginFailureModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="modal-header-text">
                <h5 class="modal-title" id="loginFailureModalLabel">Ocorreu um erro!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="text-modal-error-1">
                <p id="text-modal-error-p1">Invalid username or password. Please try again.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmation-email-modal" tabindex="-1" role="dialog" aria-labelledby="loginFailureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="modal-header-text">
                <h5 class="modal-title" id="loginFailureModalLabel">Confirmação de conta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-teste">
                <div class="form-group">
                    <label for="Confirmation">Um código foi enviado para o e-mail do registro insira no campo abaixo:</label>
                    <input type="text" class="form-control" id="Confirmation" placeholder="Insira o código" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="toast toast-top-right" id="successToast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="mr-auto">Success</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        Validation successful!
    </div>
</div>

<div class="toast toast-top-right" id="FailToast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="3000">
    <div class="toast-header">
        <strong class="mr-auto">Failed!</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        Validation Failed!
    </div>
</div>


<style>
    .toast-top-right {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10000000;
    }
</style>