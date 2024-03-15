<!DOCTYPE html>
<html>
<head>
    <title>Deteksi Penyakit Hewan Musang</title>
    <link rel="stylesheet" href="<?php echo 'code.css'; ?>">
</head>
<body>
    <header>
        <div class="main">
            <nav>
                <div class="logo"><h1>MusangNosis</h1></div>
                <div class="navigasi">
                    <ul>
                        <li><a href="<?php echo 'code.php'; ?>">Beranda</a></li>
                        <li><a href="#diagnosis">Diagnosis</a></li>
                        <li><a href="https://www.instagram.com/barisetiawan51/">Kontak</a><li>
                        <li><a href="https://informatika.ump.ac.id/">Tentang</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="title">
            <p>SISTEM PAKAR DETEKSI PENYAKIT<br>PADA HEWAN MUSANG</p>
            <div class="GetStarted">
                <a href="#diagnosis">
                    <input class="submit" type="submit" value="GET STARTED">
                </a>
            </div> 
        </div>
    </header>

    <section class="diagnosis" id="diagnosis">
    <div class="container">
        <h1>Diagnosis Musang</h1>
    <div class="main">
        <form method="post" action="#diagnosis" id="diagnosis-form" class="diagnosis-form">
            <div class="form-columns">
                <div class="column">
                    <label for="gejala">Pilih gejala yang diamati:</label><br>
                    <input type="checkbox" name="gejala[]" value="Perubahan perilaku">Perubahan perilaku<br>
                    <input type="checkbox" name="gejala[]" value="Agresif">Agresif<br>
                    <input type="checkbox" name="gejala[]" value="Hiperaktif">Hiperaktif<br>
                    <input type="checkbox" name="gejala[]" value="Muntah">Muntah<br>
                    <input type="checkbox" name="gejala[]" value="Diare">Diare<br>
                    <input type="checkbox" name="gejala[]" value="Berbau busuk">Berbau busuk<br>
                    <input type="checkbox" name="gejala[]" value="Kehilangan nafsu makan">Kehilangan nafsu makan<br>
                    <input type="checkbox" name="gejala[]" value="Ruam">Ruam<br>
                </div>
                <div class="column">
                    <input type="checkbox" name="gejala[]" value="Gatal-gatal">Gatal-gatal<br>
                    <input type="checkbox" name="gejala[]" value="Demam">Demam<br>
                    <input type="checkbox" name="gejala[]" value="Nyeri otot">Nyeri otot<br>
                    <input type="checkbox" name="gejala[]" value="Penurunan berat badan">Penurunan berat badan<br>
                    <input type="checkbox" name="gejala[]" value="Kerontokan rambut">Kerontokan rambut<br>
                    <input type="checkbox" name="gejala[]" value="Poliuria">Poliuria<br>
                    <input type="checkbox" name="gejala[]" value="Polidipsia">Polidipsia<br>
                    <input type="checkbox" name="gejala[]" value="Kelelahan">Kelelahan<br>
                </div>
            </div>
            <div class="deteksi" id="deteksisection">
                <input class="submit" type="submit" value="Deteksi" onclick="performDetection(event)">
                <input class="reset" type="reset" value="Reset" onclick="resetForm()">
            </div>
        </form>
    </div>
    </div>
    </section>

    <div id="output-section">
    <?php
    // Definisi basis pengetahuan dengan daftar penyakit, gejala, dan pengobatan
    $pengetahuan = array(
        array(
            "penyakit" => "Rabies",
            "gejala" => array("Perubahan perilaku", "Agresif", "Hiperaktif"),
            "pengobatan" => "Vaksin rabies, perawatan suportif"
        ),
        array(
            "penyakit" => "Parvovirus",
            "gejala" => array("Muntah", "Diare", "Berbau busuk", "Kehilangan nafsu makan"),
            "pengobatan" => "Perawatan suportif, cairan infus, antibiotik"
        ),
        array(
            "penyakit" => "Tinea (kurap)",
            "gejala" => array("Ruam", "Gatal-gatal", "Kulit mengelupas"),
            "pengobatan" => "Salep anti jamur, obat anti jamur (oral)"
        ),
        array(
            "penyakit" => "Leptospirosis",
            "gejala" => array("Demam", "Muntah", "Diare", "Nyeri otot"),
            "pengobatan" => "Antibiotik, cairan infus"
        ),
        array(
            "penyakit" => "Kanker",
            "gejala" => array("Penurunan berat badan", "Kehilangan nafsu makan"),
            "pengobatan" => "Kemoterapi, radioterapi, operasi"
        ),
        array(
            "penyakit" => "Dermatitis",
            "gejala" => array("Gatal-gatal kemerahan pada kulit", "Kerontokan rambut"),
            "pengobatan" => "Obat antiinflamasi, obat antialergi, simtomatik"
        ),
        array(
            "penyakit" => "Diabetes Mellitus",
            "gejala" => array("Poliuria", "Polidipsia", "Penurunan berat badan"),
            "pengobatan" => "Diet khusus, insulin, pengaturan pola makan"
        ),
        array(
            "penyakit" => "Coccidiosis",
            "gejala" => array("Diare berdarah", "Kehilangan nafsu makan"),
            "pengobatan" => "Obat antiparasit, perawatan suportif"
        ),
        array(
            "penyakit" => "Penyakit ginjal",
            "gejala" => array("Muntah", "Diare", "Penurunan berat badan", "Kelelahan"),
            "pengobatan" => "Perawatan suportif, pengobatan simtomatik"
        ),
        array(
            "penyakit" => "Penyakit jantung",
            "gejala" => array("Sesak napas", "Lemas", "Pembengkakan pada perut atau kaki"),
            "pengobatan" => "Obat jantung, perawatan suportif"
        ),
    );

