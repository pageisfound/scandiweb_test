<?php

$product  = new ProductRepository();
$products = $product->readAll();

if ($_POST && !empty($_POST['mass-delete'])) {
    $productsToDelete = [];
    if (!empty($_POST['delete-check'] ?? [])) {
        foreach ($_POST['delete-check'] as $check) {
            $productsToDelete[] = (int)$check;
        }
    }

    if (empty($productsToDelete)) {
        echo '<div class="alert alert-danger">No products selected!</div>';
    } elseif ($product->deleteSelected($productsToDelete)) {
        echo '<div class="alert alert-success">Mass product delete executed successfully!</div>';
        // get updated product list
        $products = $product->readAll();
    } else {
        echo '<div class="alert alert-danger">Mass product delete failed!</div>';
    }
}

?>
<h1 class="my-3">Product List</h1>
<hr />

<form action="../../index.php" method="POST">
    <div class="row">
        <div class="col-8">
            <a href="../../add.php" class="btn btn-primary">Add New Product</a>
        </div>
        <div class="col-4 d-flex">
            <label for="mass-delete"></label>
            <select class="custom-select mr-1" id="mass-delete" name="mass-delete">
                <option>Mass Delete Action</option>
            </select>
            <button type="submit" class="btn btn-danger">Apply</button>
        </div>
    </div>
    <div class="row">
        <?php foreach ($products as $product) { ?>
            <div class="col border border-info rounded m-3 p-3 justify-content-center d-flex">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox"
                           class="custom-control-input"
                           id="delete-check<?= $product['id'] ?>"
                           name="delete-check[]"
                           value="<?= $product['id'] ?>">
                    <label class="custom-control-label" for="delete-check<?= $product['id'] ?>"></label>
                </div>
                <div class="ml-1">
                    <?= $product['sku'] ?><br />
                    <?= $product['name'] ?><br />
                    <?= $product['price'] ?> $<br />
                    <?= (new ProductFactory())->build($product)->getAttributeName()?>: <?= $product['attribute'] ?>
                </div>
            </div>
        <?php } ?>
    </div>
</form>
