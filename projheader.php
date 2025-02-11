<header>  <!-- Max width 800px -->
    <div id="logo">Save The Dayte</div>  <!-- Logo till vänster, nav till höger -->
    <nav>
        <ul>
            <li>Reklam</li>  <!-- Menyalternativ för reklam -->
            <li>Om</li>  <!-- Menyalternativ för om-sidan -->
            <li><a href='registration.php'>Registrera mig</a></li>  <!-- Länk till registreringssidan -->
            <?php
            // Kontrollera om användaren är inloggad
            if (isset($_SESSION['username']))
            {
                // Om användaren är inloggad, visa profil-, huvudmeny- och utloggningslänkar
                print("<li><a href='projprofile.php'>Profil</a></li>");
                print("<li><a href='projlogin.php'>Huvudmenyn</a></li>");
                print("<li><a href='projlogout.php'>Logga ut</a></li>");
                print("<li><a href='projreport.php'>Rapport</a></li>");
            }
            else
            {
                // Om användaren inte är inloggad, visa inloggningslänken
                print("<li><a href='projlogin.php'>Logga in</a></li>");
                print("<li><a href='projreport.php'>Rapport</a></li>");
            }
            ?>
        </ul>
    </nav>
</header>