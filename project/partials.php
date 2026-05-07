<?php
require_once __DIR__ . '/../backend/auth.php';

function e($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function renderShopHeader($active = 'home', $placeholder = 'Search for your next adventure...') {
    $links = [
        'home' => ['Home Page', 'home.php'],
        'products' => ['Products', 'products.php'],
        'customize' => ['Customize', 'customize.php'],
        'activities' => ['Activities', 'activities.php'],
        'contact' => ['Contact Us', 'contact.php'],
        'parents' => ['Parents Portal', 'parents.php'],
    ];
    ?>
    <header class="shop-header">
        <div class="header-left">
            <a class="logo-header" href="home.php">Scout Shop</a>
        </div>

        <div class="header-center">
            <input type="text" class="search-bar" id="productSearch" placeholder="<?php echo e($placeholder); ?>">
        </div>

        <div class="header-right">
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" onclick="openProfile()" aria-label="Profile">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" onclick="openCart()" aria-label="Cart">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <button class="hamburger" id="hamburger" type="button" aria-label="Open menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    <div id="profileModal" class="modal">
        <div class="modal-content profile-modal">
            <div class="modal-header">
                <h3>Profile</h3>
                <span class="close" onclick="closeProfile()">&times;</span>
            </div>
            <?php if (isLoggedIn()): ?>
                <p style="margin-bottom: 16px;">Signed in as <strong><?php echo e($_SESSION['name']); ?></strong></p>
                <button class="modal-btn" onclick="window.location.href='profile.php'">My Profile</button>
                <?php if (isAdmin()): ?>
                    <button class="modal-btn" onclick="window.location.href='../admin/index.php'">Admin Dashboard</button>
                <?php endif; ?>
                <button class="modal-btn" onclick="window.location.href='logout.php'">Log out</button>
            <?php else: ?>
                <button class="modal-btn" onclick="window.location.href='login.php'">Login</button>
                <button class="modal-btn" onclick="window.location.href='register.php'">Register</button>
            <?php endif; ?>
        </div>
    </div>

    <div id="cartModal" class="modal">
        <div class="modal-content cart-modal">
            <div class="modal-header">
                <h3>Your Cart</h3>
                <span class="close" onclick="closeCart()">&times;</span>
            </div>
            <div id="cartItems"></div>
            <div id="cartTotal" style="margin-top: 20px; font-weight: bold;"></div>
            <button class="modal-btn checkout-btn" style="margin-top: 20px;" onclick="checkout()">Checkout</button>
        </div>
    </div>

    <nav class="sub-navigation" id="mobileMenu">
        <?php foreach ($links as $key => $link): ?>
            <a href="<?php echo e($link[1]); ?>" class="nav-link <?php echo $active === $key ? 'active' : ''; ?>"><?php echo e($link[0]); ?></a>
        <?php endforeach; ?>
    </nav>
    <?php
}

function renderShopScripts() {
    ?>
    <script>
        function getCart() {
            return JSON.parse(localStorage.getItem('scoutCart')) || [];
        }

        function saveCart(cart) {
            localStorage.setItem('scoutCart', JSON.stringify(cart));
        }

        function addToCart(id, product, price) {
            const cart = getCart();
            const existingItem = cart.find(item => item.id === id);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ id, product, price, quantity: 1 });
            }

            saveCart(cart);
            alert(product + ' added to cart.');
        }

        function openCart() {
            const cart = getCart();
            const cartItems = document.getElementById('cartItems');
            const cartTotal = document.getElementById('cartTotal');

            if (!cart.length) {
                cartItems.innerHTML = '<p>Your cart is empty</p>';
                cartTotal.innerHTML = '';
            } else {
                let total = 0;
                cartItems.innerHTML = cart.map(item => {
                    const itemTotal = Number(item.price) * Number(item.quantity);
                    total += itemTotal;
                    return `<div style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #ccc;">
                        <strong>${item.product}</strong> - $${Number(item.price).toFixed(2)} x ${item.quantity} = $${itemTotal.toFixed(2)}
                        <button onclick="removeFromCart(${item.id})" style="margin-left: 10px; background: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">Remove</button>
                    </div>`;
                }).join('');
                cartTotal.innerHTML = `<strong>Total: $${total.toFixed(2)}</strong>`;
            }

            document.getElementById('cartModal').style.display = 'block';
        }

        function closeCart() {
            document.getElementById('cartModal').style.display = 'none';
        }

        function removeFromCart(id) {
            saveCart(getCart().filter(item => item.id !== id));
            openCart();
        }

        async function checkout() {
            const cart = getCart();
            if (!cart.length) {
                alert('Your cart is empty.');
                return;
            }

            const response = await fetch('../backend/checkout_handler.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ items: cart })
            });
            const data = await response.json();

            if (!data.success) {
                alert(data.message || 'Checkout failed.');
                if (response.status === 401) {
                    window.location.href = 'login.php';
                }
                return;
            }

            localStorage.removeItem('scoutCart');
            closeCart();
            alert('Order #' + data.order_id + ' created successfully.');
        }

        function openProfile() {
            document.getElementById('profileModal').style.display = 'block';
        }

        function closeProfile() {
            document.getElementById('profileModal').style.display = 'none';
        }

        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');

        if (hamburger && mobileMenu) {
            hamburger.addEventListener('click', () => {
                mobileMenu.classList.toggle('active');
                hamburger.classList.toggle('open');
            });
        }

        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (mobileMenu) {
                    mobileMenu.classList.remove('active');
                }
                if (hamburger) {
                    hamburger.classList.remove('open');
                }
            });
        });

        const productSearch = document.getElementById('productSearch');
        if (productSearch) {
            productSearch.addEventListener('input', () => {
                const term = productSearch.value.toLowerCase();
                document.querySelectorAll('[data-product-card]').forEach(card => {
                    card.style.display = card.textContent.toLowerCase().includes(term) ? '' : 'none';
                });
            });
        }

        window.addEventListener('click', event => {
            const profileModal = document.getElementById('profileModal');
            const cartModal = document.getElementById('cartModal');

            if (event.target === profileModal) {
                closeProfile();
            }
            if (event.target === cartModal) {
                closeCart();
            }
        });
    </script>
    <?php
}
?>
