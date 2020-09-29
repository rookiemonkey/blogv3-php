<?php

function renderalert_failed_SUB($message)
{
?>
    <div class='alert alert-danger'>
        <div class='panel-heading'>
            <h3 class='panel-title'>
                <?php echo $message ?>
            </h3>
        </div>
    </div>
<?php
}
?>