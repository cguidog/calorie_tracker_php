<?php
    require 'header.php';
?>

<section class="main-container">
        <div class="main-wrapper">
            <h2>Sign Up</h2>
            <?php
            if (isset($_GET['error'])) {

                if ($_GET['error'] == 'emptyfields') {

                    echo "<p>Fill in all fields.</p>";

                } else if ($_GET['error'] == 'invalidmailuid') {

                        echo "<p>Invalid username and e-mail.</p>";

                } else if ($_GET['error'] == 'invalidmail') {
    
                        echo "<p>Invalid e-mail.</p>";

                } else if ($_GET['error'] == 'invalidmail') {
        
                        echo "<p>Invalid e-mail.</p>";
    
                } else if ($_GET['error'] == 'passwordcheck') {
            
                        echo "<p>Password doesn't match.</p>";
        
                } else if ($_GET['error'] == 'usertaken') {
                
                        echo "<p>Username already exist.</p>";
            
                }
            } else if (isset($_GET['signup']) == 'success') {
                        echo "<p>Successful sign Up!</p>";
            }
            ?>

            <form action="includes/signup.inc.php" method="POST" class="form">
                <input type="text" name="uid" placeholder="User Name">
                <input type="text" name="mail" placeholder="E-mail">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwd-repeat" placeholder="Re-enter Password">
                <button type="submit" name="signup-submit">Sign Up</button>
            </form>
        </div>
    </section>

<?php
    require 'footer.php';
?>