<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Главная</title>
	<link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
     <header>
        <nav>
            <ul>
                <li><p>Привет, <?php echo $_SESSION['name']; ?></p></li>

                <li><a href="logout.php">Выйти</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2 class="h2_header">ГИБДД России</h2>
            <div class="img_container">
                <img src="pdd_police.jpg" alt="полиция">
            </div>
            <div class="pdd_form">
                <form method="post" enctype="multipart/form-data">
                    <label>Опишите что не так сделал нарушитель и прикрепите фото</label><br>
                    <input type="text" name="question" placeholder="Что не так сделал нарушитель, опишите проблему"><br>
                    <input type="file" name="photo">
                    <button type="submit" name="submit1">Отправить</button>
                </form>
                <?php
                    include "db_conn.php";
                    // Обработка загруженного файла
                    if(isset($_POST['submit1'])) {
                        $question = $_POST['question'];
                        $file_name = $_FILES['photo']['name'];
                        $file_tmp = $_FILES['photo']['tmp_name'];
                        $file_type = $_FILES['photo']['type'];
                        $id_user = $_SESSION['id'];
                
                        // Чтение данных из файла
                        $fp      = fopen($file_tmp, 'r');
                        $content = fread($fp, filesize($file_tmp));
                        $content = addslashes($content);
                        fclose($fp);
                
                        // Подготовка SQL запроса
                        $sql = "INSERT INTO question (question, filename, type, content, id_user) VALUES ('$question', '$file_name', '$file_type', '$content', '$id_user')";
                
                        // Выполнение SQL запроса
                        if ($conn->query($sql) === TRUE) {
                            
                        } else {
                            echo "Ошибка: " . $sql . "<br>" . $conn->error;
                        }
                    }
                ?>
            </div>
            
                <?php
                    include "db_conn.php";
                    // Запрос на выбор всех фотографий
                    $sql = "SELECT * FROM question WHERE id_user = '$_SESSION[id]'";
                    $result = $conn->query($sql);

                    echo "<div class='cont' style='display: flex; width: 250px;'>";
                    if ($result->num_rows > 0) {
                        // Вывод каждой фотографии
                        while($row = $result->fetch_assoc()) {
                            $id = $row["id"];
                            $type = $row["type"];
                            $content = base64_encode($row["content"]); // Преобразование бинарных данных в строку base64
                            
                            echo "<div class='block' style='border: 3px solid white; margin: 10px;'>";
                            echo "<h2 style='padding: 5px;'>" . $row["question"] . "</h2>";
                            echo "<img style='width: 250px; height: 200px;' src='data:image/$type;base64,$content' alt='Фотография id=$id'><br>";
                            if($row["status"] == 1) {
                                echo "<h2 style='padding: 5px;'>Статус: Решен</h2>";
                            }
                            else {
                                echo "<h2 style='padding: 5px;'>Статус: Не решен</h2>";
                            }
                            echo "</div>";
                        }
                    } else {
                        echo "Ошибка";
                    }
                    echo "</div>";  
                ?>
        </section>
    </main>
    <footer>
        &copy; 2021 Нарушениям. Нет ПДД
    </footer>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
?>