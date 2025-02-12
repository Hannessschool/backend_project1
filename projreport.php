<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projektrapport - projekt 1</title>
    <link rel="stylesheet" href="./projstyle.css">
</head>
<body>
    <div id="container">  
        <?php
        include "projheader.php";
        ?>
        <section>
            <article>
            <h1>Projektrapport - projekt 1 - Hannes</h1>
                <p>Vi påbörjade sent samarbete med Katinka. Vid det skedet hade vi redan gjort största delen av delmomenten båda två, 
                men vi kom överens att hon till exempel sköter mer färdigställningen av 2, 4 och 6, och jag gjorde 7 och fortsatte redigera 1, 3, och 5, 
                samt allmänna stilen och strukturen. M.a.o hann vi kanske inte få så mycket fördel av att komplettera varandras arbete, 
                eftersom vi redan gjort största delen själva, men man har åtminstone hunnit fundera på delarna tillsammans, 
                har större chans att få dem rätt, och hinner fokusera på vissa delar till punkt och pricka.</p>

                <p>Projektet var bra, för man lärde sig att använda såväl php, html och css i samspel, att hur lätt det är att integrera php och css i html med rätt tags. 
                Detta lärde man sig också i och med att jag gjorde lite väl mycket jobb med stilen och funktionaliteten av alla delar än vad man ens skulle ha behövt ännu för projekt 1, 
                och kunde ha gjort lite extra research om hur man skulle få t.ex. filuppladdning att funka bättre, med olika mappar, kataloger och filrättigheter.</p>

                <p>Vi kunde kanske ha testat lite mer egen filuppladdning på lektionerna,  eftersom jag trodde att det skulle vara lättare p.g.a koden vi gick igenom på W3Schools. 
                Det visade sig vara lite problematiskt område, och kanske kodmässigt lite mer komplicerat än de andra sakerna vi gått igenom. 
                För ärligt talat känns sådana saker som är beroende av klasser, input, output och loops som mycket mer naturliga ämnen. En ytterst svår sak för mig personligen har varit att
                att hänga med systematiken ibland att vad som integreras från vilken fil till vilken fil, i och med att man gällande php och html kan adoptera kod och sessioner från höger och vänster från andra filer. 
                Det är också en rikedom hur lätt det är, men eftersom jag byggt upp väldigt många separata php-filer för systematikens skull, har jag lite tappat bort mig ibland i det ovannämnda. 
                Detta har synts i att jag spenderat onödigt mycket tid på övergång från en php-fil (en flik) till en annan genom tryck på knapp eller länk. Å andra sidan har integreringen från fil till fil varit ganska roligt, 
                såsom också skapandet av knappfunktioner och sparande/reagerande funktioner till dess output på sidorna.</p>

                <p>Kursen har varit givande hittils, kanske man kunde lite ha gått igenom hur man gör resets och återvänder från en sida/php-fils process tillbaka till den man var före?
                Och kanske filuppladdningen och kodandet kring det inte var riktigt så lätt ändå. Annars vet jag inte vad annat man kunde ha gått igenom.</p>
            </article>
            <article>
                <h1>Rapport - Tinka</h1>
                <p>Projektet började ganska bra, även om jag i början hade lite osäkerhet med min partner och var tvungen att byta till en annan. Slutförandet av projektet gick dock ganska smidigt, eftersom vi båda hade arbetat på lektionerna, så det tog inte lång tid att kombinera vårt arbete. Att få till helheten var enkelt, men det tog mer tid att finslipa vissa delar. Vi delade snabbt upp arbetsuppgifterna, så vi kunde finslipa vissa delar bättre.</p>

                <p>Den största utmaningen för mig har varit att hålla koll på antalet filer. Å andra sidan underlättar det när det finns kortare kodsnuttar i separata filer, men ibland tog det tid att bläddra mellan olika filer och man kom inte alltid ihåg vad som hade skrivits var. Det var inte alltid så tydligt hur många delar koden bör delas upp i, men mot slutet blev det lättare att förstå och strukturera det.</p>

                <p>Genomförandet av projektet var en lärorik upplevelse. Implementeringen av countdown-funktionen var den lättaste att förstå. Jag lärde mig mycket om tidshantering i PHP. Hantering av sessioner i inloggningsfunktionen var i början lite utmanande, men blev till slut tydligt. I genomförandet av besöksräknaren var filbaserad lagring en utmaning. Att skriva koden för besöksräknaren var det svåraste, eftersom det var den del där jag hade flest saker som jag inte förstod i början.</p>

                <p>Kursen har hittills varit bra och jag har inte känt att det har varit för mycket information på en gång. Uppgifterna var tydligt presenterade och det var lätt att hänga med i arbetet.</p>
            </article>
        </section>
    </div>
</body>
</html>