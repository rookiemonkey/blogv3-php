<?php

function renderalert_success_SUB($message)
{
?>
    <div class='alert alert-success'>
        <div class='panel-heading'>
            <h3 class='panel-title'>
                <?php echo Utility::sanitize($message); ?>
            </h3>
        </div>
    </div>
<?php
}
?>