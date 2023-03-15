
<?php
    $info  =  $this->view->info;

    $website = $info ["website"];

    $days = $website['days'];
    
    $updateTimeActive = [
        "class" => $website['update']['timeActive'] == "true" ? "success" : "danger",
        "msg" => $website['update']['timeActive'] == "true" ? "Dados atualizados com sucesso!" : "Erro ao atualizar os dados!",
        "icon" => $website['update']['timeActive'] == "true" ? "check" : "exclamation"
    ];

    // $time_active = $website['time_active'];


?>

<!-- MSG - UPDATE -->
<?php if ($website['update']['timeActive']) { ?>
    <div class="alert alert-<?= $updateTimeActive['class'] ?>" role="alert">
      <?= $updateTimeActive['msg'] ?> 
      <i class="fa fa-<?= $updateTimeActive['icon'] ?>-circle" aria-hidden="true"></i>
    </div>
<?php } ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Horários ativos</h1>
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
                            <th>ID</th>
                            <th>Horário</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($days as $day) { ?>
                            <tr>
                                <td><?= $day['id'] ?></td>
                                <td><?= $day['name'] ?></td>
                                <td>
                                    <button onclick="setTimeActiveInModal(<?= $day['id'] ?>)" type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#infoTimeActiveModalLabel">
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
<div class="modal fade" id="infoTimeActiveModalLabel" tabindex="-1" role="dialog" aria-labelledby="infoTimeActiveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="post" action="/admin/editTimeActive">
            <div class="modal-header">
                <h5 class="modal-title">Informações do tempo ativo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                
              <dl class="row">                    
                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9">
                    <span id="id_modal"></span> 
                        <input type="text" name="fk_day" id="id_modal_post" class="form-control" placeholder="0" value="0" style="display: none;">                                                            
                    </dd>
                </dl>

                <dl class="row">                    
                    <dt class="col-sm-3">Nome:</dt>
                    <dd class="col-sm-9">
                        <span id="name_modal"></span> 
                    </dd>
                </dl>

                <dl class="row">                    
                    <dt class="col-sm-2">AM:</dt>
                    <dd class="col-sm-4">                    
                        <select name="start_am" id="start_am_modal" class="form-control">
                            <option value="0">Desativado</option>
                        </select>
                    </dd>
                    <dt class="col-sm-1">até</dt>
                    <dd class="col-sm-4">                    
                        <select name="end_am" id="end_am_modal" class="form-control">
                            <option value="0">Desativado</option>
                        </select>
                    </dd>
                </dl>
                
                <dl class="row">                    
                    <dt class="col-sm-2">PM:</dt>
                    <dd class="col-sm-4">                    
                        <select name="start_pm" id="start_pm_modal" class="form-control">
                            <option value="0">Desativado</option>
                        </select>
                    </dd>
                    <dt class="col-sm-1">até</dt>
                    <dd class="col-sm-4">                    
                        <select name="end_pm" id="end_pm_modal" class="form-control">
                            <option value="0">Desativado</option>
                        </select>
                    </dd>
                </dl>
            
            </div>

            <div class="modal-footer">
                <input type="submit" value="Salvar"  class="btn btn-primary profile-button">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL - ADD DAYS ACTIVE -->
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