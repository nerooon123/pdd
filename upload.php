<?php
    include "db_conn.php";
    // Обработка загруженного файла
    if(isset($_FILES['photo'])) {
        $question = $_POST['question'];
        $file_name = $_FILES['photo']['name'];
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_type = $_FILES['photo']['type'];
        

        // Чтение данных из файла
        $fp      = fopen($file_tmp, 'r');
        $content = fread($fp, filesize($file_tmp));
        $content = addslashes($content);
        fclose($fp);

        // Подготовка SQL запроса
        $sql = "INSERT INTO question (question, filename, type, content) VALUES ('$question', '$file_name', '$file_type', '$content')";

        // Выполнение SQL запроса
        if ($conn->query($sql) === TRUE) {
            echo "Фото успешно загружено в базу данных";
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    }
?>