// Fungsi untuk mencari penyakit berdasarkan gejala
    function cariPenyakit($gejala) {
        global $pengetahuan;
        $penyakitDitemukan = array();

        foreach ($pengetahuan as $data) {
            $gejalaPenyakit = $data['gejala'];
            $found = true;

            // Mengecek apakah setidaknya satu gejala penyakit ada di gejala yang dipilih
            foreach ($gejalaPenyakit as $g) {
                if (in_array($g, $gejala)) {
                    $penyakitDitemukan[] = $data['penyakit'];
                    break; // Lanjut ke penyakit berikutnya
                }
            }
        }

        if (empty($penyakitDitemukan)) {
            return array("Penyakit tidak diketahui");
        } else {
            return $penyakitDitemukan;
        }
    }

    // Fungsi untuk mendapatkan pengobatan berdasarkan penyakit
    function getPengobatan($penyakit) {
        global $pengetahuan;

        foreach ($pengetahuan as $data) {
            if ($data['penyakit'] == $penyakit) {
                return $data['pengobatan'];
            }
        }

        return "Informasi pengobatan tidak tersedia";
    }

    // Proses form jika ada data yang dikirimkan
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gejalaUser = $_POST["gejala"];
    $penyakitDitemukan = cariPenyakit($gejalaUser);

    echo "<div class='output'>";
    echo "<p>Berdasarkan gejala yang Anda berikan, kemungkinan penyakit pada hewan musang adalah:</p>";
    foreach ($penyakitDitemukan as $penyakit) {
        echo "<li>$penyakit</li>";
        echo "<ul>Pengobatan yang dapat dilakukan: " . getPengobatan($penyakit)."</ul>";
    }
    echo "</div>";
}

    ?>
    </div>

     <script>
        document.querySelector('.GetStarted input.submit').addEventListener('click', function(event) {
            event.preventDefault();

            var targetElement = document.querySelector('#diagnosis');
            var targetPosition = targetElement.offsetTop;
            var startPosition = window.pageYOffset;
            var distance = targetPosition - startPosition;
            var duration = 1000; // Adjust the duration (in milliseconds) to control the scrolling speed
            var startTimestamp = null;

            function scrollAnimation(timestamp) {
                if (!startTimestamp) startTimestamp = timestamp;
                var progress = timestamp - startTimestamp;
                var scrollStep = Math.min(progress / duration, 1) * distance;
                window.scrollTo(0, startPosition + scrollStep);

                if (progress < duration) {
                requestAnimationFrame(scrollAnimation);
                }
            }

            requestAnimationFrame(scrollAnimation);
            });

        // Fungsi untuk melakukan deteksi penyakit menggunakan AJAX
        function performDetection(event) {
            
            var form = document.getElementById("diagnosis-form");
            var formData = new FormData(form);

            // Kirim data form ke server menggunakan AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Perbarui bagian output dengan respons dari server
                        document.getElementById("output-section").innerHTML = xhr.responseText;
                    } else {
                        // Tangani jika terjadi kesalahan
                        console.log("Error: " + xhr.status);
                    }
                }
            };
            xhr.open("POST", "", true); // Update URL jika diperlukan
            xhr.send(formData);
        }

       function resetForm() {
            document.getElementById("diagnosis-form").reset();
            document.getElementById("output-section").innerHTML = ""; // Clear the output section
        }
        </script>
        
        <footer>
            <div class="footer-logo"><h1>MusangNosis</h1></div>
            </div>
            <div class="footer-copyright">
                Copyright 2023 ImamBari || All Rights Reserved
            </div>
        </footer>
</body>
</html>
