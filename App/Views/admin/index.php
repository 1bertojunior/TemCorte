<?php

    //Config infos
	$info  =  $this->view->info;
	
	$website = $info ["website"];
	$website_info = $website["info"];
    $user = $website["user"];

    // $service = $website['service'];
    $perService = $website['perService'];

    // echo "<pre>";
    // print_r($website);
    // echo "</pre>";

?>


<!-- <h1 class="h3 mb-4 text-gray-800">Admin</h1> -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row">
    
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text text-uppercase mb-1">
                            Meus agendamento (Hoje)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $website['scheduling']['day'] ?></div>
                    </div>
                    <div class="col-auto">
                        <!-- <i class="fa fa-dollar-sign fa-2x text-gray-300"></i> -->
                        <i class="fa fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text text-uppercase mb-1">
                            Meus agendamento (Mês)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $website['scheduling']['month'] ?></div>
                    </div>
                    <div class="col-auto">
                        <!-- <i class="fa fa-dollar-sign fa-2x text-gray-300"></i> -->
                        <i class="fa fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="row">
    
    <div class="col-xl-12 col-md-6 mb-4">
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold ">Meus serviços mais realizados (%)</h6>
            </div>

            <div class="card-body">

                <?php foreach($perService as $id => $ser) {
                    $perc =  number_format($ser['perc'], 2, '.', ',');
                    $perc = fmod( $perc,1) == 0 ? intval($perc) : number_format($perc, 2, '.', ',') ;
                ?>
                
                    <h4 class="small font-weight-bold"><?= $ser['name'] ?><span class="float-right"><?=  $perc ?>%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $ser['perc'] ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                <?php } ?>

            </div>

            
            <!-- <div class="card-body">
                <h4 class="small font-weight-bold">Corte normal<span class="float-right">20%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Corte degradê <span class="float-right">20%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Corte & Barba<span class="float-right">20%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Tesoura<span class="float-right">20%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Outros<span class="float-right">20%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div> -->
            
        </div>

    </div>
    
</div>