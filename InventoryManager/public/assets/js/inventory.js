document.addEventListener('DOMContentLoaded', () => {
    const createForm = document.getElementById('createInventoryForm');
    
    if (createForm) {
        createForm.addEventListener('submit', (e) => {
            const name = document.getElementById('name').value;
            const quantity = parseInt(document.getElementById('quantity').value);
            
            if (!name || isNaN(quantity) || quantity < 1) {
                e.preventDefault();
                alert('Please fill in all required fields correctly');
                return;
            }
        });
    }
    
    // Add event listeners for delete button
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
    if (confirm('Are you sure you want to delete this item?')) {
        fetch(`/inventory/delete/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Find the row by ID
                const row = document.getElementById(`item-${id}`);
                
                // Check if the row exists before trying to remove it
                if (row) {
                    row.remove();
                } else {
                    console.error(`Row with id item-${id} not found.`);
                }
            } else {
                alert('Failed to delete item.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
