<?php

    function render_alert_success($message_parameter) {
        $message = $message_parameter;
?>
        <div class='panel panel-success'>
            <div class='panel-heading'>
                <h3 class='panel-title'>
                    <?php echo $message; ?>
                </h3>
            </div>
        </div>
<?php
    }
?>