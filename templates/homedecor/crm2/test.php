<?php

$conn = new mysqli('localhost', 'root', '', 'project')
    or die('Cannot connect to db');

$result = $conn->query("select id, name FROM homedecor_product");

// Build up an array of options to show in our select box.
$productSelectOptions = array();
while ($row = $result->fetch_assoc()) {
    $productSelectOptions[$row['id']] = $row['name'];
}

?>

<h3>EDIT PRODUCT</h3>

<p>
    <strong>SELECT PRODUCT:</strong>
    <select name="ID" id="productSelect">
        <?php foreach ($productSelectOptions as $val => $text) : ?>
            <option value="<?= $val; ?>"><?= $text; ?></option>
        <?php endforeach; ?>
    </select>
</p>

<h3>ID:</h3>

<p>
    <input type="text" name="id_text" id="id" />
    <input type="text" name="id_text" id="name" />
    <input type="text" name="id_text" id="cost" />
</p>

<!-- Include jQuery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script>
    var $productSelect = $('#productSelect');
    var $id = $('#id');
    var $name = $('#name');
    var $cost = $('#cost');

    // This should be the path to a PHP script set up to receive $_POST['product']
    // and return the product info in a JSON encoded array.
    // You should also set the Content-Type of the response to application/json so as our javascript parses it automatically.
    var apiUrl = 'getProductInfo.php';

    function refreshInputsForProduct(product) {
        $.post(apiUrl, {
            product: product
        }, function(r) {
            /**
             * Assuming your PHP API responds with a JSON encoded array, with the ID available.
             */
            $id.val(r.id);
            $name.val(r.name);
            $cost.val(r.cost);
        });
    }

    // Listen for when a new product is selected.
    $productSelect.change(function() {
        var product = $(this).val();
        refreshInputsForProduct(product);
    });
</script>