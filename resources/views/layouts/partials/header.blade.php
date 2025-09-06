<!-- Header -->
<header class="header">
    <div class="container">
        <nav class="nav">
            <a href="/" class="logo">
                <i class="fas fa-shield-alt"></i>
                <span>Letselschade-Hotline</span>
            </a>
            <ul class="nav-links">
                <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="/diensten" class="{{ request()->is('diensten') ? 'active' : '' }}">Diensten</a></li>
                <li><a href="/letselschadetest" class="{{ request()->is('letselschadetest') ? 'active' : '' }}">Letselschadetest</a></li>
                <li><a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
                <li><a href="tel:0880767676" class="nav-phone">
                    <i class="fas fa-phone"></i> 088 076 76 76
                </a></li>
            </ul>
        </nav>
    </div>
</header> 