var user = document.getElementById("delete-user");
user.addEventListener('click', (e) => {
    var id = e.target.getAttribute('data-id');

    fetch(`/user/delete/${id}`, {
        method: 'DELETE'
    }).then(res => window.location.href = "/all");

    const user = document.getElementById('delete-user');

    if (user) {
        user.addEventListener('click', e => {
            const id = e.target.getAttribute('data-id');

            fetch(`/user/delete/${id}`, {
                method: 'DELETE'
            }).then(res => window.location.href = "/all");
        });
    }
});