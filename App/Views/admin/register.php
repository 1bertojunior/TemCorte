<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Crie a sua conta aqui!</h1>
                            </div>

                            <form class="user" action="/checkRegister" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="name" id="name" class="form-control form-control-user" id="name"
                                            placeholder="Primeiro nome">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="surname" id="surname" class="form-control form-control-user" id="surname"
                                            placeholder="Sobrenome">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- <input type="text" name="cpf" id="cpf" class="form-control form-control-user" id="cpf"
                                        placeholder="CPF"> -->
                                    <input type="text" id="cpf" name="cpf" class="form-control form-control-user" placeholder="CPF"  onkeyup="cpfCheck(this)" maxlength="14" onkeydown="javascript: fMasc( this, mCPF );">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control form-control-user" id="email"
                                        placeholder="E-mail">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control form-control-user" id="cpf"
                                        placeholder="Senha">
                                </div>
                                

                                <?php if($this->view->erroRegistration) { ?>
                                    <?php
                                        $erro = $this->view->erroRegistration;
                                        $aler = "null";

                                        switch($erro){
                                            case "erro":
                                                $aler = "*Falha ao criar sua conta. Tente novamente mais tarde.";
                                                break;
                                            case "erro1":
                                                $aler = "Alguns campos estão incorretos ou faltando. Por favor, preencha corretamente.";
                                                break;
                                            case "erro2":
                                                $aler = "Este e-mail já está em uso. Por favor, escolha outro ou faça login.";
                                                break;
                                            default:
                                                $aler = "Error not undefined!";
                                        }
                                        
                                    ?>
                                    <small class="text-danger"><?= $aler ?></small>
                                <?php } ?> 
                                
                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Criar conta"></input>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="">Esqueceu a senha?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="/login">Já tem uma conta? Conecte-se!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



<script src="/js/check-inputs.js"></script>
