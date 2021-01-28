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