$(function() {
    let productType = $('#product-type');
    let productAttribute = $('.product-attribute');

    productAttribute.hide();

    productType.change(function() {
        productAttribute.hide();
        if (productType.val() !== 'none') {
            $('#' + productType.val() + '-attribute').show();
        }
    });
});