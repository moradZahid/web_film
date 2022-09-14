<?php
unset($_SESSION['email']);
unset($_SESSION['idUser']);
unset($_SESSION['isAdmin']);
unset($_SESSION['id_modification_password']);
header('Location: ./');