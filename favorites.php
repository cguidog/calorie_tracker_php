<?php
    require 'header.php';
    require 'includes/dbh.inc.php';
?>

<section class="main-container">
        <div class="main-wrapper">
        <?php
                $userId = $_SESSION['userId'];
                $sql = "SELECT * FROM items 
                WHERE favorite=1
                AND IdUser=$userId;";

                $results = $conn->query($sql);

                if ($results->num_rows > 0) {

                    echo '<div class="details">
                            <div class="detail-title">
                                <div><h3>Favorites</h3></div>
                                <div></div>
                                <div><span class="menu-list-item"><a href="index.php"><i class="fas fa-home"></i></a></span></div>
                            </div>';
                    foreach ($results as $row) {
                        echo '<p>'. $row["item"]. ' - Calories: '. $row["calories"].  '<span><a href="includes/newitem-favorite.inc.php?item='.$row["item"].'&calories='.$row["calories"].'"><i class="fas fa-plus"></i></a></span><span><a href="includes/remove-favorite.inc.php?id='.$row["itemId"].'"><i class="fas fa-heart-broken"></i></a></span></p>';
                    }
                    echo '</div>';
                } else {
                    echo '<div class="details">
                    <div class="detail-title">
                        <div><h3>There are no items to show, add some!</h3></div>
                        <div><span class="menu-list-item"><a href="newitem.php"><i class="fas fa-plus"></i></a></span></div>
                    </div></div>';
                    
                }


        ?>
        </div>
    </section>

<?php
    require 'footer.php';
?>
