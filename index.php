<?php
require __DIR__ . '/vendor/autoload.php';
require 'includes/connection.php';

use Bramus\Router\Router;

session_start();

$router = new Router();

$router->get('/', function() {
    require 'views/index.html';
});

$router->get('/student', function() {
    require 'views/student/login.php';
});

$router->post('/student', function() {
    require 'views/student/login.php';
});

$router->get('/student/dashboard', function() {
    require 'views/student/dashboard.php';
});

$router->get('/student/caps_team', function() {
    require 'views/student/caps_team.php';
});

$router->get('/student/micro', function() {
    require 'views/student/notopened.php';
});

$router->get('/student/csp', function() {
    require 'views/student/notopened.php';
});

$router->get('/student/bench', function() {
    require 'views/student/notopened.php';
});

$router->get('/student/change_password', function() {
    require 'views/student/change_password.php';
});

$router->post('/student/change_password', function() {
    require 'views/student/change_password.php';
});

$router->get('/faculty', function() {
    require 'views/faculty/login.php';
});

$router->post('/faculty', function() {
    require 'views/faculty/login.php';
});

$router->get('/faculty/login', function() {
    require 'views/faculty/login.php';
});

$router->post('/faculty/login', function() {
    require 'views/faculty/login.php';
});

$router->get('/faculty/micro', function() {
    require 'views/faculty/notopened.php';
});

$router->get('faculty/bench', function() {
    require 'views/faculty/notopened.php';
});

$router->get('/faculty/csp', function() {
    require 'views/faculty/notopened.php';
});

$router->get('/faculty/caps_team', function() {
    require 'views/faculty/caps_teams.php';
});

$router->get('/faculty/caps_view', function() {
    require 'views/faculty/caps_view.php';
});


$router->get('/faculty/dashboard', function() {
    require 'views/faculty/dashboard.php';

});

$router->get('/faculty/change_password', function() {
    require 'views/faculty/change_password.php';
});

$router->post('/faculty/change_password', function() {
    require 'views/faculty/change_password.php';
});

$router->get('/admin', function() {
    require 'views/admin/login.php';
});

$router->post('/admin', function() {
    require 'views/admin/login.php';
});

$router->get('/admin/dashboard', function() {
    require 'views/admin/dashboard.php';
});


$router->get('/student/logout', function() {
    session_destroy();
    header('Location: ../');
    exit();
});

$router->get('/faculty/logout', function() {
    session_destroy();
    header('Location: ../');
    exit();
});

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo '<h1>404 - Page Not Found</h1>';
    echo '<p>The page you are looking for does not exist.</p>';
    exit();
});



$router->run();
