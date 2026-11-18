document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.add-to-cart-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var form = this.closest('.add-to-cart-form');
            var formData = new FormData(form);

            fetch('add_to_cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // You can update the cart icon, show a success message, etc.
                    alert(data.message);
                    // Optionally, update the cart counter or other UI elements here
                } else {
                    alert('Failed to add product to cart');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
