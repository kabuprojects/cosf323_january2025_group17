<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body{
            background-color: #1a1d3b;
        }
        .dashboard-container {
            display: flex;
            flex-direction: row;
            width: 100%;
            height: 100vh;
        }

        .menu {
            width: 150px;
            background-color: #1a1d3b;
            color: #fff;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
        }

        .menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu li {
            margin-bottom: 10px;
        }

        .menu a {
            color: #fff;
            text-decoration: none;
        }

        .menu a.active {
            background-color: #444;
            padding: 10px;
            border-radius: 5px;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            margin-left: 200px;
        }

        .blue-background {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
        }
    </style>
</head>
<body>
<?php
//include 'navbar.php';
$menuOptions = array(
    'Add Asset' => 'Add Asset',
    'My Assets' => 'My Assets',
    'Generate Report' => 'Generate Report',
    'Reports' => 'reports'
);

$currentPage = isset($_GET['page']) ? $_GET['page'] : 'Add Asset';

if (!in_array($currentPage, $menuOptions)) {
    header("Location: ../pages/settings.php");
    exit;
}

?>
<div class="dashboard-container">
    <div class="menu">
        <ul>
            <?php foreach ($menuOptions as $option => $page) { ?>
                <li>
                    <a href="?page=<?php echo $page; ?>"
                        class="<?php echo (strtolower($currentPage) == strtolower($page)) ? 'active' : ''; ?>">
                        <?php echo $option; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="main-content">
        <?php
        switch (strtolower($currentPage)) {
            case 'add asset':
                include '../pages/add_asset.php';
                break;
            case 'my assets':
                include '../pages/my_assets.php';
                break;
            case 'generate report':
                include '../pages/generate_report.php';
                break;
            case 'reports':
                include '../pages/reports.php';
                break;
            default:
                echo '<h1>Error</h1><p>Invalid page.</p>';
        }
        ?>
    </div>
</div>
</body>
</html>
