
<?php
session_start();

// // Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit();

// $page = $_GET['page'] ?? 'dashboard';
// $allowed_pages = ['dashboard', 'angkatan', 'mahasiswa'];

// if (in_array($page, $allowed_pages, true)) {
//     include __DIR__ . '/' . $page . '.php';
// } else {
//     echo "<h2>Error 404: Page not found.</h2>";
// }
// }

$page_title = 'Dashboard';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
        }
        
        .container {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .header h1 {
            color: #2c3e50;
            font-size: 28px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-info a {
            background: #e74c3c;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            transition: background 0.3s ease;
        }
        
        .user-info a:hover {
            background: #c0392b;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        
        .stat-card h3 {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .stat-card .value {
            font-size: 32px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .content-section {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .content-section h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 22px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        table th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            color: #2c3e50;
            font-weight: 600;
            border-bottom: 2px solid #ecf0f1;
        }
        
        table td {
            padding: 12px;
            border-bottom: 1px solid #ecf0f1;
        }
        
        table tr:hover {
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="header">
            <h1><?php echo $page_title; ?></h1>
            <div class="user-info">
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></span>
                <a href="logout.php">Logout</a>
            </div>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Records</h3>
                <div class="value">1,234</div>
            </div>
            <div class="stat-card">
                <h3>Active Users</h3>
                <div class="value">56</div>
            </div>
            <div class="stat-card">
                <h3>Pending Tasks</h3>
                <div class="value">12</div>
            </div>
            <div class="stat-card">
                <h3>Completed</h3>
                <div class="value">89%</div>
            </div>
        </div>
        
        <div class="content-section">
            <h2>Recent Activity</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Activity</th>
                        <th>User</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2024-01-15</td>
                        <td>Data Import</td>
                        <td>Admin</td>
                        <td>Completed</td>
                    </tr>
                    <tr>
                        <td>2024-01-14</td>
                        <td>Report Generated</td>
                        <td>User</td>
                        <td>Completed</td>
                    </tr>
                    <tr>
                        <td>2024-01-13</td>
                        <td>System Update</td>
                        <td>Admin</td>
                        <td>Pending</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
