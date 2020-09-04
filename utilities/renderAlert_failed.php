<?php

    function render_alert_failed($message) {
?>
        <div class='alert alert-danger'>
            <div class='panel-heading'>
                <h3 class='panel-title'>
                    <h3 class='panel-title'><?php echo $message; ?></h3>
                </h3>
            </div>
        </div>
<?php
    }
?>