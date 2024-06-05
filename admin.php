<?php
session_start();

// Verificar se o atendente não está logado
if (!isset($_SESSION['username'])) {
    header("Location: login_atendente.php");
    exit;
}

include_once "conexao.php";

// Adicionar Produto
if (isset($_POST['add_produto'])) {
    if (!empty($_POST['nome']) && !empty($_POST['descricao']) && !empty($_POST['preco']) && 
    !empty($_POST['estoque'])) {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $estoque = $_POST['estoque'];
        $sql = "INSERT INTO produtos (nome, descricao, preco, estoque) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nome, $descricao, $preco, $estoque])) {
            $_SESSION['success_message'] = "Produto adicionado com sucesso!";
        } else {
            $_SESSION['error_message'] = "Erro ao adicionar produto.";
        }
    } else {
        $_SESSION['error_message'] = "Por favor, preencha todos os campos.";
    }
}

// Editar Produto
if (isset($_POST['edit_produto'])) {
    if (!empty($_POST['id']) && !empty($_POST['nome']) && !empty($_POST['descricao']) && 
    !empty($_POST['preco']) && !empty($_POST['estoque'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $estoque = $_POST['estoque'];
        $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, estoque = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nome, $descricao, $preco, $estoque, $id])) {
            $_SESSION['success_message'] = "Produto atualizado com sucesso!";
        } else {
            $_SESSION['error_message'] = "Erro ao atualizar produto.";
        }
    } else {
        $_SESSION['error_message'] = "Por favor, preencha todos os campos.";
    }
}

// Deletar Produto
if (isset($_POST['delete_produto'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$id])) {
        $_SESSION['success_message'] = "Produto deletado com sucesso!";
    } else {
        $_SESSION['error_message'] = "Erro ao deletar produto.";
    }
}

// Adicionar Cliente
if (isset($_POST['add_cliente'])) {
    if (!empty($_POST['nome']) && !empty($_POST['endereco']) && !empty($_POST['telefone']) && !empty($_POST['email'])) {
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $sql = "INSERT INTO clienteCrud (nome, endereco, telefone, email) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nome, $endereco, $telefone, $email])) {
            $_SESSION['success_message'] = "Cliente adicionado com sucesso!";
        } else {
            $_SESSION['error_message'] = "Erro ao adicionar cliente.";
        }
    } else {
        $_SESSION['error_message'] = "Por favor, preencha todos os campos.";
    }
}

// Editar Cliente
if (isset($_POST['edit_cliente'])) {
    if (!empty($_POST['id']) && !empty($_POST['nome']) && !empty($_POST['endereco']) && !empty($_POST['telefone']) && !empty($_POST['email'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $sql = "UPDATE clienteCrud SET nome = ?, endereco = ?, telefone = ?, email = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nome, $endereco, $telefone, $email, $id])) {
            $_SESSION['success_message'] = "Cliente atualizado com sucesso!";
        } else {
            $_SESSION['error_message'] = "Erro ao atualizar cliente.";
        }
    } else {
        $_SESSION['error_message'] = "Por favor, preencha todos os campos.";
    }
}

// Deletar Cliente
if (isset($_POST['delete_cliente'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM clienteCrud WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$id])) {
        $_SESSION['success_message'] = "Cliente deletado com sucesso!";
    } else {
        $_SESSION['error_message'] = "Erro ao deletar cliente.";
    }
}

// Adicionar Pedido
if (isset($_POST['add_pedido'])) {
    if (!empty($_POST['cliente_id']) && !empty($_POST['data_pedido']) && !empty($_POST['status'])) {
        $cliente_id = $_POST['cliente_id'];
        $data_pedido = $_POST['data_pedido'];
        $status = $_POST['status'];
        $sql = "INSERT INTO pedidos (cliente_id, data_pedido, status) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$cliente_id, $data_pedido, $status])) {
            $_SESSION['success_message'] = "Pedido adicionado com sucesso!";
        } else {
            $_SESSION['error_message'] = "Erro ao adicionar pedido.";
        }
    } else {
        $_SESSION['error_message'] = "Por favor, preencha todos os campos.";
    }
}

