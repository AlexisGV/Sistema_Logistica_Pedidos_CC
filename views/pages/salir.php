<?php
if (isset($_COOKIE["user_ck"])) {
    setcookie("user_ck", "", time() - 183 * 24 * 60 * 60);
    unset($_COOKIE['user_ck']);
    setcookie("pass_ck", "", time() - 183 * 24 * 60 * 60);
    unset($_COOKIE['pass_ck']);
}
session_destroy();

echo '<script> window.location = "ingreso" </script>';