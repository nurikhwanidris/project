<body>

    <!--Main Navigation-->
    <header>

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
            <div class="container">

                <!-- Brand -->
                <a class="navbar-brand waves-effect" href="/project/templates/shop/index.php?page=1" target="_blank">
                    <strong class="blue-text">AHL</strong>
                </a>

                <!-- Collapse -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link waves-effect" href="/project/templates/shop/index.php?page=1">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect" href="#" target="_blank">Promotions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect" href="../../templates/main/about.php" target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect" href="#" target="_blank">Contact Us</a>
                        </li>
                    </ul>

                    <!-- Right -->
                    <ul class="navbar-nav nav-flex-icons">
                        <!-- <li class="nav-item">
                            <a href="https://www.facebook.com/arzuhomelvg" class="nav-link waves-effect" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.instagram.com/arzu.homeliving" class="nav-link waves-effect" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="/templates/shop/cart" class="nav-link waves-effect" target="_blank">Cart
                                <i class="fas fa-shopping-cart"></i><span class="badge badge-secondary badge-counter">7</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="/project/user/login" class="nav-link border border-light rounded waves-effect" target="_blank">
                                <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                            </a>
                        </li> -->
                    </ul>

                </div>

            </div>
        </nav>
        <!-- Navbar -->
        <div id="popover_content_wrapper" style="display: none">
            <span id="cart_details"></span>
            <div align="right">
                <a href="#" class="btn btn-primary" id="check_out_cart">
                    <span class="glyphicon glyphicon-shopping-cart"></span> Check out
                </a>
                <a href="#" class="btn btn-default" id="clear_cart">
                    <span class="glyphicon glyphicon-trash"></span> Clear
                </a>
            </div>
        </div>

        <div id="display_item">


        </div>

    </header>
    <!--Main Navigation-->