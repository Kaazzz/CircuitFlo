<nav class="nav bd-grid">
    <a href="#" class="nav__logo">CircuitFlo</a>

    <div class="nav__toggle" id="nav-toggle">
        <i class='bx bx-menu-alt-right'></i>
    </div>

    <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
            <li class="nav__item"><a href="login.php" class="nav__link">Login</a></li>
            <li class="nav__item"><a href="register.php" class="nav__link">Register</a></li>
            <li class="nav__item"><a href="#" class="nav__link">About Us</a></li>
            <li class="nav__item"><a href="#" class="nav__link">Contact Us</a></li>
        </ul>
    </div>
</nav>

<style>
body {
    font-family: 'Poppins', sans-serif;
    color: black;
    margin: 0;
    padding-top: 60px; /* Ensure space for fixed navbar */
}

.l-header {
    background-color: #f8f9fa;
    padding: 10px 20px;
    position: fixed; /* Fixed position to always stay on top */
    top: 0;
    width: 100%;
    z-index: 1000;
}

.nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-left: 20px;
    padding-right: 20px;
}

.nav__logo {
    font-size: 1.5rem;
    font-weight: bold;
    text-decoration: none;
    color: black;
    
}

.nav__menu {
    display: flex;
    gap: 20px;
}

.nav__list {
    display: flex;
    list-style-type: none;
    margin: 0;
    padding: 0;
}

.nav__item {
    margin-right: 20px;
}

.nav__link {
    text-decoration: none;
    color: black;
    transition: color 0.3s;
}

.nav__link:hover {
    color: #007bff;
}

.nav__toggle {
    display: none;
}

/* Responsive design for smaller screens */
@media (max-width: 768px) {
    .nav__menu {
        display: none;
        flex-direction: column;
        width: 100%;
        position: absolute;
        top: 60px;
        left: 0;
        background-color: #f8f9fa;
    }

    .nav__menu.show {
        display: flex;
    }

    .nav__toggle {
        display: block;
        cursor: pointer;
    }

    .nav__list {
        flex-direction: column;
    }

    .nav__item {
        margin-right: 0;
    }

    .nav__link {
        padding: 10px 20px;
    }
}
</style>

<script>
document.getElementById('nav-toggle').addEventListener('click', function() {
    document.getElementById('nav-menu').classList.toggle('show');
});
</script>
