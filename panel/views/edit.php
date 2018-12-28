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
						<h2>Редактирования профиля пользователя:</h2>

                        <?php if (isset($errors) && is_array($errors)):?>
                            <div class="form-errors">
                                <ul>
                                    <?php foreach ($errors as $error):?>
                                        <li><?=$error;?></li>
                                    <?php endforeach;?>
                                </ul>
                             </div>
                        <?php endif;?>


						<form action="/user/edit/<?=$id;?>" method="POST" class="form form-edit" enctype="multipart/form-data">
							<div class="form-group">
								<p>Введите имя:</p>
								<input type="text" name="name" value="<?=$name;?>">
							</div>
							<div class="form-group">
								<p>Введите фамилию:</p>
								<input type="text" name="surname" value="<?=$surname;?>">
							</div>
							<div class="form-group">
								<p>Введите отчество:</p>
								<input type="text" name="patronymic" value="<?=$patronymic;?>">
							</div>
							<div class="form-group">
								<p>Введите e-mail:</p>
								<input type="email" name="email" value="<?=$email;?>">
							</div>
							<div class="form-group">
								<p>Введите телефон:</p>
								<input type="text" name="phone" value="<?=$phone;?>">
							</div>
                            <div class="form-group">
                                <p>Введите логин:</p>
                                <input type="text" name="login" value="<?=$login;?>">
                            </div>
							<div class="form-group">
								<p>Введите пароль:</p>
								<input type="password" name="password">
							</div>
                            <div class="form-group">
                                <p>Введите дату рождения:</p>
                                <input type="date" name="dateBirth" value="<?=$dateBirth;?>">
                            </div>
							<div class="form-group">
								<p>Загрузите фотографию:</p>
								<input type="file" name="avatar"">
							</div>
							<input type="submit" name="submit-edit" value="Изменить">
                            <input type="submit" name="submit-remove" value="Удалить пользователя">
						</form>
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