
<?php
    $info  =  $this->view->info;

    $website = $info ["website"];

    $holiday_year = $website['holiday_year'];
    $holiday_permanent = $website['holiday_permanent'];
    $holiday_next = $website['holiday_next'];

    $createdHoliday = [
        "class" => $website['created']['holiday'] == "true" ? "success" : "danger",
        "msg" => $website['created']['holiday'] == "true" ? "Feriado criado com sucesso" : "Erro ao criar feriado!",
        "icon" => $website['created']['holiday'] == "true" ? "check" : "exclamation"
      ];

    $updateHoliday = [
        "class" => $website['update']['holiday'] == "true" ? "success" : "danger",
        "msg" => $website['update']['holiday'] == "true" ? "Dados atualizados com sucesso!" : "Erro ao atualizar os dados ",
        "icon" => $website['update']['holiday'] == "true" ? "check" : "exclamation"
      ];

    $removeHoliday = [
        "class" => $website['remove']['holiday'] == "true" ? "success" : "danger",
        "msg" => $website['remove']['holiday'] == "true" ? "Feriado removido com sucesso!" : "Erro ao remover Feriado!",
        "icon" => $website['remove']['holiday'] == "true" ? "check" : "exclamation"
    ];
        
?>

<?php if ($website['created']['holiday']) { ?>
    <div class="alert alert-<?= $createdHoliday['class'] ?>" role="alert">
      <?= $createdHoliday['msg'] ?> 
      <i class="fa fa-<?= $createdHoliday['icon'] ?>-circle" aria-hidden="true"></i>
    </div>
<?php } ?>

<?php if ($website['update']['holiday']) { ?>
    <div class="alert alert-<?= $updateHoliday['class'] ?>" role="alert">
      <?= $updateHoliday['msg'] ?> 
      <i class="fa fa-<?= $updateHoliday['icon'] ?>-circle" aria-hidden="true"></i>
    </div>
<?php } ?>

<?php if ($website['remove']['holiday']) { ?>
    <div class="alert alert-<?= $removeHoliday['class'] ?>" role="alert">
      <?= $removeHoliday['msg'] ?> 
      <i class="fa fa-<?= $removeHoliday['icon'] ?>-circle" aria-hidden="true"></i>
    </div>
<?php } ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Feriados</h1>

    <h1 class="mb-0 mb-4 mb-sm-0">
        <a class="btn btn-success  btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text" data-toggle="modal" data-target="#createHolidayModalLabel">Adicionar</span>
        </a>
    </h1>

</div>

<div class="row">
    <div class="col-xl-12 col-md-6 ">
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold ">Próximos feriados</h6>
            </div>

            <div class="card-body table-responsive-sm">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data</th>
                            <th>Repete</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($holiday_next as $id => $i) { ?>
                            <tr>
                                <td><?= $i['name']?></td>
                                <td><?= date("d/m/Y", strtotime($i['date'])) ?></td>
                                <!-- <td><?= $i['permanent'] ? "Sim" : "Não" ?></td> -->
                                <td>
                                    <div class="btn btn-<?= $i['permanent'] ? "success" : "danger" ?> btn-circle btn-sm">
                                        <i class="fas fa-<?= $i['permanent'] ? "check" : "times" ?>"></i>
                                    </div>
                                </td>
                                <td>            
                                    <button onclick="setHolidayDataInModal(<?= $i['id'] ?>)" type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#infoHolidayModalLabel">
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
                <h6 class="m-0 font-weight-bold ">Feriados permanentes</h6>
            </div>

            <div class="card-body table-responsive-sm">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($holiday_permanent as $id => $i) { ?>
                            <tr>
                                <td><?= $i['name']?></td>
                                <td><?= date("d/m", strtotime($i['date'])) ?></td>
                                <!-- <td><?= $i['permanent'] ?></td> -->
                                <td>
                                    <button onclick="setHolidayDataInModal(<?= $i['id'] ?>)" type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#infoHolidayModalLabel">
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
                <h6 class="m-0 font-weight-bold ">Feriados (Ano)</h6>
            </div>

            <div class="card-body table-responsive-sm">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data</th>
                            <th>Repete</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($holiday_year as $id => $i) { ?>
                            <tr>
                                <td><?= $i['name']?></td>
                                <td><?= date("d/m/Y", strtotime($i['date'])) ?></td>
                                <!-- <td><?= $i['permanent'] ? "Sim" : "Não" ?></td> -->
                                <td>
                                    <div class="btn btn-<?= $i['permanent'] ? "success" : "danger" ?> btn-circle btn-sm">
                                        <i class="fas fa-<?= $i['permanent'] ? "check" : "times" ?>"></i>
                                    </div>
                                </td>
                                <td>
                                    <button onclick="setHolidayDataInModal(<?= $i['id'] ?>)" type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#infoHolidayModalLabel">
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
<!-- MODAL - INFO HOLIDAY -->
<div class="modal fade" id="infoHolidayModalLabel" tabindex="-1" role="dialog" aria-labelledby="infoHolidayModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="post" action="/admin/editHoliday">
            <div class="modal-header">
                <h5 class="modal-title">Informações do feriado</h5>
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
                        <!-- <input type="text" name="id" id="id_modal_post" class="form-control" placeholder="0" value="">                                                             -->
                    </dd>
                </dl>

                <dl class="row">                    
                    <dt class="col-sm-3">Nome:</dt>
                    <dd class="col-sm-9">
                        <input type="text" name="name" id="name_modal" class="form-control" placeholder="Nome" value="Feriado teste">                 
                    </dd>
                </dl>

                <dl class="row">                    
                    <dt class="col-sm-3">Data:</dt>
                    <dd class="col-sm-9">                    
                        <!-- <input type="date" name="name" id="date_modal" class="form-control" placeholder="00/00/00" value="10/03/2023">                  -->
                        <input type="date" name="date" id="date_modal" class="form-control" placeholder="00/00/00" value="2023-03-10">
                    </dd>
                </dl>

                <dl class="row">                    
                    <dt class="col-sm-3">Repete:</dt>
                    <dd class="col-sm-9">                    
                        <input type="checkbox" name="repeat" id="repeat_modal" class="">
                    </dd>
                </dl>
            
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="deleteHoliday()" >Apagar</button>
                <input type="submit" value="Salvar"  class="btn btn-primary profile-button">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL - ADD HOLIDAY -->
<div class="modal fade" id="createHolidayModalLabel" tabindex="-1" role="dialog" aria-labelledby="createHolidayModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="post" action="/admin/createHoliday">
            <div class="modal-header">
                <h5 class="modal-title">Criar feriado</h5>
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
                    <dt class="col-sm-3">Data:</dt>
                    <dd class="col-sm-9">                    
                        <input type="date" name="date" id="date_modal" class="form-control" placeholder="00/00/00">
                    </dd>
                </dl>

                <dl class="row">                    
                    <dt class="col-sm-3">Repete:</dt>
                    <dd class="col-sm-9">                    
                        <input type="checkbox" name="repeat" id="repeat_modal" class="">
                    </dd>
                </dl>
            
            </div>

            <div class="modal-footer">
                <input type="submit" value="Adicionar"  class="btn btn-primary profile-button">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </form>
    </div>
</div>

<script src="/js/admin/main.js"></script>
