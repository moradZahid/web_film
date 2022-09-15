<?php
setcookie('email');
unset($_SESSION['email']);
unset($_SESSION['idUser']);
unset($_SESSION['isAdmin']);
unset($_SESSION['id_modification_password']);
unset($_SESSION['msg']);
unset($_SESSION['error']);
header('Location: ./');