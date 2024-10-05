<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.html');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'add') {
        $stmt = $conn->prepare("INSERT INTO menu (name, description, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $_POST['name'], $_POST['description'], $_POST['price']);
        $stmt->execute();
        $stmt->close();
    } elseif ($_POST['action'] == 'edit') {
        $stmt = $conn->prepare("UPDATE menu SET description=?, price=? WHERE name=?");
        $stmt->bind_param("sds", $_POST['description'], $_POST['price'], $_POST['name']);
        $stmt->execute();
        $stmt->close();
    } elseif ($_POST['action'] == 'delete') {
        $stmt = $conn->prepare("DELETE FROM menu WHERE name=?");
        $stmt->bind_param("s", $_POST['name']);
        $stmt->execute();
        $stmt->close();
    }
}

$menu_items = $conn->query("SELECT * FROM menu");

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-container {
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .dashboard-container h2 {
            margin-bottom: 1.5rem;
        }
        .table {
            margin-bottom: 1.5rem;
        }
        .form-container {
            text-align: center;
        }
        .form-container input,
        .form-container button {
            margin-bottom: 0.5rem;
        }
        .form-container button {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container dashboard-container">
        <h2 class="text-center">Dashboard do Admin</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $menu_items->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-name="<?php echo $row['name']; ?>" data-description="<?php echo $row['description']; ?>" data-price="<?php echo $row['price']; ?>"><i class="fas fa-edit"></i></button>
                            <form action="" method="post" style="display: inline;">
                                <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="form-container">
            <h3>Adicionar/Editar Item do Menu</h3>
            <form action="" method="post" class="form-inline justify-content-center">
                <input type="hidden" name="action" value="add" id="menu-action">
                <input type="text" name="name" placeholder="Nome" id="menu-name" class="form-control mr-2" required>
                <input type="text" name="description" placeholder="Descrição" id="menu-description" class="form-control mr-2" required>
                <input type="number" step="0.01" name="price" placeholder="Preço" id="menu-price" class="form-control mr-2" required>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
        <div class="text-center mt-4">
            <a href="index.html" class="btn btn-secondary">Voltar ao Menu Principal</a>
        </div>
    </div>
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('menu-name').value = this.dataset.name;
                document.getElementById('menu-description').value = this.dataset.description;
                document.getElementById('menu-price').value = this.dataset.price;
                document.getElementById('menu-action').value = 'edit';
            });
        });
    </script>
</body>
</html>
