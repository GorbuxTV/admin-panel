<?php

//Контроллер UserController

class UserController
{
    //Action для регистрации
	public function actionRegister()
	{
	    $name = '';
	    $surname = '';
	    $patronymic = '';
	    $email = '';
	    $phone = '';
	    $login = '';
	    $password = '';
	    $dateBirth = '';
	    $avatar = '';

	    //Обработка формы регистрации
	    if (isset($_POST['submit-register'])) {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $patronymic = $_POST['patronymic'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $login = $_POST['login'];
            $password = $_POST['password'];
            $dateBirth = $_POST['dateBirth'];
            $avatar = $_FILES;
            $errors = array();

            //Валидация полей
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 3 символов';
            }
            if (!User::checkSurname($surname)) {
                $errors[] = 'Фамилия не должна быть короче 3 символов';
            }
            if (!User::checkPatronymic($patronymic)) {
                $errors[] = 'Отчество не должно быть короче 5 символов';
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Email введен неправильно';
            }
            if (!User::checkPhone($phone)) {
                $errors[] = 'Номер телефона не должен быть короче 10 символов';
            }
            if (!User::checkLogin($login)) {
                $errors[] = 'Логин не должен быть короче 5 символов';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 5 символов';
            }
            if (!User::checkDateBirth($dateBirth)) {
                $errors[] = 'Дата Рождения введена не верно';
            }
            if (!User::checkAvatar($avatar)) {
                $errors[] = 'Изображение не подходит';
            }
            if (!User::checkLoginExists($login)) {
                $errors[] = 'Такой логин уже существует';
            }
            if (!User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже существует';
            }

            //При отсутствии ощибок регистрируем пользователя и переход на страницу с списком пользователей
            if (empty($errors)) {
                User::register($name, $surname, $patronymic, $email, $phone, $login, $password, $dateBirth, $avatar);
                header('Location: /user/catalog');
            }

        }
        //Подключаем вид страницы
		require_once(ROOT . '/views/register.php');
		return true;
	}



    //Action для работы с списком пользователей
	public function actionCatalog()
    {
        //Метод выводит пользователей
        $result = User::listUser();

        //Обработка формы поиска
        if (isset($_POST['submit-search'])) {
            $login = $_POST['search'];
            $errors = array();

            //Валидация формы
            if (!User::checkLogin($login)) {
                $errors[] = 'Логин не должен быть короче 5 символов';
            }
            if (User::checkLoginExists($login)) {
                $errors[] = 'Такой логин не существует';
            }

            //Если ошибок нет выводим конретного пользователя
            if (empty($errors)) {
                $result = User::searchUser($login);
            }
        }
        //Подключаем вид страницы
        require_once(ROOT . '/views/catalog.php');
        return true;
    }



    //Action для работы с редактированием профиля пользователя
    public function actionEdit($id)
    {
        //Проверка валидности полученного параметра
        if (is_numeric($id)) {
            $id = intval($id);

            //Получение старых данных пользователя и размещение их в форме
            $result = User::searchDataUser($id);
            $name = $result['name'];
            $surname = $result['surname'];
            $patronymic = $result['patronymic'];
            $email = $result['email'];
            $phone = $result['phone'];
            $login = $result['login'];
            $dateBirth = $result['dateBirth'];

            //Обработка формы редактирования
            if (isset($_POST['submit-edit'])) {

                //Обработка формы редактирования
                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $patronymic = $_POST['patronymic'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $login = $_POST['login'];
                $password = $_POST['password'];
                $dateBirth = $_POST['dateBirth'];
                $avatar = $_FILES;
                $errors = array();

                //Валидация формы
                if (!User::checkName($name)) {
                    $errors[] = 'Имя не должно быть короче 3 символов';
                }
                if (!User::checkSurname($surname)) {
                    $errors[] = 'Фамилия не должна быть короче 3 символов';
                }
                if (!User::checkPatronymic($patronymic)) {
                    $errors[] = 'Отчество не должно быть короче 5 символов';
                }
                if (!User::checkEmail($email)) {
                    $errors[] = 'Email введен неправильно';
                }
                if (!User::checkPhone($phone)) {
                    $errors[] = 'Номер телефона не должен быть короче 10 символов';
                }
                if (!User::checkLogin($login)) {
                    $errors[] = 'Логин не должен быть короче 5 символов';
                }
                if (!User::checkPassword($password)) {
                    $errors[] = 'Пароль не должен быть короче 5 символов';
                }
                if (!User::checkDateBirth($dateBirth)) {
                    $errors[] = 'Дата Рождения введена не верно';
                }
                if (!User::checkAvatar($avatar)) {
                    $errors[] = 'Изображение не подходит';
                }
                if (!User::checkLoginExists($login) && $login != $result['login']) {
                    $errors[] = 'Такой логин уже существует';
                }
                if (!User::checkEmailExists($email) && $email != $result['email']) {
                    $errors[] = 'Такой email уже существует';
                }

                //При отсутствии ощибок редактируем профиль пользователя и переход на страницу с списком пользователей
                if (empty($errors)) {

                    //Удаление старого изображения
                    $avatarRemove = $result['avatar'];
                    $file = ROOT . '/upload/images/' . $avatarRemove;

                    if (file_exists($file)) {
                        unlink($file);
                    }

                    User::update($id, $name, $surname, $patronymic, $email, $phone, $login, $password, $dateBirth, $avatar);
                    header('Location: /user/catalog');
                }
            }


            //Обработка формы удаления
            if (isset($_POST['submit-remove'])) {

                //Поиск старого изображение пользователя и удаление его
                $avatar = User::searchAvatar($id);
                $file = ROOT . '/upload/images/' . array_shift($avatar);

                if (file_exists($file)) {
                    unlink($file);
                }

                //Удаление пользователя и переход на страницу с списком пользователей
                User::removeUser($id);
                header('Location: /user/catalog');
            }
            //Подключаем вид страницы
            require_once(ROOT . '/views/edit.php');
            return true;
        }
    }
}

?>