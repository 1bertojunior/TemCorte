// GLOBAL
var daysActiveOfWeekByCityAndEmployee = [], days = [0,1,2,3,4,5,6], daysOff = [], elDatePicker = dateSelected = undefined;

// STEPS
const next = document.querySelector('.next'); //next firts
const prev = document.querySelector('.prev'); //prev Sec 
var index = 0, indexAux =1, elCurrent, elPrev, elNext, progress;

var elements = [
    "step1",
    "step2",
    "step3"
];

// Pegar elemento 
const getElementByQuerySelector = element => document.querySelector(element);
// Diferença entre dois arrays
const arrayDiff = (r1 = [], r2 = []) => r3 = r1.filter(a => !r2.includes(a)); // Diferença entre dois arrays
// Checar data
const isDate = (date) => date instanceof Date && !isNaN(date);
// Esperar todo documento ser carregado
window.onload = function () {
    innitScheduling();
}

// Iniciar scheduling
async function innitScheduling(){
    console.log("Page loaded!");

    var elDatePicker = getElementByQuerySelector('#date' + city.value);

    var cities = await getCity();
    if(cities) showCity(cities);
}

// Prev
function clickPrevSteps(){
    progress = document.querySelector('#progress'); //progress
    elCurrent = getElementByQuerySelector("#"+elements[index])
    elPrev = elCurrent.previousElementSibling; //pegando o proximo elemento ?? null
    progress = progress.children[index];
    progress.classList.remove("active-progress")
    elCurrent.classList.remove("active"); // hide
    elPrev.classList.add("active"); //show

    if(index == 1){
        elDatePicker = getElementByQuerySelector('#date' + city.value);
        elDatePicker.classList.add("fade");
    }

    index--;
}

// Next
async function clickNextSteps(){
    if(await checkForm(index)){
        progress = document.querySelector('#progress'); //progress
        elCurrent = getElementByQuerySelector("#"+elements[index])
        elNext = elCurrent.nextElementSibling; //pegando o proximo elemento ?? null
        
        progress = progress.children[index+1]; //progress
        progress.classList.add("active-progress") //progress

        elCurrent.classList.remove("active"); // hide
        elNext.classList.add("active"); //show

        if(index == 0){
            elDatePicker = getElementByQuerySelector('#date' + city.value);
            elDatePicker.classList.remove("fade");
        }

        index++;
    }   
}

// Adicionar option em select 
function addOptionInSelect(div, option) {
    var select = document.getElementById(div);
    select.add(option);
}

// Mostrar cidade
function showCity(data){
    Object.keys(data).forEach( item => {
        var option = new Option(
            text = data[item]['name'] + " - " + data[item]['state_initials'],
            value = item
        );

        addOptionInSelect("city", option);
    })
}

// Mostrar serviços
function showService(data){
    
    Object.keys(data).forEach( item => {
        var option = new Option(
            text = data[item]['name'],
            value = item
        );

        addOptionInSelect("service", option);
    })
}

// Mostrar erro
function showError(step=0){
    result = false

    if(getElementByQuerySelector('#alert')){
        var alert = getElementByQuerySelector('#alert')
        result = true;

        if(step){
            alert.classList.remove("fade");
            addErro(alert,step);
        }else{
            alert.classList.add("fade");
        }
    }

    return result;
}

function addErro(el,step=0){
    var errors = [
        "error",
        "cidade",
        "serviço",
        "data",
        "horário",
        "nome",
        "sobrenome",
        "telefone"
    ];

    var errorMessage = [
        "erro desconhecido",
        "selecione uma cidade válida",
        "selecione um serviço válido",
        "selecione uma data válida",
        "selecione um horário válido",
        "selecione um nome válido",
        "selecione um sobre nome válido",
        "selecione um número de telefone válido"
    ];

    el.innerHTML = `<strong>[!] - Erro ${errors[step]}: </strong> ${errorMessage[step]}!`;
}

//function check form
async function checkForm(step){
    var result = true;
    var form = formscheduling;

    switch(step){
        case 0:
            var city = form.city;
            if(city.selectedIndex == -1){   
                form.city.style.border='1px solid #ff1f1f'; 
                showError(1);
                result = false;
            }else {
                showError();
            
                var services = await getService();           
                if(services) showService(services);

                innitDatePicker();
            }
            break;
        case 1:
            var service = form.service;
            var date = form.date;

            if(service.selectedIndex == -1){   
                form.service.style.border='1px solid #ff1f1f'; 
                showError(2);
                result = false;
            }else {
                showError();
                console.log(date.value)
                // Verificar data
                if(isDate(date.value)){
                    result = false;
                    console.log("Data selecionada:", dateSelected );
                }else{
                    result = false;
                    console.log("Data inválida! ");
                }

            }

            // result = false; // forçar não passar

            break;
            
    }

    return result;
} 

// Pegar cidades disponíveis
function getCity(url = "/scheduling/city"){
    return fetch(url)
        .then(data => data.json())
        .catch(e => console.log('[!] - ' + e));
}

// Pegar serviços disponíveis
function getService(url = "/scheduling/service"){
    return fetch(url)
    .then(data => data.json())
    .catch(e => console.log('[!] - ' + e));
}

// Pegar dias por cidade
async function getDayByCityAndEmployee(url = "/scheduling/day_by_city_and_employee/"){
    url += "?city=" + city.value + "&employee=" + employee.value; // Add parâmetros na url
    return fetch(url)
    .then(data => data.json())
    .catch(e => console.log('[!] - ' + e));
}  

// Iniciar datepicker
async function innitDatePicker(){
    var daysByCity = await getDayByCityAndEmployee();

    daysOff, daysActiveOfWeekByCityAndEmployee = [];
    Object.keys(daysByCity).forEach( item => daysActiveOfWeekByCityAndEmployee.push(parseInt(item)-1));
    daysOff = arrayDiff(days,daysActiveOfWeekByCityAndEmployee);

    initDatePicker(daysOff);

}

/* function d'initialisation des composants */
function initDatePicker(daysOff = []){
    var nameEl = "#date" + city.value;
    console.log(nameEl);
    $(function() {
        $("#date1").datepicker({
            update: '',
            language: "pt-BR",
            format: "d MM yyyy",
            // startDate: '+0d',
            autoclose : true ,
            todayBtn: true,
            maxViewMode: 1,
            multidate: false,
            todayHighlight : true,
            daysOfWeekDisabled: daysOff, //daysOfWeekDisabled,
        
        }).on('changeDate', function(ev){
            // console.log("Selecionou! " + ev.date);
            dateSelected = ev.date;
        });

        $("#date2").datepicker({
            update: '',
            language: "pt-BR",
            format: "d MM yyyy",
            // startDate: '+0d',
            autoclose : true ,
            todayBtn: true,
            maxViewMode: 1,
            multidate: false,
            todayHighlight : true,
            daysOfWeekDisabled: [0,1,3,4,6], //daysOfWeekDisabled,
        
        }).on('changeDate', function(ev){
            console.log("Selecionou! " + ev.date);
            dateSelected = ev.date;

        });
    });
}