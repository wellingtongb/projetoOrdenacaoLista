<?php
    try{
        $databse = "mysql:dbname=projetoOrdenacao;host=localhost";
        $dbuser = "root";
        $dbpassword = "qwert1234";
        $pdo = new PDO($databse,$dbuser,$dbpassword);
    } catch(PDOException $e) {
        echo "Conexao falhou: ".$e->getMessage();
        exit;
    }

    if(isset($_GET['ordem']) && !empty($_GET['ordem'])){
            $ordem = addslashes($_GET['ordem']);
            $sql = "SELECT * FROM usuarios ORDER BY ".$ordem;
            $sql = $pdo->query($sql);
        }else{
            $ordem = '';
            $sql = "SELECT * FROM usuarios";
            $sql = $pdo->query($sql);
        }
?>        

<form method="GET">
    <select name="ordem" onchange="this.form.submit()">
        <option></option>
        <!-- detalhe de echo especial para deixar o item selecionado no menu dropdown -->
        <option value="nome" <?php echo ($ordem =="nome")?'selected="selected"':''; ?>>Pelo Nome</option>
        <option value="idade" <?php echo ($ordem =="idade")?'selected="selected"':''; ?>>Pela Idade</option>
        <option value="datanascimento" <?php echo ($ordem =="datanascimento")?'selected="selected"':''; ?>>Pela data de nascimento</option>
    </select>
</form>
<table border="1" width="600">
    <tr>
        <th>Nome</th>
        <th>IDade</th> 
        <th>Data Nascimento</th>
    <tr>
    <?php
        
        if($sql->rowCount() > 0){
            foreach ($sql->fetchAll() as $usuario):      
                ?>

                <tr>
                    <td><?php echo $usuario['nome']; ?></td>
                    <td><?php echo $usuario['idade']; ?></td>
                    <td><?php echo $usuario['datanascimento']; ?></td>
                </tr>

                <?php
            endforeach;
        }
    ?>
</table>