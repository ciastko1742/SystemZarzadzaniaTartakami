var product = document.getElementById("delete-product");
product.addEventListener('click', (e) => {
    var id = e.target.getAttribute('data-id');

    fetch(`/product/delete/${id}`, {
        method: 'DELETE'
    }).then(res => window.location.href = "/");

    const product = document.getElementById('delete-product');

    if (product) {
        product.addEventListener('click', e => {
            const id = e.target.getAttribute('data-id');

            fetch(`/product/delete/${id}`, {
                method: 'DELETE'
            }).then(res => window.location.href = "/");
        });
    }
});

$(document).ready(function() {
    $('#addToCartModal').on('show.bs.modal', function () {
        console.log('dzaiala')
        let modal_btn = $('*[data-target="#addToCartModal"]')
        let product_id = modal_btn.attr('data-id');
        let product_name = modal_btn.attr('data-product_name');
        let product_type = modal_btn.attr('data-product_type');

        $('#length_input').val(product_id);
        $('#product_name').val(product_name+' - '+product_type);

    })
});