// Editar Pedido
if (isset($_POST['edit_pedido'])) {
    if (!empty($_POST['id']) && !empty($_POST['cliente_id']) && !empty($_POST['data_pedido']) && !empty($_POST['status'])) {
        $id = $_POST['id'];
        $cliente_id = $_POST['cliente_id'];
        $data_pedido = $_POST['data_pedido'];
        $status = $_POST['status'];
        $sql = "UPDATE pedidos SET cliente_id = ?, data_pedido = ?, status = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$cliente_id, $data_pedido, $status, $id])) {
            $_SESSION['success_message'] = "Pedido atualizado com sucesso!";
        } else {
            $_SESSION['error_message'] = "Erro ao atualizar pedido.";
        }
    } else {
        $_SESSION['error_message'] = "Por favor, preencha todos os campos.";
    }
}

// Deletar Pedido
if (isset($_POST['delete_pedido'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM pedidos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$id])) {
        $_SESSION['success_message'] = "Pedido deletado com sucesso!";
    } else {
        $_SESSION['error_message'] = "Erro ao deletar pedido.";
    }
}

// Listar Produtos
$sql = "SELECT * FROM produtos";
$stmt = $pdo->query($sql);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Listar Clientes
$sql = "SELECT * FROM clienteCrud";
$stmt = $pdo->query($sql);
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Listar Pedidos
$sql = "SELECT * FROM pedidos";
$stmt = $pdo->query($sql);
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin.css">
    <title>Painel de Administração</title>
</head>

<body>
    <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <hr>
    <!-- Produtos -->
    <h2>Produtos</h2>
    <table data-formType="produto">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($produtos as $produto) : ?>
            <tr>
                <td><?= $produto['id'] ?></td>
                <td><?= $produto['nome'] ?></td>
                <td><?= $produto['descricao'] ?></td>
                <td><?= $produto['preco'] ?></td>
                <td><?= $produto['estoque'] ?></td>
                <td>
                <a class="edit-btn" href="editar_produto.php?id=<?= $produto['id'] ?>">Editar</a> 
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                        <button type="submit" name="delete_produto">Deletar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Adicionar Produto</h3>
    <form method="post">
        <input type="text" name="nome" placeholder="Nome">
        <input type="text" name="descricao" placeholder="Descrição">
        <input type="text" name="preco" placeholder="Preço">
        <input type="text" name="estoque" placeholder="Estoque">
        <button type="submit" name="add_produto">Adicionar</button>
    </form>

    <!-- Clientes -->
    <h2>Clientes</h2>
    <table data-formType="cliente">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($clientes as $cliente) : ?>
            <tr>
                <td><?= $cliente['id'] ?></td>
                <td><?= $cliente['nome'] ?></td>
                <td><?= $cliente['endereco'] ?></td>
                <td><?= $cliente['telefone'] ?></td>
                <td><?= $cliente['email'] ?></td>
                <td>
                <a  class="edit-btn"  href="editar_cliente.php?id=<?= $cliente['id'] ?>">Editar</a> <!-- Link para editar cliente -->
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
                        <button type="submit" name="delete_cliente">Deletar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Adicionar Cliente</h3>
    <form method="post">
        <input type="text" name="nome" placeholder="Nome">
        <input type="text" name="endereco" placeholder="Endereço">
        <input type="text" name="telefone" placeholder="Telefone">
        <input type="text" name="email" placeholder="Email">
        <button type="submit" name="add_cliente">Adicionar</button>
    </form>

    <!-- Pedidos -->
    <h2>Pedidos</h2>
    <table data-formType="pedido">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Data do Pedido</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($pedidos as $pedido) : ?>
            <tr>
                <td><?= $pedido['id'] ?></td>
                <td><?= $pedido['cliente_id'] ?></td>
                <td><?= $pedido['data_pedido'] ?></td>
                <td><?= $pedido['status'] ?></td>
                <td>
                <a class="edit-btn" href="editar_pedido.php?id=<?= $pedido['id'] ?>">Editar</a> <!-- Link para editar pedido -->
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $pedido['id'] ?>">
                        <button type="submit" name="delete_pedido">Deletar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Adicionar Pedido</h3>
    <form method="post">
        <input type="text" name="cliente_id" placeholder="ID do Cliente">
        <input type="date" name="data_pedido" placeholder="Data do Pedido">
        <input type="text" name="status" placeholder="Status">
        <button type="submit" name="add_pedido">Adicionar</button>
    </form>
    <script src="admin.js"></script>
    <a href="index.html">Sair</a>
</body>
<hr>
</html>
