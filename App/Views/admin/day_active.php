
<?php
    $info  =  $this->view->info;

    $website = $info ["website"];

    $day_active = $website['day_active'];
    
    $updateDayActive = [
        "class" => $website['update']['dayActive'] == "true" ? "success" : "danger",
        "msg" => $website['update']['dayActive'] == "true" ? "Dados atualizados com sucesso!" : "Erro ao atualizar os dados!",
        "icon" => $website['update']['dayActive'] == "true" ? "check" : "exclamation"
    ];

    
?>

<?php if ($website['update']['dayActive']) { ?>
    <div class="alert alert-<?= $updateDayActive['class'] ?>" role="alert">
      <?= $updateDayActive['msg'] ?> 
      <i class="fa fa-<?= $updateDayActive['icon'] ?>-circle" aria-hidden="true"></i>
    </div>
<?php } ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dias ativos</h1>
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
                            <th>Dia</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($day_active as $id => $day) { ?>
                            <tr>
                                <td><?= $day['name'] ?></td>
                                <td>
                                    <div class="btn btn-<?= $day['status'] ? "success" : "danger" ?> btn-circle btn-sm">
                                        <i class="fas fa-<?= $day['status'] ? "check" : "times" ?>"></i>
                                    </div>
                                </td>
                                <td>
                                    <button onclick="setDaysActiveDataInModal(<?= ($id) ?>)" type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#infoDaysAciveModalLabel">
                                        <i class="fas fa-info"></i>
                                    </button>
                                </td>

                                <!-- <td><?= $day['name'] ?></td>
                                <td>
                                    <div class="btn btn-<?= $day['active'] ? "success" : "danger" ?> btn-circle btn-sm">
                                        <i class="fas fa-<?= $day['active'] ? "check" : "times" ?>"></i>
                                    </div>
                                </td>
                                <td>
                                    <button onclick="setDaysActiveDataInModal(<?= ($id) ?>)" type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#infoDaysAciveModalLabel">
                                        <i class="fas fa-info"></i>
                                    </button>
                                </td> -->
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
<div class="modal fade" id="infoDaysAciveModalLabel" tabindex="-1" role="dialog" aria-labelledby="infoDaysAciveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="post" action="/admin/editDaysActive">
            <div class="modal-header">
                <h5 class="modal-title">Informações do dias ativos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                
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
                        <span id="name_modal"></span> 
                        <!-- <input type="text" name="name" id="name_modal_post" class="form-control" placeholder="0" value="0" style="display: none;">                                                             -->
                        <!-- <input type="text" name="name" id="name_modal_post" class="form-control" placeholder="0" value="0">                                                             -->

                    </dd>
                </dl>

                <dl class="row">                    
                    <dt class="col-sm-3">Status:</dt>
                    <dd class="col-sm-9">                    
                        <input type="checkbox" name="status" id="status_modal">
                    </dd>
                </dl>
            
            </div>

            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-danger" onclick="deleteDaysActive()" >Apagar</button> -->
                <input type="submit" value="Salvar"  class="btn btn-primary profile-button">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL - ADD DAYS ACTIVE -->
<div class="modal fade" id="createDaysActiveModalLabel" tabindex="-1" role="dialog" aria-labelledby="createDaysActiveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="post" action="/admin/createService">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar dias ativo</h5>
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
