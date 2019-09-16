<?php

if ($_POST) {
    try {
        $product = (new ProductFactory())->build($_POST);
        $product->validate();

        if ((new ProductRepository())->create($product)) {
            echo '<div class="alert alert-success">New product created successfully!</div>';
        } else {
            echo '<div class="alert alert-danger">Creating new product failed!</div>';
        }
    } catch (Throwable $exception) {
        echo '<div class="alert alert-danger">Creating new product failed: ' . $exception->getMessage() . '</div>';
    }
}

?>
<h1 class="my-3">Product Add</h1>
<hr />

<form action="../../add.php" method="POST">
    <div class="form-group">
        <label for="product-sku">SKU</label>
        <input id="product-sku" type="text" name="sku" class="form-control" maxlength="100" />
    </div>
    <div class="form-group">
        <label for="product-name">Name</label>
        <input id="product-name" type="text" name="name" class="form-control" maxlength="100" />
    </div>
    <div class="form-group">
        <label for="product-price">Price</label>
        <input id="product-price" type="text" name="price" class="form-control" maxlength="6" />
    </div>
    <div class="form-group">
        <label for="product-type">Type</label>
        <select class="form-control custom-select" id="product-type" name="type">
            <option value="none">Choose...</option>
            <option value="furniture">Furniture</option>
            <option value="disc">Disc</option>
            <option value="plate">Plate</option>
        </select>
    </div>

    <?php require_once 'type/furniture.php'; ?>
    <?php require_once 'type/disc.php'; ?>
    <?php require_once 'type/plate.php'; ?>

    <div class="mb-5">
        <button type="submit" class="btn btn-success">Save</button>
        <a class="btn btn-secondary" href="/">Back</a>
    </div>
</form>
