document.addEventListener('DOMContentLoaded', () => {
    const createForm = document.getElementById('createUserForm');
    
    if (createForm) {
        createForm.addEventListener('submit', (e) => {
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const role = document.getElementById('role').value;

            if (!username || !email || !role) {
                e.preventDefault();
                alert('Please fill in all required fields correctly');
                return;
            }
        });
    }

    document.querySelectorAll('.btn-danger').forEach(button => {
        button.addEventListener('click', (e) => {
            const id = e.target.getAttribute('data-id');
            if (id) {
                handleDelete(parseInt(id));
            }
        });
    });
});

function handleDelete(id) {
    if (confirm('¿Estás seguro de eliminar este usuario?')) {
        fetch(`/users/delete/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const row = document.getElementById(`user-${id}`);
                if (row) {
                    row.remove();
                }
            } else {
                alert('No se pudo eliminar el usuario.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
