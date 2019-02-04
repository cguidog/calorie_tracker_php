<?php
    require 'header.php';
    $id = $_GET['id'];
    $item = $_GET['item'];
    $calories = $_GET['calories'];
?>

<section class="main-container">
        <div class="main-wrapper">
            <h2>Edit Item</h2>

            <form action="includes/edit.inc.php" method="POST" class="form">
                <input type="text" name="item" placeholder="Item" value="<?php echo $item ?>">
                <input type="number" name="calories" placeholder="Calories" value="<?php echo $calories ?>">
                <input type="hidden" name="itemId" value="<?php echo $id ?>">
                <button type="submit" name="edit-item-submit">Edit</button>
                <a class="button" href="index.php">Cancel</a>
            </form>
        </div>
    </section>

<?php
    require 'footer.php';
?>