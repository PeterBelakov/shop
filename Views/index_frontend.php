<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table>
        <tr>
            <td>Name</td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td><input type="text" name="quantity"></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type="text" name="price"></td>
        </tr>
        <tr>
            <td>Size</td>
            <td>
                <select name="size">
                    <option value="">Choose size...</option>
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Color</td>
            <td>
                <select name="color">
                    <option value="">Choose color...</option>
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Action</td>
            <td>
                <input type="hidden" name="action" value="add_product">
                <input type="submit" name="submit" value="Add Product">
            </td>
        </tr>
    </table>
</form>
<table border="1">
    <tr style="font-weight: bold;">
        <td>Id</td>
        <td>Name</td>
        <td>Quantity</td>
        <td>Price</td>
        <td>Size</td>
        <td>Color</td>
        <td>Options</td>
    </tr>

    <?php

    foreach ($products as $product) {

        if (isset($_GET['action']) && $product['id'] == $_GET['id'] && $_GET['action'] == 'edit_product') {
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><input type="text" name="name" value="<?php echo $product['name']; ?>"></td>
                    <td><input type="text" name="quantity" value="<?php echo $product['quantity']; ?>"></td>
                    <td><input type="text" name="price" value="<?php echo $product['price']; ?>"></td>
                    <td>
                        <select name="size">
                            <option value="small" <?php if ($product['size'] == 'small') echo 'selected'; ?>>Small
                            </option>
                            <option value="medium" <?php if ($product['size'] == 'medium') echo 'selected'; ?>>Medium
                            </option>
                            <option value="large" <?php if ($product['size'] == 'large') echo 'selected'; ?>>Large
                            </option>
                        </select>
                    </td>
                    <td>
                        <select name="color">
                            <option value="red" <?php if ($product['color'] == 'red') echo 'selected'; ?>>Red</option>
                            <option value="blue" <?php if ($product['color'] == 'blue') echo 'selected'; ?>>Blue
                            </option>
                            <option value="green" <?php if ($product['color'] == 'green') echo 'selected'; ?>>Green
                            </option>
                        </select>
                    </td>
                    <td>
                        <input type="hidden" name="action" value="update_product">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <input type="submit" name="submit" value="Update Product">
                    </td>
                </tr>
            </form>

            <?php
            continue;
        }

        ?>
        <tr>
            <td><?php echo $product['id']; ?></td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['quantity']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <td><?php echo $product['size']; ?></td>
            <td><?php echo $product['color']; ?></td>
            <td>
                <a href="?id=<?php echo $product['id']; ?>&action=edit_product">Edit</a>
                <a href="?id=<?php echo $product['id']; ?>&action=delete_product">Delete</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<form action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>File 1</td>
            <td><input type="file" name="pictures[]"></td>
        </tr>
        <tr>
            <td>File 2</td>
            <td><input type="file" name="pictures[]"></td>
        </tr>
        <tr>
            <td>Action</td>
            <td>
                <input type="hidden" name="action" value="upload_files">
                <input type="submit" name="submit" value="Upload Files">
            </td>
        </tr>
    </table>
</form>
<?php
    $dirname = "./data/";
    $images = scandir($dirname);
    $ignore = Array(".", "..");
    foreach ($images as $curimg) {
        if (!in_array($curimg, $ignore)) {
        echo "<img src='./data/$curimg' /><br>\n";
        }
    }


