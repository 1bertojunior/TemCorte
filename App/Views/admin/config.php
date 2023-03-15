
<?php
    $info  =  $this->view->info;

    $website = $info ["website"];

    $website_data = $website['website'];

    $updateConfig = [
        "class" => $website['update']['config'] == "true" ? "success" : "danger",
        "msg" => $website['update']['config'] == "true" ? "Dados atualizados com sucesso!" : "Erro ao atualizar os dados!",
        "icon" => $website['update']['config'] == "true" ? "check" : "exclamation"
    ];

?>

<?php if ($website['update']['config']) { ?>
    <div class="alert alert-<?= $updateConfig['class'] ?>" role="alert">
      <?= $updateConfig['msg'] ?> 
      <i class="fa fa-<?= $updateConfig['icon'] ?>-circle" aria-hidden="true"></i>
    </div>
<?php } ?>


<form method="post" action="/admin/editConfig" id="editConfig">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Configurações</h1>

        <h1 class="mb-0 mb-4 mb-sm-0">
            <input type="submit" value="Salvar" class="btn btn-primary profile-button">
            
            <!-- <a href="#" class="btn btn-success  btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-save"></i>
                </span>
                <span class="text">Salvar</span>

            </a> -->
        </h1>

    </div>


    <div class="row">
        <div class="col-xl-12 col-md-6 ">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold ">Configurações do site</h6>
                </div>

                <div class="card-body table-responsive-sm">
                    <!-- <form> -->
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Nome</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nome" value="<?= $website_data['name'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Descrição</label>
                            <div class="col-sm-10">
                            <input name="description"  type="text" class="form-control" id="description" placeholder="Descrição" value="<?= $website_data['description'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-10">
                            <input name="email" type="text" class="form-control" id="staticEmail" placeholder="email@temcorte.com" value="<?= $website_data['email'] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Telefone</label>
                            <div class="col-sm-10">
                                <input name="phone" type="text" class="form-control" id="staticPhone" placeholder="(00) 00000-0000" value="<?= $website_data['phone_mask'] ?>"  maxlength="15">
                            </div>
                        </div>

                    <!-- </form> -->
                </div>
            
            </div>
        </div>
    </div>

</form>


<script src="/js/admin/check-inputs.js"></script>
