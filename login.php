
<?php
session_start();

$response = ['success' => false, 'error' => ''];
$password = 'dasfq1f42rg3rrwg324@#@FFQ!';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
        $response['error'] = 'Please enter your name';
    } else {
        $attempts = file('content/loginattempts.txt', FILE_IGNORE_NEW_LINES);
        if (!in_array($_POST['name'], $attempts)) {
            file_put_contents('content/loginattempts.txt', $_POST['name'] . PHP_EOL, FILE_APPEND);
        }
    }
    if (empty($_POST['password'])) {
        $response['error'] = 'Please enter a password';
    } elseif ($_POST['password'] == $password) {
        $_SESSION['name'] = $_POST['name'];
        $response['success'] = true;
    } else {
        $response['error'] = 'Incorrect password';
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>