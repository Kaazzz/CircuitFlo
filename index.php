<?php
    include 'connect.php';
?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Floreta - Dayagro</title>

        <link rel="stylesheet" href="css/styles.css">

       
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        
        <header class="l-header">
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
        </header>

        <main>
            <!-- ===== HOME =====-->
            <div class="home">
                <div class="parallax home__parallax home__parallax-img1" data-rellax-speed="-9"></div>
                <div class="parallax home__parallax home__parallax-img2" data-rellax-speed="-7"></div>
                <div class="parallax home__parallax home__parallax-img3" data-rellax-speed="-6"></div>
                <div class="parallax home__parallax home__parallax-img4" data-rellax-speed="-3"></div>

                <h1 class="parallax home__title" data-rellax-speed="-6">CircuitFlo </h1>
                <span class="parallax home__subtitle" data-rellax-speed="-5">Bringing tech closer, Guiding you further</span> 

                <div class="home__scroll">
                   <a href="#section"><i class='bx bx-mouse'></i></a>
                </div>
            </div>

            <!-- ===== SECTION =====-->
            <section class="l-section" id="section">
                <div class="section">
                    <div class="section__data">
                        <h2 class="section__title">About Us</h2>
                        <p class="section__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, laboriosam. Esse ipsum culpa laboriosam, totam hic quidem recusandae eos, numquam iusto aliquid expedita est sapiente quaerat inventore voluptatem corporis aliquam.</p>
                    </div>
        
                    
                </div>
            </section>

            <section class="l-section" id="section">
                <div class="section">
                    <div class="section__data">
                        <h2 class="section__title">Contact Us</h2>
                        <p class="section__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, laboriosam. Esse ipsum culpa laboriosam, totam hic quidem recusandae eos, numquam iusto aliquid expedita est sapiente quaerat inventore voluptatem corporis aliquam.</p>
                    </div>
        
                    
                </div>
            </section>

            
        </main>

        <!-- RELLAX JS -->
        <script src="assets/js/rellax.min.js"></script>

        <!-- GSAP -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js"></script>

        <!-- SCROLL REVEAL -->
        <script src="https://unpkg.com/scrollreveal"></script>

        <!-- MAIN JS -->
        <script src="assets/js/main.js"></script>

        <footer>Zak Floreta and Francis Wedemeyer Dayagro - BSCS 2</footer>
    </body>