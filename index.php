<?php
require_once("pdo/connection_pdo.php");
require_once("pdo/Banco.php");
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cadastro de alunos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="css/starter-template.css" rel="stylesheet">
</head>

<body>

<?php require_once("_includes/_nav.html") ?>

<div class="container">
    <?php
    if (isset($_POST['nome']) && isset($_POST['curso'])) {

        $nome = $_POST['nome'];
        $curso = $_POST['curso'];
        $banco = new Banco();
        if ($banco->inserir($nome, $curso)) {
            echo "<div class=\"alert alert-success\" role=\"alert\">                 
                    Registro feito com sucesso!
                 </div>";
        } else {
            echo "<div class=\"alert alert-danger\" role=\"alert\">                 
                    Houve algum problema!
                 </div>";
        }
    }
    ?>
    <p>Status:
        <strong>
            <?php if (conecta()) {
                echo "Conectado";
            } else {
                echo "Não conectado";
            } ?>
        </strong>
    </p>
    <form method="post">
        <div class="form-group">
            <input name="nome" type="text" class="form-control" placeholder="Aluno" required>
        </div>

        <div class="form-group">
            <input name="curso" type="text" class="form-control" placeholder="Curso" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Curso</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $banco = new Banco();
        foreach ($banco->select() as $result) {
            echo "<tr>
                    <td>{$result['nome']}</td>
                    <td>{$result['curso']}</td>
                    <td><a href='{$result['id']}'><i class=\"material-icons\">add</i></a></td>
                    <td><a href='{$result['id']}'><i class=\"material-icons\">close</i></a></td>
                  </tr>";
        }
        ?>

        </tbody>
    </table>
</div>
</body>
</html>
