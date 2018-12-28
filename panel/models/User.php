<?php

//Модель User

class User
{

    //Проверка валидности имени
    public static function checkName($name)
    {
        if (strlen(trim($name)) >= 3) {
            return true;
        }
        return false;
    }

    //Проверка валидности фамилии
    public static function checkSurname($surname)
    {
        if (strlen(trim($surname)) >= 3) {
            return true;
        }
        return false;
    }

    //Проверка валидности отчества
    public static function checkPatronymic($patronymic)
    {
        if (strlen(trim($patronymic)) >= 5) {
            return true;
        }
        return false;
    }

    //Проверка валидности email
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    //Проверка валидности телефона
    public static function checkPhone($phone)
    {
        if (strlen(trim($phone)) >= 10) {
            return true;
        }
        return false;
    }

    //Проверка валидности логина
    public static function checkLogin($login)
    {
        if (strlen(trim($login)) >= 5) {
            return true;
        }
        return false;
    }

    //Проверка валидности пароля
    public static function checkPassword($password)
    {
        if (strlen(trim($password)) >= 5) {
            return true;
        }
        return false;
    }

    //Проверка валидности Даты Рождения
    public static function checkDateBirth($dateBirth)
    {
        if ($dateBirth != "") {
            $dateSegments = explode('-', $dateBirth);
            if (checkdate($dateSegments[1], $dateSegments[2], $dateSegments[0])) {
                return true;
            }
        }
        return false;
    }

    //Проверка валидности изображения
    public static function checkAvatar($avatar)
    {
        if (!empty($avatar['avatar']['name'])) {
            $type = getimagesize($avatar['avatar']['tmp_name']);
            if ($type && ($type['mime'] == 'image/png' || $type['mime'] == 'image/jpg' || $type['mime'] == 'image/jpeg')) {
                if ($avatar['avatar']['size'] < 1024 * 1000) {
                    return true;
                }
            }
        }
        return false;
    }

    //Проверка на уникальность логина
    public static function checkLoginExists($login){
        $mysqli = Db::getConnection();
        $sql = "SELECT COUNT(*) FROM `users` WHERE `login` = '$login'";
        $result = $mysqli->query($sql);
        $row = $result->fetch_row();
        $mysqli->close();

        if (array_shift($row) != 0) {
            return false;
        }
        return true;
    }

    //Проверка на уникальность email
    public static function checkEmailExists($email){
        $mysqli = Db::getConnection();
        $sql = "SELECT COUNT(*) FROM `users` WHERE `email` = '$email'";
        $result = $mysqli->query($sql);
        $row = $result->fetch_row();
        $mysqli->close();

        if (array_shift($row) != 0) {
            return false;
        }
        return true;
    }

    //Получение списка из 15 пользователей
    public static function listUser()
    {
        $mysqli = Db::getConnection();
        $sql = "SELECT `id`, `login`, `name`, `surname`, `patronymic`, `email`, `phone`, `dateBirth`, `avatar` FROM `users` ORDER BY `id` DESC LIMIT 15";
        $result = $mysqli->query($sql);
        $mysqli->close();

        return $result;
    }

    //Получение данных пользователя по логину
    public static function searchUser($login)
    {
        $mysqli = Db::getConnection();
        $sql = "SELECT `id`, `login`, `name`, `surname`, `patronymic`, `email`, `phone`, `dateBirth`, `avatar` FROM `users` WHERE `login` = '$login'";
        $result = $mysqli->query($sql);
        $mysqli->close();

        return $result;
    }

    //Получение данных пользователя по id
    public static function searchDataUser($id)
    {
        $mysqli = Db::getConnection();
        $sql = "SELECT `login`, `name`, `surname`, `patronymic`, `email`, `phone`, `dateBirth`, `avatar` FROM `users` WHERE `id` = '$id'";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        $mysqli->close();

        return $row;
    }

    //Получение данных о фотографии по id
    public static function searchAvatar($id)
    {
        $mysqli = Db::getConnection();
        $sql = "SELECT `avatar` FROM `users` WHERE `id` = '$id'";
        $result = $mysqli->query($sql);
        $row = $result->fetch_row();
        $mysqli->close();

        return $row;
    }

    //Обработка данных и регистрация пользователя
    public static function register($name, $surname, $patronymic, $email, $phone, $login, $password, $dateBirth, $avatar)
    {
        $mysqli = Db::getConnection();
        $name = $mysqli->real_escape_string(htmlspecialchars($name));
        $surname = $mysqli->real_escape_string(htmlspecialchars($surname));
        $patronymic = $mysqli->real_escape_string(htmlspecialchars($patronymic));
        $email = $mysqli->real_escape_string(htmlspecialchars($email));
        $phone = $mysqli->real_escape_string(htmlspecialchars($phone));
        $login = $mysqli->real_escape_string(htmlspecialchars($login));
        $password = $mysqli->real_escape_string(password_hash(htmlspecialchars($password), PASSWORD_DEFAULT));
        $dateBirth = $mysqli->real_escape_string(htmlspecialchars($dateBirth));
        $avatarName = $mysqli->real_escape_string(htmlspecialchars($login.$avatar['avatar']['name']));

        move_uploaded_file($avatar['avatar']['tmp_name'], ROOT . '/upload/images/'.$avatarName);

        $sql = "INSERT INTO `users`(`login`, `password`, `name`, `surname`, `patronymic`, `email`, `phone`, `dateBirth`, `avatar`) VALUES ('$login', '$password', '$name', '$surname', '$patronymic', '$email', '$phone', '$dateBirth', '$avatarName')";
        $result = $mysqli->query($sql);
        $mysqli->close();

        return $result;
    }

    //Обработка данных и редактирование пользователя
    public static function update($id, $name, $surname, $patronymic, $email, $phone, $login, $password, $dateBirth, $avatar)
    {
        $mysqli = Db::getConnection();
        $name = $mysqli->real_escape_string(htmlspecialchars($name));
        $surname = $mysqli->real_escape_string(htmlspecialchars($surname));
        $patronymic = $mysqli->real_escape_string(htmlspecialchars($patronymic));
        $email = $mysqli->real_escape_string(htmlspecialchars($email));
        $phone = $mysqli->real_escape_string(htmlspecialchars($phone));
        $login = $mysqli->real_escape_string(htmlspecialchars($login));
        $password = $mysqli->real_escape_string(password_hash(htmlspecialchars($password), PASSWORD_DEFAULT));
        $dateBirth = $mysqli->real_escape_string(htmlspecialchars($dateBirth));
        $avatarName = $mysqli->real_escape_string(htmlspecialchars($login.$avatar['avatar']['name']));

        move_uploaded_file($avatar['avatar']['tmp_name'], ROOT . '/upload/images/'.$avatarName);

        $sql = "UPDATE `users` SET `name` = '$name', `surname` = '$surname', `patronymic` = '$patronymic', `email` = '$email', `phone` = '$phone', `login` = '$login', `password` = '$password', `dateBirth` = '$dateBirth', `avatar` = '$avatarName' WHERE `id` = '$id'";
        $result = $mysqli->query($sql);
        $mysqli->close();

        return $result;
    }

    //Удаление пользователя
    public static function removeUser($id)
    {
        $mysqli = Db::getConnection();
        $sql = "DELETE FROM `users`  WHERE `id` = '$id'";
        $result = $mysqli->query($sql);
        $mysqli->close();

        return $result;
    }
}

?>