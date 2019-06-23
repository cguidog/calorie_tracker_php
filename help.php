<?php
    require 'header.php';
    require 'includes/dbh.inc.php';
?>

<section class="main-container">
        <div class="main-wrapper">
        <?php
        
            if (isset($_SESSION['userId'])) {

                    echo '
                    <h2>Help</h2>
                    <div class="help-container">
                        <div class="help">
                            <div><i class="fas fa-home"></i></div>
                            <div>Home</div>
                        </div>
                        <div class="help">
                            <div><i class="fas fa-history"></i></div>
                            <div>History</div>
                        </div>
                        <div class="help">
                            <div><i class="fas fa-cogs"></i></div>
                            <div>Settings</div>
                        </div>
                        <div class="help">
                            <div><i class="fas fa-sign-out-alt"></i></div>
                            <div>Log Out</div>
                        </div>
                        <div class="help">
                            <div><i class="fas fa-plus"></i></div>
                            <div>Add item</div>
                        </div>
                        <div class="help">
                            <div><i class="fas fa-pen"></i></div>
                            <div>Edit item</div>
                        </div>
                        <div class="help">
                            <div><i class="fas fa-trash-alt"></i></div>
                            <div>Delete item</div>
                        </div>
                        <div class="help">
                            <div><i class="fas fa-heart"></i></div>
                            <div>Favorites</div>
                        </div>
                        <div class="help">
                            <div><i class="fas fa-heart-broken"></i></div>
                            <div>Remove from favorites</div>
                        </div>
                    </div>';
                } else {
                header("Location: http://localhost/phplessons/index.php");
            }


        ?>
        </div>
    </section>

<?php
    require 'footer.php';
?>
