 <section class="scheduling">
    <h3 class="section-title section-title-form">Agendamento online</h3>
    
    <ul id="progress">
        <li class="active-progress">Cidade</li>
        <li>Data & Serviço</li>
        <li>Horário</li>
    </ul>

    <div id="alert" class="alert alert-danger fade" role="alert"></div>
               
    <form class="form-scheduling" id="form-scheduling" name="formscheduling">

        <!-- STEP 1 -->
        <div id="step1" class="step active">
            <h2>Cidade</h2>
            <h3>Escolha a  cidade sede</h3>
            <select name="city" id="city" class="custom-select" required>
                <!-- <option>Selecione uma cidade!</option> -->
            </select>

            <h2 style="display: none;">Profissional</h2>
            <select name="employee" id="employee" class="custom-select" required style="display: none;">                
                <option value="1">Default</option>
            </select>
            
            <div>
                <button class="next botoes" id="next" type="button" onclick="clickNextSteps()">Seguinte</button>
            </div>
        </div>

        <!-- STEP 2 -->
        <div id="step2" class="step">
            <h2>Serviço, data e horário</h2>
            <h3>Serviço</h3>
            <select name="service" id="service" class="custom-select" required>
                <!-- <option>Selecione serviço!</option> -->
            </select>

            <h3>Data</h3>
            <!-- <input type="date"  name="date" class="form-control campoData" id="datepicker-default"  readonly="true" required> -->
            <!-- <input type="text" class="form-control date" id="date" name="date" readonly="true" placeholder="00-00-0000" required> -->
            <input type="text" class="form-control fade date" id="date1" name="date" readonly="true" placeholder="00-00-0000" required>
            <input type="text" class="form-control fade date" id="date2" name="date" readonly="true" placeholder="00-00-0000" required>
            
            <h3>Horário</h3>            
            <select name="hora" class="form-control" id="hour" required>
                <option value="">Nenhum horário disponivel</option>
            </select>
            
            <div>
               <button class="prev botoes" id="prev" type="button" onclick="clickPrevSteps()">Voltar</button>
                <button class="next botoes" id="next" type="button" onclick="clickNextSteps()">Seguinte</button>
            </div>
        </div>

        <!-- STEP 3 -->
        <div id="step3" class="step">
            <h2>Dados pessoais</h2>
            <h3>Nome</h3>
            <input type="text" name="name" placeholder="Seu nome" required>
            <h3>Sobrenome</h3>
            <input type="text" name="surname" placeholder="Sobrenome" required>
            <h3>Telefone</h3>
            <input Placeholder="(00) 00000-0000" type="text" name="phone" class="form-control" id="phone" name="phone"
                    onkeypress="mask(this, mphone);" onblur="mask(this, mphone);"  required>
            <div>
                <button class="prev botoes" id="prev" type="button" onclick="clickPrevSteps()">Voltar</button>
                <button class="send botoes" id="next" type="submit">Enviar</button>
                 <!-- class="btn btn-success btn-lg btn-block" onclick="return valiForm()" -->
            </div>
        </div>
                        
    </form>
    
    <!-- BOTÕES -->
    <div class="form-group">
        <a class="btn btn-primary" href='/searchagendamento' id="pagina">Consultar agendamento <span class="glyphicon glyphicon-map-marker"></span></a>
        <a class="btn btn-danger" href='#' id="pagina">Excluir agendamento<span class="glyphicon glyphicon-map-marker"></span></a>
    </div>

</section>

