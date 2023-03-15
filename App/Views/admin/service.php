
<?php
    $info  =  $this->view->info;

    $website = $info ["website"];

    $service_all = $website['service_all'];
    
    $createdService = [
        "class" => $website['created']['service'] == "true" ? "success" : "danger",
        "msg" => $website['created']['service'] == "true" ? "Serviço criado com sucesso" : "Erro ao criar serviço!",
        "icon" => $website['created']['service'] == "true" ? "check" : "exclamation"
      ];

    $updateService = [
        "class" => $website['update']['service'] == "true" ? "success" : "danger",
        "msg" => $website['update']['service'] == "true" ? "Dados atualizados com sucesso!" : "Erro ao atualizar os dados ",
        "icon" => $website['update']['service'] == "true" ? "check" : "exclamation"
    ];

    $removeService = [
        "class" => $website['remove']['service'] == "true" ? "success" : "danger",
        "msg" => $website['remove']['service'] == "true" ? "Serviço removido com sucesso!" : "Erro ao remover serviço!",
        "icon" => $website['remove']['service'] == "true" ? "check" : "exclamation"
    ];

    
 ?>

<?php if ($website['created']['service']) { ?>
    <div class="alert alert-<?= $createdService['class'] ?>" role="alert">
      <?= $createdService['msg'] ?> 
      <i class="fa fa-<?= $createdService['icon'] ?>-circle" aria-hidden="true"></i>
    </div>
  <?php } ?>

<?php if ($website['update']['service']) { ?>
    <div class="alert alert-<?= $updateService['class'] ?>" role="alert">
      <?= $updateService['msg'] ?> 
      <i class="fa fa-<?= $updateService['icon'] ?>-circle" aria-hidden="true"></i>
    </div>
<?php } ?>

<?php if ($website['remove']['service']) { ?>
    <div class="alert alert-<?= $removeService['class'] ?>" role="alert">
      <?= $removeService['msg'] ?> 
      <i class="fa fa-<?= $removeService['icon'] ?>-circle" aria-hidden="true"></i>
    </div>
<?php } ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Serviços</h1>

    <h1 class="mb-0 mb-4 mb-sm-0">
        <a href="#" class="btn btn-success  btn-icon-split" data-toggle="modal" data-target="#createServiceModalLabel">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Adicionar</span>
        </a>
    </h1>

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
                            <th>Nome</th>
                            <th>Duração</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($service_all as $id => $i) { ?>
                            <tr>
                                <td><?= $i['name']?></td>
                                <td><?= $i['duration']?></td>
                                <td>
                                    <button onclick="setServiceDataInModal(<?= $i['id'] ?>)" type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#infoServiceModalLabel">
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
<!-- MODAL - INFO SERVICE -->
<div class="modal fade" id="infoServiceModalLabel" tabindex="-1" role="dialog" aria-labelledby="infoServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="post" action="/admin/editService">
            <div class="modal-header">
                <h5 class="modal-title">Informações do serviço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body"  method="post" action="/admin/editInfoUser">
                
                <dl class="row">                    
                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9">
                    <span id="id_modal"></span> 
                        <input type="text" name="id" id="id_modal_post" class="form-control" placeholder="0" value="0" style="display: none;">                                                            
                    </dd>
                </dl>

                <dl class="row">                    
                    <dt class="col-sm-3">Nome:</dt>
                    <dd class="col-sm-9">
                        <input type="text" name="name" id="name_modal" class="form-control" placeholder="Nome">                 
                    </dd>
                </dl>

                <dl class="row">                    
                    <dt class="col-sm-3">Duração:</dt>
                    <dd class="col-sm-9">                    
                        <!-- <input type="text" name="duration" id="duration_modal" class="form-control" placeholder="00:00:00" value="00:00:00"> -->
                        <select name="duration" id="duration_modal" class="form-control">
                            <!-- <option value="00:00:00">00:00:00</option> -->
                            <option id="00:30:00" value="00:30:00">00:30:00</option>
                            <option id="01:00:00" value="01:00:00">01:00:00</option>
                        </select>
                    </dd>
                </dl>
            
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="deleteService()" >Apagar</button>
                <input type="submit" value="Salvar"  class="btn btn-primary profile-button">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL - ADD SERVICE -->
<div class="modal fade" id="createServiceModalLabel" tabindex="-1" role="dialog" aria-labelledby="createServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="post" action="/admin/createService">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar serviço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">                
                <dl class="row">                    
                    <dt class="col-sm-3">Nome:</dt>
                    <dd class="col-sm-9">
                        <input type="text" name="name" id="name_modal" class="form-control" placeholder="Nome">                 
                    </dd>
                </dl>

                <dl class="row">                    
                    <dt class="col-sm-3">Duração:</dt>
                    <dd class="col-sm-9">                    
                        <select name="duration" id="duration_modal" class="form-control">
                            <option id="00:30:00" value="00:30:00">00:30:00</option>
                            <option id="01:00:00" value="01:00:00">01:00:00</option>
                        </select>
                    </dd>
                </dl>
            
            </div>

            <div class="modal-footer">
                <input type="submit" value="Adicionar" class="btn btn-primary profile-button">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </form>
    </div>
</div>

<script src="/js/admin/main.js"></script>