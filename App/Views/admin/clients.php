
<?php
    $info  =  $this->view->info;

    $website = $info ["website"];

    $clients = $website['clients'];

 ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Clientes</h1>

    <!-- <h1 class="mb-0 mb-4 mb-sm-0">
        <a href="#" class="btn btn-success  btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Adicionar</span>
        </a>
    </h1> -->

</div>


<div class="row">
    <div class="col-xl-12 col-md-6 ">
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- <h6 class="m-0 font-weight-bold ">Todos os servicos</h6> -->
            </div>

            <div class="card-body table-responsive-sm">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    
                    <thead>
                        <tr>
                            <th>Nome completo</th>
                            <th>E-mail</th>
                            <th>CPF</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($clients as $id => $i) { ?>
                            <tr>
                                <td><?= $i['fullname']?></td>
                                <td><?= $i['email']?></td>
                                <td><?= $i['cpf']?></td>
                                <td>
                                    <button onclick="setClientDataInModal(<?= ($id) ?>)" type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#infoClientModalLabel">
                                        <i class="fas fa-info"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        
        </div>
    </div>
</div>


<!-- MODAL -->
<!-- MODAL - DAYS ACTIVE -->
<div class="modal fade" id="infoClientModalLabel" tabindex="-1" role="dialog" aria-labelledby="infoClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informações do cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
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
