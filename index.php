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
    if (isset($_POST['nome']) && isset($_POST['curso']) && !isset($_GET['act'])) {

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
    if (isset($_POST['nome']) && isset($_POST['curso']) && isset($_GET['act'])) {

        $nome = $_POST['nome'];
        $curso = $_POST['curso'];
        $id = $_GET['id'];

        $banco = new Banco();

        if ($banco->update($nome, $curso, $id) > 0) {
            echo "<div class=\"alert alert-success\" role=\"alert\">
                    Registro atualizado com sucesso!
                 </div>";
        } else {
            echo "<div class=\"alert alert-danger\" role=\"alert\">
                    Houve algum problema!
                 </div>";
        }
    }

    if (isset($_GET['act']) && $_GET['act'] == "delete") {

        $id = $_GET['id'];
        $banco = new Banco();
        $banco->delete($id);

        echo "<div class=\"alert alert-success\" role=\"alert\">
                    Registro deletado com sucesso!
                 </div>";


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
    <form method="post" id="form_aluno">

        <div class="form-group">
            <input name="nome" type="text" class="form-control" placeholder="Aluno"
                   value="<?php if (isset($_GET['nome'])) {
                       echo $_GET['nome'];
                   } ?>" required>
        </div>

        <div class="form-group">
            <input name="curso" type="text" class="form-control" placeholder="Curso"
                   value="<?php if (isset($_GET['curso'])) {
                       echo $_GET['curso'];
                   } ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">
            Salvar
        </button>
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
                    <td><a href='?act=update&nome={$result['nome']}&curso={$result['curso']}&id={$result['id']}'><i class=\"material-icons\">edit</i></a></td>
                    <td><a href='?act=delete&id={$result['id']}'><i class=\"material-icons\">close</i></a></td>
                  </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

</body>


</html>
