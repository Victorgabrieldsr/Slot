<?php
    session_start();
    session_destroy();
    $conn = new mysqli('localhost', 'root', 'admin', 'spin', 3307);
    $conn->query("UPDATE spin.rodadas SET SALDO = 2500, saldo_do_jogo = 0, ganhos = '', valor = 10 WHERE id = 1;");
    header('Location: ./index.php');
?>