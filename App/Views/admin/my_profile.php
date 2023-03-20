
<?php
    $info  =  $this->view->info;

    $header = $info ["header"];
    $website = $info ["website"];

    $user = $website["user"];
    $userAddress = $user['address'];
    $userSocial = $user['social'];

    if( isset($user['fk_level']) ){
      $str = "[!]";

      if($user['fk_level'] == 1) $str = "Administrador";
      else if($user['fk_level'] == 2) $str = "Funcionário";
      else if($user['fk_level'] == 3) $str = "Cliente";

      $user['typeName'] = $str;

      // $user ['typeName'] = isset($user['fk_level']) ? $user['fk_level'] : "[ ! ]";
    }
    

    $updateUser = [
      "class" => $website['update']['user'] == "true" ? "success" : "danger",
      "msg" => $website['update']['user'] == "true" ? "Dados atualizados com sucesso!" : "Erro ao atualizar os dados ",
      "icon" => $website['update']['user'] == "true" ? "check" : "exclamation"
    ];


    // echo "<pre>";
    // print_r($user);
    // echo "</pre>";
    
 ?>

<section >
  <div class="container">
  
  <?php if ($website['update']['user']) { ?>
    <div class="alert alert-<?= $updateUser['class'] ?>" role="alert">
      <?= $updateUser['msg'] ?> 
      <i class="fa fa-<?= $updateUser['icon'] ?>-circle" aria-hidden="true"></i>
    </div>
  <?php } ?>


    <div class="row" >
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="<?= $header['previous'] ? '../' : ''?>img/admin/undraw_profile.svg" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"> <?= $user['name'] ." ". $user['surname'] ?> </h5>
            <!-- <p class="text-muted mb-1">Full Stack Developer</p>
            <p class="text-muted mb-4">Bay Area, San Francisco, CA</p> -->
            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#editProfileModal">Editar perfil <i class="far fa-edit "></i></button>
              <!-- <button type="button" class="btn btn-outline-primary ms-1">Message</button> -->
            </div>
          </div>
        </div>

      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Nome completo</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> <?= (isset($user['name']) ? $user['name'] : "[ ! ]")  ." ". (isset($user['surname']) ? $user['surname'] : "[ ! ]")  ?> </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">E-mail</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> <?= isset($user['email']) ? $user['email'] : "[ ! ]" ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Tipo</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> <?=  isset($user['typeName']) ? $user['typeName'] : "[ ! ]" ?> </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">CPF</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> <?=  isset($user['cpf']) ? $user['cpf'] : "[ ! ]" ?> </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Endereço</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">
                  <?= 
                    (isset($userAddress['street']) ? $userAddress['street'] : "[ ! ]" ) .", ".
                    (isset($userAddress['num']) ? $userAddress['num'] : "[ ! ]" ) ." - ".
                    (isset($userAddress['neighborhood']) ? $userAddress['neighborhood'] : "[ ! ]" ) .", ".
                    (isset($userAddress['cep']) ? $userAddress['cep'] : "[ ! ]" ) .", ".
                    (isset($userAddress['city']['name']) ? $userAddress['city']['name'] : "[ ! ]" ) ." - ".
                    (isset($userAddress['city']['state']['initials']) ? $userAddress['city']['state']['initials'] : "[ ! ]" )

                    // $result = $this->__get("street") .", ". $this->__get("num") .", ". $this->__get("neighborhood") 
                  ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="card mb-6 mb-lg-0 mb-5"> -->
          <!-- <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
              <a href="https://www.wa.me/<?= isset($user['social']['instagram']) ? substr($user['social']['whatsapp'], 1, strlen($user['social']['whatsapp']) -1) : "0000000000000"?>">              
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fab fa-whatsapp fa-lg" style="color: #00aced ;"></i>
                  <p class="mb-0"><?= $user['social']['whatsapp'] ?></p>
                </li>
              </a>
              <a href="https://www.instagram.com/<?= isset($user['social']['instagram']) ? $user['social']['instagram'] : "facebook"?>">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                  <p class="mb-0">@<?= $user['social']['instagram']  ?></p>
                </li>
              </a>
              <a href="https://www.facebook.com/<?= isset($user['social']['facebook']) ? $user['social']['facebook'] : "facebook"?>">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">                  
                    <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                    <p class="mb-0"><?= $user['social']['facebook']  ?></p>                
                </li>
              </a>
            </ul>
          </div>
        </div> -->
  <!-- </div> -->

