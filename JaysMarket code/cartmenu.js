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
                    alert(data.message);
                    updateCartDisplay();
                } else {
                    alert('Failed to add product to cart');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    function updateCartDisplay() {
        fetch('cartMenu.php')
            .then(response => response.text())
            .then(html => {
                var tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;
                var newCartContent = tempDiv.querySelector('#cart-content').innerHTML;
                var newCartBadge = tempDiv.querySelector('#cart-badge-desktop').textContent;

                document.querySelector('#cart-content').innerHTML = newCartContent;
                document.querySelector('#cart-badge-mobile').textContent = newCartBadge;
                document.querySelector('#cart-badge-desktop').textContent = newCartBadge;

                attachEventListeners();
            })
            .catch(error => console.error('Error:', error));
    }

    function attachEventListeners() {
        document.querySelectorAll('.cart-update').forEach(function(button) {
            button.addEventListener('click', function() {
                var key = this.dataset.key;
                var action = this.dataset.action;

                fetch('update_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        product_key: key,
                        action: action
                    })
                })
                .then(response => response.text())
                .then(data => {
                    updateCartDisplay();
                })
                .catch(error => console.error('Error:', error));
            });
        });

        document.querySelector('#clear-cart').addEventListener('click', function() {
            fetch('clear_cart.php', {
                method: 'POST'
            })
            .then(() => {
                updateCartDisplay();
            })
            .catch(error => console.error('Error:', error));
        });
    }

    attachEventListeners();
});
