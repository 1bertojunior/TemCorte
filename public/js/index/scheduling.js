const getEle = element => document.querySelector(element);
const getElementByQuerySelector = element => document.querySelector(element);


// STEPS
const next = document.querySelector('.next'); //next firts
const prev = document.querySelector('.prev'); //prev Sec 
const elements = [ "step1", "step2", "step3" ];

var index = 0, indexAux =1, elCurrent, elPrev, elNext, progress;

setTimeout(() => {


}, 5000);


// Esperar todo documento ser carregado
window.onload = function () {

    // teste = getTeste()
    // console.log( teste )

    innitScheduling();
}



// Iniciar scheduling
async function innitScheduling(){

    console.log("Page loaded!");

    // iniciar serviços
    setService();

    // iniciar o date picker
    innitDatePicker();

    

}

async function setService(){
    var url = getUrl();
    url += "/service"

    console.log(url)

    // data = getDataFromAPI(url);
    // data = getDataAPI(url);

    setOption('service', url, 'name', 'id');
}

async function clickNextSteps(){
    progress = document.querySelector('#progress'); //progress
    elCurrent = getElementByQuerySelector("#"+elements[index])
    elNext = elCurrent.nextElementSibling; //pegando o proximo elemento ?? null
    
    progress = progress.children[index+1]; //progress
    progress.classList.add("active-progress") //progress
    elCurrent.classList.remove("active"); // hide
    elNext.classList.add("active"); //show

    if(index == 1 ){
        console.log(index)
        
        var service_select = document.getElementById('service');
	    var service_text = service_select.options[service_select.selectedIndex].text;

        var time_select = document.getElementById('time');
	    var time_text = time_select.options[time_select.selectedIndex].text;
        

        console.log(time_text)


        var service_modal = document.getElementById('service_modal');
        service_modal.innerHTML= service_text

        var time_modal = document.getElementById('time_modal');
        time_modal.innerHTML= time_text

  

    }

    index++;
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

    index--;
}

function getUrl(){
    return window.location.href;
}

async function getDataFromAPI(url = null) {
    result = []

    if( url != null ){
        fetch(url)
        .then(response => response.json())
        .then(data => {
            result = data
            // console.log(data)
        });
    }

    return result;
}

async function getDataAPI(url = null) {
    result = []

    if( url != null ){
        const response = await fetch(url);
        const data = await response.json();

        result = data;
    }

    return result;
}

async function setOption(selectId = null, url = [], name = 'name', value = 'value') {
    
    if( 1 ){
        const selectElement = document.getElementById(selectId);
        selectElement.innerHTML = '';

        fetch(url)
        .then(response => response.json())
        .then(data => {
            // console.log(data)
            // Cria um option para cada item em data
            data.forEach(item => {
                const optionElement = document.createElement('option');
                optionElement.value = item[value];
                optionElement.text = item[name];
                selectElement.appendChild(optionElement);
            }); 
           
        });

    }
    
}

// Remova todos os elementos <option> de um elemento <select>
function removeAllOptions(select, i =0) {
    while (select.options.length > 1) {
        select.remove(1);
    }
}