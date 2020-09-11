<?php

function render_modal($id, $action, $message, $link)
{
?>
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal_<?php echo Utility::sanitize($id) ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Confirm <?php echo Utility::sanitize($action); ?> </h3>
                </div>
                <div class="modal-body">
                    <h5><?php echo Utility::sanitize($message); ?> </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href='<?php echo $link; ?>'>
                        <button type="button" class="btn btn-primary">Confirm</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>