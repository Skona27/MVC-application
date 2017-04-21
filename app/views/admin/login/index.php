<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="robots" content="none">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MVC - Login</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=Config::get('path/public');?>/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!--login modal-->
    <div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h1 class="text-center">Panel administratora</h1>
          </div>
          <div class="modal-body">
              <form class="form col-md-12 center-block" action="" method="post">
                <div class="form-group">
                  <input type="text" class="form-control input-lg" placeholder="Login" name="Username" autocomplete="off" required autofocus>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control input-lg" placeholder="Hasło" name="Password" autocomplete="off" required>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember" id="remember"> Zapamietaj mnie
                  </label>
                </div>
                <div class="form-group">
                  <input type="hidden" name="token" value="<?=Token::generate()?>">
                  <input type="submit" class="btn btn-primary btn-lg btn-block" value="Zaloguj się">
                </div>
              </form>
          </div>
          <div class="modal-footer">
          </div>
      </div>
        </br>
            <?php
            if (Session::exists('danger')) {
              echo '<div class="alert alert-danger">';
                echo  '<strong>Ostrzeżenie! </strong>' . Session::flash('danger');
              echo  '</div>';
            }
            ?>
      </div>
    </div>

  </body>
</html>