<?php

    function render_alert($message_parameter) {
        $message = $message_parameter;
?>
            <div class="jumbotron">
                <h1>We apologize..</h1>
                <p><?php echo $message; ?></p>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function(){
                    const table = document.querySelector('table.table')
                    table.style.display = 'none';
                });
            </script>
<?php
    }

?>