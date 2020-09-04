<?php  include "includes/database.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>

<section id="login">    
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>

                <?php
                    if(isset($_POST['submit_contact'])) {
                        $to         = "kevinroirigorbasina@gmail.com";
                        $subject    = wordwrap($_POST['subject'], 70);
                        $body       = $_POST['body'];
                        $header     = $_POST['email'];

                    }
                ?>

                    <form role="form" action="contact.php" method="POST" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
                        </div>    
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="subject" name="subject" id="subject" class="form-control" placeholder="Subject" required>
                        </div> 
                        <div class="form-group">
                            <label for="subject" class="sr-only">Message</label>
                            <textarea class="form-control" name="body" placeholder="Message" rows="7"></textarea>
                        </div>              
                        <input type="submit" name="submit_contact" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form> 
                 
                </div>
            </div> 
        </div> 
    </div>
</section>

<hr>

<?php include "includes/footer.php";?>