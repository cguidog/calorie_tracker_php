<?php
    require 'header.php';
    require 'includes/dbh.inc.php';
?>

<section class="main-container">
        <div class="main-wrapper">
        <?php
        
            if (isset($_SESSION['userId'])) {
                $userId = $_SESSION['userId'];
                $sqlLimit = "SELECT * FROM limits WHERE idUser=$userId;";
                $resultsLimits = $conn->query($sqlLimit);
                $dlimit = 0;
                if ($resultsLimits->num_rows > 0) {

                    $rowLimits = $resultsLimits->fetch_assoc();

                    echo '
                    <h2>Your daily limit is</h2>
                    <form action="includes/limit.inc.php" method="POST" class="form">
                    <input id="limit" type="number" value='.$rowLimits['limits'].' name="limit" placeholder="Daily Limit">
                    <p>calories</p>
                    <button type="submit" name="limit-update">Update Limit</button>
                    </form>';
                    $dlimit = $rowLimits['limits'];
                } else {
                    echo '<form action="includes/limit.inc.php" method="POST" class="form">
                    <input type="number" name="limit" placeholder="Daily Limit">
                    <button type="submit" name="limit-submit">Submit</button>
                    </form>';
                }

                date_default_timezone_set('America/New_York');

                $date = date("Y-m-d");
                $date1 = str_replace('-', '/', $date);
                $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
                $dtotal = 0;
                $limitleft = 0;
                $sql = "SELECT * FROM items 
                WHERE date >='$date 00:00:00'
                AND date <'$tomorrow 00:00:00'
                AND IdUser=$userId;";

                $results = $conn->query($sql);

                if ($results->num_rows > 0) {

                    while($row = $results->fetch_assoc()) {
                        $dtotal += $row["calories"];
                        $limitleft = $dlimit - $dtotal;
                    }

                    echo '<div class="details"><p class="summary">Daily total: '.$dtotal.' calories</p>';
                    echo '<p class="summary">Available: ' .$limitleft.' calories</p></div>';
                    echo '<div class="details">
                            <div class="detail-title">
                                <div><h3>Detail</h3></div>
                                <div><span class="menu-list-item"><a href="favorites.php"><i class="fas fa-heart"></i></a></span></div>
                                <div><span class="menu-list-item"><a href="newitem.php"><i class="fas fa-plus"></i></a></span></div>
                            </div>';
                    foreach ($results as $row) {
                        echo '<p>'. $row["item"]. ' - Calories: '. $row["calories"].  '<span><a href="edit.php?id='.$row["itemId"].'&item='.$row["item"].'&calories='.$row["calories"].'"><i class="fas fa-pen"></i></a></span><span><a href="includes/delete.inc.php?id='.$row["itemId"].'"><i class="fas fa-trash-alt"></i></a></span></p>';
                    }
                    echo '</div>';
                } else {
                    echo '<div class="details">
                    <div class="detail-title">
                        <div><h3>There are no items to show, add some!</h3></div>
                        <div><span class="menu-list-item"><a href="newitem.php"><i class="fas fa-plus"></i></a></span></div>
                    </div></div>';
                    
                }

            } else {
                echo '
                <section class="main-container">
                <div class="main-wrapper">
                <form action="includes/login.inc.php" method="POST" class="form">
                <input type="text" name="mailuid" placeholder="Username/e-mail">
                <input type="password" name="pwd" placeholder="Password">
                <button type="submit" name="login-submit">Login</button>
            </form>
    </div>
    <p>First time here? <a href="signup.php">Sign Up!</a></p>';
            }


        ?>
        </div>
    </section>

<?php
    require 'footer.php';
?>
