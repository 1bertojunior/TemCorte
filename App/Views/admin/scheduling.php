
<?php
    $info  =  $this->view->info;

    $website = $info ["website"];

    $scheduling_day = $website['scheduling_day'];
    $scheduling_7days = $website['scheduling_7days'];
    $scheduling_month = $website['scheduling_month'];

    $removeSche = [
        "class" => $website['remove']['scheduling'] == "true" ? "success" : "danger",
        "msg" => $website['remove']['scheduling'] == "true" ? "Agendamento removido com sucesso!" : "Erro ao remover agendamento",
        "icon" => $website['remove']['scheduling'] == "true" ? "check" : "exclamation"
    ];



    
 ?>


<?php if ($website['remove']['scheduling']) { ?>
    <div class="alert alert-<?= $removeSche['class'] ?>" role="alert">
      <?= $removeSche['msg'] ?> 
      <i class="fa fa-<?= $removeSche['icon'] ?>-circle" aria-hidden="true"></i>
    </div>
<?php } ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Agendamentos</h1>

    <h1 class="mb-0 mb-4 mb-sm-0">
        <a href="#" class="btn btn-success  btn-icon-split">
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
                <h6 class="m-0 font-weight-bold ">Próximos agendamento (hoje)</h6>
            </div>

            <div class="card-body table-responsive-sm">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Serviço</th>
                            <th>I/F</th>                            
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($scheduling_day as $id => $nexSche) { ?>
                            <tr>
                                <td><?= $id ?></td>
                                <td><?= $nexSche['service']['name'] ?></td>
                                <td><?= $nexSche['time_start'] ?> ~ <?= $nexSche['time_end'] ?></td>
                                <!-- <td><?= $nexSche['date'] ?></td> -->
                                <td>
                                    <!-- <a href="#" class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-check"></i>
                                    </a> -->
                                    <!-- <a href="#" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a> -->
                                    <button onclick="setSchedulingDataInModal(<?= $id ?>)" type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#infoSchedulingModal">
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


<div class="row">
    <div class="col-xl-12 col-md-6 ">
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold ">Agendamentos (7 dias)</h6>
            </div>

            <div class="card-body table-responsive-sm">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Serviço</th>
                            <th>I/F</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($scheduling_7days as $id => $i) { ?>
                            <tr>
                                <td><?= $id ?></td>
                                <td><?= $i['service']['name'] ?></td>
                                <td><?= $i['time_start'] ?> ~ <?= $i['time_end'] ?></td>
                                <td><?= $i['date'] ?></td>
                                <td>
                                    <!-- <a href="#" class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-check"></i>
                                    </a> -->
                                    <!-- <a href="#" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a> -->
                                    <button onclick="setSchedulingDataInModal(<?= $id ?>)" type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#infoSchedulingModal">
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

<div class="row">
    <div class="col-xl-12 col-md-6 ">
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold ">Agendamentos (Mês)</h6>
            </div>

            <div class="card-body table-responsive-sm">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Serviço</th>
                            <th>I/F</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php foreach($scheduling_month as $id => $i) { ?>
                            <tr>
                                <td><?= $id ?></td>
                                <td><?= $i['service']['name'] ?></td>
                                <td><?= $i['time_start'] ?> ~ <?= $i['time_end'] ?></td>
                                <td><?= $i['date'] ?></td>
                                <td>
                                    <!-- <a href="#" class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-check"></i>
                                    </a> -->
                                    <!-- <a href="#" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a> -->
                                    <button onclick="setSchedulingDataInModal(<?= $id ?>)" type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#infoSchedulingModal">
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


<!-- MODAL - INFO SCHEDULING -->
<div class="modal fade" id="infoSchedulingModal" tabindex="-1" role="dialog" aria-labelledby="infoSchedulingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Informações do agendamento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="modal-body">
            
            <dl class="row">                    
                <dt class="col-sm-3">ID:</dt>
                <dd class="col-sm-9">
                    <span id="id_modal"> </span>                    
                </dd>
            </dl>

            <dl class="row">                    
                <dt class="col-sm-3">Serviço:</dt>
                <dd class="col-sm-9">
                    <span id="service_modal"> </span>                    
                </dd>
            </dl>

            <dl class="row">                    
                <dt class="col-sm-3">Início</dt>
                <dd class="col-sm-9">
                    <span id="start_modal"> </span>                    
                </dd>
            </dl>

            <dl class="row">                    
                <dt class="col-sm-3">Fim</dt>
                <dd class="col-sm-9">
                    <span id="end_modal"> </span>                    
                </dd>
            </dl>

            <dl class="row">                    
                <dt class="col-sm-3">Data:</dt>
                <dd class="col-sm-9">
                    <span id="date_modal"> </span>                    
                </dd>
            </dl>
          
        </div>

        <div class="modal-footer">
            <!-- <a href="/deleteScheduling" type="button" class="btn btn-danger">Apagar</a> -->
            <button type="button" id="deleteScheduling" class="btn btn-danger">Apagar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
        </div>
  </div>
</div>

<script src="/js/admin/main.js"></script>
