<?php
    session_start();
    $conn = new mysqli('localhost','root','admin','spin',3307);
    if(!isset($_SESSION['a1'])){
        $arr_list = ['a1','a2','a3','b1','b2','b3','c1','c2','c3'];
        foreach($arr_list as $arl){
            $_SESSION[$arl] = null;
        }
    }
    if(!isset($_SESSION['ganho'])){
        $_SESSION['ganho'] = 0;
    }
    if(!isset($_SESSION['executar'])){
        $_SESSION['executar'] = false;
    }

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    
</head>
<body>
    <article class="article-horizontal">
        <div class="div-central">
            
            <article class="itens-horizontal">
                <div class="todos-itens" id="item-a1"><img src=<?php echo $_SESSION['a1']; ?>></div>
                <div class="todos-itens" id="item-a2"><img src=<?php echo $_SESSION['a2']; ?>></div>
                <div class="todos-itens" id="item-a3"><img src=<?php echo $_SESSION['a3']; ?>></div>
            </article>

            <article class="itens-horizontal">
                <div class="todos-itens" id="item-b1"><img src=<?php echo $_SESSION['b1']; ?>></div>
                <div class="todos-itens" id="item-b2"><img src=<?php echo $_SESSION['b2']; ?>></div>
                <div class="todos-itens" id="item-b3"><img src=<?php echo $_SESSION['b3']; ?>></div>
            </article>

            <article class="itens-horizontal">
                <div class="todos-itens" id="item-c1"><img src=<?php echo $_SESSION['c1']; ?>></div>
                <div class="todos-itens" id="item-c2"><img src=<?php echo $_SESSION['c2']; ?>></div>
                <div class="todos-itens" id="item-c3"><img src=<?php echo $_SESSION['c3']; ?>></div>
            </article>
    
        </div>
        <div class="div-central2">
            <label>GANHOS:
                <?php 
                $resultado = $conn->query("SELECT * FROM spin.rodadas WHERE id = 1;");
                if($resultado->num_rows > 0){
                    while($row = $resultado->fetch_assoc()){
                        echo $row['GANHOS'];
                    }
                }
                ?>
            </label>
        </div>
    </article>
    
    <article class="botoes-horizontal">
        <label>SALDO: 
            <?php 
            $resultado = $conn->query("SELECT * FROM spin.rodadas WHERE id = 1;");
            if($resultado->num_rows > 0){
                while($row = $resultado->fetch_assoc()){
                    echo $row['SALDO'];
                }
            }
            ?> 
        </label>
        <br>
        <label>SALDO DO JOGO:
        <?php
        $resultado = $conn->query("SELECT * FROM spin.rodadas WHERE id = 1;");
        if($resultado->num_rows > 0){
            $row = $resultado->fetch_assoc();
            echo $row['SALDO_DO_JOGO'];
        }
        ?>
        </label>
        <br>
        <form action="girar.php" method="post">
            <input type="number" name="valor" min="10" max="100" step="10" 
            value="<?php 
            $resultado = $conn->query("SELECT * FROM spin.rodadas WHERE id = 1;");
            $row = $resultado->fetch_assoc();
            echo $row['VALOR'];
            ?>">
            <input type="submit" value="GIRAR">
        </form>
        <form action="reset.php" method="post">
            <br>
            <input type="submit" value="RESET" name="reset">
        </form>

    </article>

    <div id="win" style="display:none;">
        <h1>WIN: <span id="contador">R$ 0,00</span></h1>
    </div>
    
</body>
<script>
    
            
            let maxValor = <?php echo $_SESSION['ganho']; ?>;
            let contador = 0.00;
    
            // Função para formatar como moeda brasileira
            function formatarMoeda(valor) {
                return valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            }
    
            // Função para atualizar o contador
            function atualizarContador() {
                document.getElementById('win').style.display = "flex";
                if (contador <= maxValor) {
                    document.getElementById('contador').innerText = formatarMoeda(contador);
                    contador += 0.20;
                    setTimeout(atualizarContador, 01); // Atualiza a cada 10 milissegundos
                } 
            }
            function remover(){
                document.getElementById("win").style.display = "none";
            }
      
    </script>
    <?php
      if ($_SESSION['executar'] === true) {
        echo "
        <script type='text/javascript'>
            atualizarContador();
        </script>
        ";
    }else if($_SESSION['executar'] === true){
        echo "
        <script type='text/javascript'>
            remover();
        </script>
        ";
    }

    ?>
</html>

