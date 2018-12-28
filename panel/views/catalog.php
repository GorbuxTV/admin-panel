<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin-panel</title>
    <link rel="stylesheet" type="text/css" href="/template/assets/bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" type="text/css" href="/template/css/style.css">
</head>
<body>

<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="logo"><a href="#">logo</a></div>
            </div>
            <div class="col-lg-6 offset-lg-4 col-md-6 offset-md-4 col-sm-6 offset-sm-4">
                <nav class="menu">
                    <ul>
                        <li class="menu-item"><a href="/user/catalog">Главная</a></li>
                        <li class="menu-item"><a href="/user/register">Добавить пользователя</a></li>
                        <li class="menu-item"><a href="#">Item3</a></li>
                        <li class="menu-item"><a href="#">Item4</a></li>
                        <li class="menu-item"><a href="#">Item5</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>


<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="content">
                    <h2>Пользователи</h2>

                    <?php if (isset($errors) && is_array($errors)):?>
                        <div class="form-errors">
                            <ul>
                                <?php foreach ($errors as $error):?>
                                    <li><?=$error;?></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    <?php endif;?>

                    <form action="/user/catalog" method="POST" class="form form-search">
                        <input type="search" name="search" placeholder="Введите login...">
                        <input type="submit" name="submit-search" value="Поиск">
                    </form>

                    <?php if (isset($result)):?>
                    <table class="listUser">
                        <tr>
                            <th>Изображение</th>
                            <th>Id</th>
                            <th>Логин</th>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th>Отчество</th>
                            <th>E-mail</th>
                            <th>Телефон</th>
                            <th>Действия</th>
                        </tr>

                        <?php while($row = $result->fetch_assoc()):?>
                        <tr>
                            <td><img src="/upload/images/<?=$row['avatar']?>" alt="avatar-<?=$row['login']?>"></td>
                            <td><?=$row['id']?></td>
                            <td><?=$row['login']?></td>
                            <td><?=$row['name']?></td>
                            <td><?=$row['surname']?></td>
                            <td><?=$row['patronymic']?></td>
                            <td><?=$row['email']?></td>
                            <td><?=$row['phone']?></td>
                            <td><a href="/user/edit/<?=$row['id']?>">Изменить</a></td>
                        </tr>
                        <?php endwhile;?>

                    </table>
                    <?php endif;?>

                </div>
            </div>
        </div>
    </div>
</section>


<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="copyright">
                    <span>©</span>logo
                </div>
            </div>
        </div>
    </div>
</footer>


<!--JS-->
<script type="text/javascript" src="/template/assets/jQuery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/template/assets/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="/template/js/main.js"></script>

</body>
</html>