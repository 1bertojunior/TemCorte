<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center" style="margin-top:15%;">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Bem vindo de volta!</h1>
                                </div>
                                <form class="login-form user" action="/auth" method="POST">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control form-control-user"
                                            id="email" aria-describedby="emailHelp"
                                            placeholder="E-mail">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control form-control-user"
                                            id="passwork" placeholder="Senha">
                                    </div>                                                                    

                                    <?php 
                                        // echo "<pre>";
                                        // print_r($_SESSION);
                                        // echo "</pre>";
                                        // echo "login: " . $_SESSION['login'];
                                        // echo "<pre>";
                                        // print_r($_SESSION);
                                    ?>

                                    <!-- <?php if($_SESSION['login']) { ?>
                                        <div class="text-center">
                                            <span class="text text-center text-danger">E-mail ou senha invalido(s)!<br><br><span>
                                        </div>
                                    <?php } ?> -->
                                   
                                    <!-- <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div> -->

                                    <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Login"></input>
                                    <!-- <a href="index.html" class="btn btn-primary btn-user btn-block">Login</a> -->
                                    <!-- <input type="submit" name="submit" class="btn btn-info btn-lg btn-block" value="Login"> -->                                   
                                </form>

                                <!-- <hr> -->
                                <div class="text-center">
                                    <!-- <a class="small" href="forgot-password.html">Esqueceu a senha?</a> -->
                                </div>
                                <div class="text-center">
                                    <a class="small" href="/register">Criar uma conta!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>