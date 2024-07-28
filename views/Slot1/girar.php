<?php
session_start();
$conn = new mysqli('localhost','root','admin','spin',3307);

$valor = $_POST['valor'];
$conn->query("UPDATE spin.rodadas SET VALOR = $valor WHERE id = 1;");

$a1 = NULL;
$a2 = NULL;
$a3 = NULL;

$b1 = NULL;
$b2 = NULL;
$b3 = NULL;

$c1 = NULL;
$c2 = NULL;
$c3 = NULL;

$arr_itens = ['./imgs/fruta1.png','./imgs/fruta2.png','./imgs/fruta3.png','./imgs/fruta4.png','./imgs/fruta5.png','./imgs/fruta6.png','./imgs/fruta7.png','./imgs/fruta8.png','./imgs/fruta9.png','./imgs/fruta10.png','Go','React','Vue','Node','C#','R','Assembly','VisualBasi','SQL','Angula'];

for($i=0; $i <= 8; $i++){
    $numero_aleatorio = rand(0,5);
    switch ($i) {
        case 0:
            $a1 = $arr_itens[$numero_aleatorio];
            $_SESSION['a1'] = $a1;
            break;
        
        case 1:
            $a2 = $arr_itens[$numero_aleatorio];
            $_SESSION['a2'] = $a2;
            break;
        
        case 2:
            $a3 = $arr_itens[$numero_aleatorio];
            $_SESSION['a3'] = $a3;
            break;
        
        case 3:
            $b1 = $arr_itens[$numero_aleatorio];
            $_SESSION['b1'] = $b1;
            break;
            
        case 4:
            $b2 = $arr_itens[$numero_aleatorio];
            $_SESSION['b2'] = $b2;
            break;
        
        case 5:
            $b3 = $arr_itens[$numero_aleatorio];
            $_SESSION['b3'] = $b3;
            break;
        
        case 6:
            $c1 = $arr_itens[$numero_aleatorio];
            $_SESSION['c1'] = $c1;
            break;
        
        case 7:
            $c2 = $arr_itens[$numero_aleatorio];
            $_SESSION['c2'] = $c2;
            break;
        
        case 8:
            $c3 = $arr_itens[$numero_aleatorio];
            $_SESSION['c3'] = $c3;
            break;
    }
}

if(($a1 === $a2 && $a2 === $a3) || ($b1 === $b2 && $b2 === $b3) || ($c1 === $c2 && $c2 === $c3) || ($a1 == $b2 && $b2 === $c3) || ($a3 == $b2 && $b2 === $c1)){
    if ($a1 === $a2 && $a2 === $a3) {
        $x = $a1;
    } elseif ($b1 === $b2 && $b2 === $b3) {
        $x = $b1;
    } elseif ($c1 === $c2 && $c2 === $c3) {
        $x = $c1;
    } elseif ($a1 === $b2 && $b2 === $c3) {
        $x = $a1;
    } elseif ($a3 === $b2 && $b2 === $c1) {
        $x = $a3;
    }
    $resultado = $conn->query("SELECT * FROM spin.rodadas WHERE id = 1;");
    $row = $resultado->fetch_assoc();
    $aleatorio_ganho = random_int(15, 30) / 10;
    $estouro = random_int(0, 999) / 10;
    if($estouro === 99.9){
        $aleatorio_ganho = 33;
    }
    $ganho = $valor * $aleatorio_ganho;
    $saldo = floatval($row['SALDO']) + floatval(($ganho));
    $conn->query("UPDATE spin.rodadas SET SALDO = $saldo, GANHOS = CONCAT(GANHOS, ', $x - R$ $ganho') WHERE id = 1;");
    $_SESSION['ganho'] = $ganho;
    $_SESSION['executar'] = true;
}else{
    $_SESSION['executar'] = false;
    $resultado = $conn->query("SELECT * FROM spin.rodadas WHERE id = 1;");
    $row = $resultado->fetch_assoc();
    if($row['SALDO'] > 0){
        $saldo = floatval($row['SALDO'])  - floatval($valor);
        $conn->query("UPDATE spin.rodadas SET SALDO = $saldo WHERE id = 1;");
    }else{
        echo "Erro - SEM CREDITO";
    }
}
header("Location: ./index.php");
?>