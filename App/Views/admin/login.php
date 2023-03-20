<?php
    print_r($_GET);
?>

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
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

                                    <!-- <?php 
                                        // var_dump($this->info["website"]["login"]);
                                        echo $this->view->login;
                                    ?> -->

                                    <?php if($this->view->login) { ?>
                                        <div class="text-center">
                                            <span class="text text-center text-danger">Ops! E-mail e/ou a senha estão incorretos. Por favor, tente novamente.<br><br><span>
                                        </div>
                                    <?php } ?>
                        

                                    <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Login"></input>
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