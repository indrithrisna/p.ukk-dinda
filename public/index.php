<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/models/database.php';
require_once __DIR__ . '/../app/models/user.php';
require_once __DIR__ . '/../app/models/alat.php';
require_once __DIR__ . '/../app/models/peminjaman.php';
require_once __DIR__ . '/../app/controllers/AuthControllers.php';
require_once __DIR__ . '/../app/controllers/DashboardControllers.php';
require_once __DIR__ . '/../app/controllers/AlatControllers.php';
require_once __DIR__ . '/../app/controllers/PeminjamanControllers.php';

$url = isset($_GET['url']) ? $_GET['url'] : '';
$url = rtrim($url, '/');
$url = explode('/', $url);

$controller = $url[0];
$method = isset($url[1]) ? $url[1] : 'index';

if($controller == 'dashboard'){
    $ctrl = new DashboardController();
    $ctrl->index();
}
elseif($controller == 'alat'){
    $ctrl = new AlatController();
    if(method_exists($ctrl, $method)){
        $ctrl->$method();
    } else {
        $ctrl->index();
    }
}
elseif($controller == 'peminjaman'){
    $ctrl = new PeminjamanController();
    if(method_exists($ctrl, $method)){
        $ctrl->$method();
    } else {
        $ctrl->index();
    }
}
elseif($controller == 'login'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ctrl = new AuthController();
        $ctrl->proses();
    } else {
        header("Location: " . BASEURL);
    }
}
elseif($controller == 'logout'){
    $ctrl = new AuthController();
    $ctrl->logout();
}
else{
    $ctrl = new AuthController();
    $ctrl->login();
}