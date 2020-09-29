<?php

function render_alert_tablenoresult_SUB($message)
{
?>
    <div class="jumbotron">
        <h1>We apologize..</h1>
        <p><?php echo Utility::sanitize($message); ?></p>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = document.querySelector('table.table')
            table.style.display = 'none';
        });
    </script>
<?php
}

?>