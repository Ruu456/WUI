<!DOCTYPE html>
<html lang="en">
    <head>
        <title>UPM Informatika</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
        box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .toggle-btn {
            position: fixed;
            top: 12px;
            left: 210px; /* sits just outside the sidebar when expanded */
            z-index: 30;
            background-color: #111;
            color: white;
            border: none;
            padding: 10px 12px;
            cursor: pointer;
            border-radius: 4px;
            transition: left 0.3s ease;
        }

        .toggle-btn.sidebar-collapsed {
            left: 12px; /* move back when sidebar is hidden */
        }

        .sidenav {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 10;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: width 0.3s ease;
        }

        .sidenav h4 {
            color: white;
            padding: 15px 20px;
            text-decoration: none;
            font-size: 18px;
            display: block;
            border-bottom: 1px solid #818181;
        }

        .sidenav a {
            padding: 15px 20px;
            text-decoration: none;
            font-size: 18px;
            color: #818181;
            display: block;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .sidenav.collapsed {
            width: 0;
            overflow: hidden;
        }

        .sidenav a:hover {
            background-color: #ddd;
            color: black;
        }

        .content {
            margin-left: 200px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .content.sidebar-hidden {
            margin-left: 0;
        }

        .page-frame {
            display: block;
            width: 100%;
            min-height: calc(100vh - 40px);
            border: 0;
        }

        </style>
    
    </head>
    <body>
        <button class="toggle-btn" type="button">☰</button>
        <div class="sidenav" id="sidenav">
            <h4>Menu</h4>
            <a href="upm.php?page=dashboard">Home</a>
            <a href="upm.php?page=mahasiswa">Mahasiswa</a>
            <a href="upm.php?page=skripsi">Skripsi</a>
        </div>

        <div class="content" id="content">
            <?php
                $page = $_GET['page'] ?? 'dashboard';
                $allowed_pages = [
                    'dashboard' => 'dashboard.php',
                    'mahasiswa' => 'mahasiswa.php',
                    'skripsi' => 'skripsi.php',
                ];

                if (isset($allowed_pages[$page])) {
                    $frame_src = htmlspecialchars($allowed_pages[$page], ENT_QUOTES, 'UTF-8');
                    echo '<iframe class="page-frame" src="' . $frame_src . '" title="' . htmlspecialchars(ucfirst($page), ENT_QUOTES, 'UTF-8') . '"></iframe>';
                } else {
                    echo "<h2>Error 404: Page not found.</h2>";
                }
            ?>
        </div>
        
        <script>
            const toggleBtn = document.querySelector('.toggle-btn');
            const sidenav = document.querySelector('.sidenav');
            const content = document.querySelector('.content');

            toggleBtn.addEventListener('click', () => {
                sidenav.classList.toggle('collapsed');
                content.classList.toggle('sidebar-hidden');
                toggleBtn.classList.toggle('sidebar-collapsed');
            });
        </script>

    </body>
</html>
