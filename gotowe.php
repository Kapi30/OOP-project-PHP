<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header>
    <h1>WYPOŻYCZALNIA KOPAREK</h1>

    </header>
    <main> 
        <form  method="POST" action="gotowe.php">
            <div class="forms">
                <label for="hour">Ilość godzin wynajmu</label>
                <input type="number" id="hour" name="hour" value="1">
            </div>
            <br>
            <div class="forms">
                <label for="lenght">Odległość od klienta(km)</label>
                <input type="number" id="lenght" name="lenght" value="10">
            </div>
            <br>
            <div class="forms">
                <label for="promotion">Promocja</label>
                <input type="text" id="promotion" name="promotion" value="Brak" disabled>
            </div>
            <br>
            <div class="forms">
                <label for="BonusWorker">Czy potrzebny pracownik dodatkowy</label>
                <input type="checkbox" id="BonusWorker" name="BonusWorker" value="TAK">
            </div>
            <br>
            <div class="forms">
                <label for="czyKorzystales">Czy korzystałeś z usług naszej firmy</label>
                <input type="checkbox" id="czyKorzystales" name="czyKorzystales" value="TAK">
            </div>
            <br>
            <div class="forms" id="ileDiv" style="display: none;">
                <label for="ile">Ile razy korzystałeś z usług naszej firmy</label>
                <input type="number" id="HowMany" name="ile" value="0">
            </div>
            <br>
            <div class="forms">
                <input type="submit" value="Wyślij" name="submit" onclick="pokazWynik()">

            </div>
        <?php
        $hour = $_POST['hour'];
        $lenght = $_POST['lenght'];
        $promotion = $_POST['ile'];
        $BonusWorker = $_POST['BonusWorker'] ?? null;
        
        class UslugaBezRabatu
        {
            public $hour;
            public $lenght;
            public $BonusWorker;
            public $wynik;
            function __construct($hour, $lenght, $BonusWorker)
            {
                $this->hour = $hour;
                $this->lenght = $lenght;
                $this->BonusWorker = $BonusWorker;

                $this->wynik = (150 * $hour) + (12 * $lenght);
                if (isset($BonusWorker)){
                    $this->wynik += 50;
                }
               
            }
            public function getWynik()
            {
                return $this->wynik;
            }
        }
        



        class UslugaZRabatem extends UslugaBezRabatu
        {
            private $promotion;

            function __construct($hour, $lenght, $BonusWorker,$promotion)
            {
                $this->hour = $hour;
                $this->lenght = $lenght;
                $this->promotion =  $promotion;
                $this->wynik = (150 * $hour) + (12 * $lenght);
                if (isset($BonusWorker)){
                    $this->wynik += 50;
                }
               
            
            }

            public function getWynik()
            {
                if ($this->promotion == 1) {
                    $discount = $this->wynik * 0.10; // 10% rabatu
                    $this->wynik -= $discount;

                } elseif ($this->promotion == 2) {
                    $discount = $this->wynik * 0.20; // 20% rabatu
                    $this->wynik -= $discount;

                } elseif ($this->promotion == 3) {
                    $discount = $this->wynik * 0.30; // 30% rabatu
                    $this->wynik -= $discount;

                } elseif ($this->promotion >= 4) {
                    $discount = $this->wynik * 0.40; // 40% rabatu
                    $this->wynik -= $discount;

                }
        
                return $this->wynik;
            
            }
        }

         
        if ($promotion > 0) {
            $service = new UslugaZRabatem($hour, $lenght, $BonusWorker, $promotion);
        } else {
            $service = new UslugaBezRabatu($hour, $lenght, $BonusWorker);
        }

        echo "<div class='forms'>
        Wynik: " . $service->getWynik() . " zł
        <br> Cena za Godziny: " . $service->hour . " zł
        <br> Odległość: " . $service->lenght . " km
        <br> Pracownik dodatkowy: " . ($service->BonusWorker ? 'Tak' : 'Nie') . "
    </div>";
      ?>
      </main>
          <aside>
        <table border="1">
            <thead>
                <tr>
                    <th colspan="3">CENNIK</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Godzina wynajmu</td>
                    <td>150zł</td>
                </tr>
                <tr>
                    <td>Odległość od klienta</td>
                    <td>12zł/km</td>

                </tr>
                <tr>
                    <td>Dodatkowy Pracownik</td>
                    <td>50zł</td>
                </tr>
                <tr>
                    <td>Skorzystanie z usług Firmy 1 raz</td>
                    <td>10% zniżki</td>
                </tr>
                <tr>
                    <td>Skorzystanie z usług Firmy 2 razy</td>
                    <td>20% zniżki</td>
                </tr>
                <tr>
                    <td>Skorzystanie z usług Firmy 3 razy</td>
                    <td>30% zniżki</td>
                </tr>
                <tr>
                    <td>Skorzystanie z usług Firmy ponad 4 razy</td>
                    <td>40% zniżki</td>
                </tr>
            </tbody>
        </table>




    </aside>
    <footer>
    <div class="footer-content">
        <div class="footer-section company-info">
            <h3>Wypożyczalnia Koparek</h3>
            <p>Profesjonalny sprzęt budowlany na wynajem</p>
            <p>Doświadczenie, niezawodność, satysfakcja</p>
        </div>
        <div class="footer-section contact">
            <h3>Kontakt</h3>
            <p>Email: <a href="mailto:kontakt@wypozyczalnia-koparek.pl">kontakt@wypozyczalnia-koparek.pl</a></p>
            <p>Telefon: +48 123 456 789</p>
            <p>Adres: ul. Budowlana 15, Warszawa</p>
        </div>
        <div class="footer-section links">
            <h3>Przydatne linki</h3>
            <p><a href="#">O nas</a></p>
            <p><a href="#">Oferta</a></p>
            <p><a href="#">Regulamin</a></p>
        </div>
        <div class="footer-section social">
            <h3>Śledź nas</h3>
            <div class="social-icons">
            <a href="https://www.facebook.com" target="_blank" class="social-icon"><i class="fa-brands fa-facebook"></i>Facebook</a>
                <a href="https://www.instagram.com" target="_blank" class="social-icon"><i class="fa-brands fa-instagram"></i>Instagram</a>
                <a href="https://www.linkedin.com" target="_blank" class="social-icon"><i class="fa-brands fa-linkedin"></i>LinkedIn</a>
            </div>
        </div>
    </div>
    </footer>
    <script>
        var ileDiv = document.getElementById('ileDiv');
        var check = document.getElementById('czyKorzystales');

        function pokazIle() {
            if (check.checked) {
                ileDiv.style.display = "block";
            } else {
                ileDiv.style.display = "none";
            }
        }

        pokazIle();




        function updatePromotion() {
            check.addEventListener('change', pokazIle);
            var HowMany = document.getElementById('HowMany').value;
            if (HowMany == 1) {

                document.getElementById('promotion').value = "10%";
            } else if (HowMany == 2) {

                document.getElementById('promotion').value = "20%";
            } else if (HowMany == 3) {

                document.getElementById('promotion').value = "30%";
            } else if (HowMany >= 4) {

                document.getElementById('promotion').value = "40%";
            } else {
                document.getElementById('promotion').value = "BRAK";
            }
        }

        updatePromotion();
        HowMany.addEventListener('input', updatePromotion);
    </script>
</body>

</html>