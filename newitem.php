<?php
    require 'header.php';
?>

<section class="main-container">
        <div class="main-wrapper">
            <h2>Add Item</h2>

            <form action="includes/newitem.inc.php" method="POST" class="form">
                <input type="text" name="item" placeholder="Item" autocomplete="off">
                <input type="number" name="calories" placeholder="Calories" autocomplete="off">
                <label class= "favorite" for="favorite">Add to Favorites? 
                <input class="favorite-box" type="checkbox" id="favorite" value="1" name="favorite">
                <span class="checkmark"></span> 
                </label>
                <button type="submit" name="item-submit">Add</button>
            </form>
        </div>
    </section>

<?php
    require 'footer.php';
?>