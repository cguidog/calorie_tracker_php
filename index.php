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

                    $dlimit = $rowLimits['limits'];
                } else {
                    echo '
                    <p>Enter your daily calorie limit to start!</p>
                    <form action="includes/limit.inc.php" method="POST" class="form">
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
                    echo '<div class="dashboard">
                            <div>
                                <div class="dashboard-field">Limit</div>
                                <div>'.$dlimit.'</div>
                            </div>
                            <div>
                                <div class="dashboard-field">Consumed</div>
                                <div>'.$dtotal.'</div>
                            </div>
                            <div>
                                <div class="dashboard-field">Left</div>
                                <div>'.$limitleft.'</div>
                            </div>
                        </div>';
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
                    echo '<div class="dashboard">
                            <div>
                                <div class="dashboard-field">Limit</div>
                                <div>'.$dlimit.'</div>
                            </div>
                            <div>
                                <div class="dashboard-field">Consumed</div>
                                <div>'.$dtotal.'</div>
                            </div>
                            <div>
                                <div class="dashboard-field">Left</div>
                                <div>'.$limitleft.'</div>
                            </div>
                        </div>';
                    echo '<div class="details">
                    <div class="detail-title">
                        <div><h3>There are no items to show, add some!</h3></div>
                        <div><span class="menu-list-item"><a href="favorites.php"><i class="fas fa-heart"></i></a></span></div>
                        <div><span class="menu-list-item"><a href="newitem.php"><i class="fas fa-plus"></i></a></span></div>
                    </div></div>';
                    
                }

            } else {
                echo '
                <p>Enter your user information to access your account</p>
                <form action="includes/login.inc.php" method="POST" class="form">
                <input type="text" name="mailuid" placeholder="Username/e-mail">
                <input type="password" name="pwd" placeholder="Password">
                <button type="submit" name="login-submit">Login</button>
            </form>
    </div>
    <p class="signup">First time here? <a href="signup.php">Sign Up!</a></p>';
            }


        ?>
        </div>
    </section>

<?php
    require 'footer.php';
?>
