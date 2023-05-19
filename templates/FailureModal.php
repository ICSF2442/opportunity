<script>
    function throwError(Error){
        if(Error != null) {
            document.getElementById("text-modal-error-1").innerHTML = Error;
            let html = document.getElementById("throw-error-modal-1").innerHTML;
            return html;
        }
    }

</script>

<!-- Login Failure Modal -->
<div class="modal fade" id="throw-error-modal-1" tabindex="-1" role="dialog" aria-labelledby="loginFailureModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginFailureModalLabel">Login Failure</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="text-modal-error-1">
                <p>Invalid username or password. Please try again.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
