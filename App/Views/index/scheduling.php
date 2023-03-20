 <section class="scheduling">
    <h3 class="section-title section-title-form">Agendamento online</h3>
    
    <ul id="progress">
        <li class="active-progress">Serviço</li>
        <li>Data & Horário</li>
        <li>Confirmação</li>
    </ul>

    <div id="alert" class="alert alert-danger fade" role="alert"></div>
               
    <form class="form-scheduling" id="form-scheduling" name="formscheduling"  method="post" action="/scheduling/create_scheduling/">

        <!-- STEP 1 -->
        <div id="step1" class="step active">
            <h2>Serviço</h2>
            <h3>Escolha o tipo de serviço desejado</h3>
            <select name="service" id="service" class="custom-select" required>
                <option>Nenhum serviço disponível!</option>
            </select>

            <div>
                <button class="next botoes" id="next" type="button" onclick="clickNextSteps()">Seguinte</button>
            </div>
        </div>

        <!-- STEP 2 -->
        <div id="step2" class="step">
            <h2>Data e horário</h2>
            
            <h3>Data</h3>
            <input name="date" type="text" id="data" readonly="true" required>
            <!-- <input type="date"  name="date" class="form-control campoData" id="date"  readonly="true" required> -->
            <!-- <input type="text" class="form-control date" id="date" name="date" readonly="true" placeholder="00-00-0000" required> -->
            <!-- <input type="text" class="form-control fade date" id="date1" name="date" readonly="true" placeholder="00-00-0000" required> -->
            <!-- <input type="text" class="form-control fade date" id="date2" name="date" readonly="true" placeholder="00-00-0000" required> -->

            
            <h3>Horário</h3>            
            <select name="time" class="form-control" id="time" required>
                <option value="null">Nenhum horário disponível</option>
            </select>
            
            <div>
               <button class="prev botoes" id="prev" type="button" onclick="clickPrevSteps()">Voltar</button>
                <button class="next botoes" id="next" type="button" onclick="clickNextSteps()">Seguinte</button>
            </div>
        </div>

        <!-- STEP 3 -->
        <div id="step3" class="step">
            <h1>Confirmação</h1>
            <div>
                <button class="prev botoes" id="prev" type="button" onclick="clickPrevSteps()">Voltar</button>
                <button class="send botoes" id="next" type="submit">Enviar</button>            
            </div>
        </div>
                        
    </form>
    
</section>

<!-- jQuery -->
<script src="js/jQuery/jquery-3.6.4.min.js"></script> 

<!-- DATEPICKER -->
<link rel="stylesheet" href="css/datepicker/datepicker.css" />
<script src="js/datepicker/datepicker.js"></script> 
<script src="locale/datepicker/datepicker.pt-BR.min.js" charset="UTF-8"></script>    
<script src="js/datepicker/custom.js"></script> 
<!-- // DATEPICKER -->

<script src="/js/index/scheduling.js"></script>

