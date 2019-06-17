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
                    <h2>Enter your desired limit</h2>
                    <form action="includes/limit.inc.php" method="POST" class="form">
                    <input id="limit" type="number" value='.$rowLimits['limits'].' name="limit" placeholder="Daily Limit">
                    <button type="submit" name="limit-update">Update Limit</button>
                    </form>';
                    $dlimit = $rowLimits['limits'];
                }



            }


        ?>
        </div>
    </section>

<?php
    require 'footer.php';
?>