</section>


<!-- Modal - Edit profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Configurações de perfil</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <form method="post" action="/admin/editInfoUser">
              <div class="modal-body">              
                <div class="row mt-2">
                      <div class="col-md-6">
                        <!-- <input type="text" name="id" value="<?= (isset($user['id']) ? $user['id'] : 0) ?>" disabled> -->
                        <label class="labels">Nome</label>
                        <input type="text" name="name" class="form-control" placeholder="Nome" value="<?= (isset($user['name']) ? $user['name'] : "[ ! ]") ?>">
                      </div>
                      <div class="col-md-6">
                        <label class="labels">Sobrenome</label>
                        <input type="text" name="surname" class="form-control" placeholder="Sobrenome" value="<?= (isset($user['surname']) ? $user['surname'] : "[ ! ]") ?>">
                      </div>
                  </div>

                  <div class="row mt-2">
                      <div class="col-md-12">
                        <label class="labels">E-mail</label>
                        <input type="text" name="email" class="form-control" placeholder="E-mail" value="<?= (isset($user['email']) ? $user['email'] : "[ ! ]") ?>">
                      </div>
                  </div>

                  <div class="row mt-2">
                      <div class="col-md-12">
                        <label class="labels">CPF</label>
                        <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF" value="<?= (isset($user['cpf']) ? $user['cpf'] : "[ ! ]") ?>" onkeyup="cpfCheck(this)" maxlength="14" onkeydown="javascript: fMasc( this, mCPF );">
                        <!-- <span id="cpfResponse"></span> -->
                        <!-- <p><input id="cpf" type="text" onkeyup="cpfCheck(this)" maxlength="18" onkeydown="javascript: fMasc( this, mCPF );"> <span id="cpfResponse"></span></p> -->
                      </div>
                  </div>

                  <div class="row mt-2">
                      <div class="col-md-12">
                        <label class="labels">Rua</label>
                        <input type="text" name="street" class="form-control" placeholder="Rua" value="<?= (isset($userAddress['street']) ? $userAddress['street'] : "[ ! ]" ) ?>">
                      </div>
                  </div>

                  <div class="row mt-2">
                      <div class="col-md-6">
                        <label class="labels">Número</label>
                        <input type="text" name="num" class="form-control" placeholder="Número" value="<?= (isset($userAddress['num']) ? $userAddress['num'] : "[ ! ]" )?>">
                      </div>

                      <div class="col-md-6">
                        <label class="labels">Bairro</label>
                        <input type="text" name="neighborhood" class="form-control" placeholder="Bairro" value="<?=   (isset($userAddress['neighborhood']) ? $userAddress['neighborhood'] : "[ ! ]" ) ?>">
                      </div>
                  </div>  
              
                </div>

              <div class="modal-footer">
                  <div class="mt-5 text-center">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                      <input type="submit" value="Salvar"  class="btn btn-primary profile-button">
                      <!-- <button class="btn btn-primary profile-button" type="button">Salvar</button> -->
                      <!-- <input type="submit" value="Enviar"> -->
                  </div>
              </div>
            </form>

        </div>
    </div>
</div>

<!-- <script src="<?= $header['previous'] ? '../' : ''?>/js/admin/check-inputs.js"></script> -->
<script src="<?= $header['previous'] ? '../' : ''?>/js/check-inputs.js"></script>