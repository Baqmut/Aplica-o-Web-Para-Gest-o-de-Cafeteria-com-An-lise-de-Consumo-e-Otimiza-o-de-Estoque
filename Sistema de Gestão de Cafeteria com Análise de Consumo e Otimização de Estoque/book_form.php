<?php
if(isset($_POST['submit'])){
    // Estabelecer conexão com o banco de dados
    $connection = mysqli_connect('localhost', 'root', '', 'book_db');

    // Verificar se a conexão foi estabelecida com sucesso
    if (!$connection) {
        die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }

    // Obter os dados do formulário
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $location = $_POST['location'];
    $guests = $_POST['guests'];
    $arrivals = $_POST['arrivals'];
    $leaving = $_POST['leaving'];

    // Preparar a consulta SQL para inserir os dados no banco de dados
    $request = "INSERT INTO book_form (name, email, phone, address, location, guests, arrivals, leaving) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $request);

    // Verificar se a consulta foi preparada com sucesso
    if ($stmt) {
        // Vincular parâmetros à consulta preparada
        mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $phone, $address, $location, $guests, $arrivals, $leaving);

        // Executar a consulta
        mysqli_stmt_execute($stmt);

        // Redirecionar para a página de confirmação
        header('Location: confirmation.php');
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    // Fechar a consulta preparada
    mysqli_stmt_close($stmt);

    // Fechar a conexão com o banco de dados
    mysqli_close($connection);
}
?>
