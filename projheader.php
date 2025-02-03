<header>  <!-- Max width 800px -->
    <div id="logo">Save The Dayte</div>  <!-- Logo till vänster, nav till höger-->
        <nav>
            <ul>
                <li>Ads</li>
                <li>About</li>
                <li><a href ='projregister.php'>Register</a></li">
                <?php
                if(isset($_SESSION['username']))
                {
                    print("<li><a href='projprofile.php'>Profile</a></li>");
                }
                else
                {
                    print("<li><a href='projlogin.php'>Login</a></li>");
                }
                ?>
            </ul>
        </nav>
</header>