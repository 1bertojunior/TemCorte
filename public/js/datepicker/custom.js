// function innitDatePicker(){ 
//     getDayByCityAndEmployee();
// }







// function addDayOff(data = []){
//     daysOff, daysActiveOfWeekByCityAndEmployee = [];
//     Object.keys(data).forEach( item => daysActiveOfWeekByCityAndEmployee.push(parseInt(item)-1) )

//     daysOff = arrayDiff(days,daysActiveOfWeekByCityAndEmployee);
//     initDatePicker();

//     // console.log("Days: " + days)
//     // console.log("Days by city: " + daysActiveOfWeekByCityAndEmployee)
//     // console.log("Daysoff: " + daysOff)
// }


// /* function d'initialisation des composants */
// function initDatePicker(){

//     $(function() {

//         $('#date').datepicker({
//             update: '',
//             language: "pt-BR",
//             format: "d MM yyyy",
//             // startDate: '+0d',
//             autoclose : true ,
//             todayBtn: true,
//             maxViewMode: 1,
//             multidate: false,
//             todayHighlight : true,
//             daysOfWeekDisabled: getDayByCityAndEmployee2(), //daysOfWeekDisabled,
        
//         }).on('changeDate', function(ev){
//             console.log("Selecionou! " + ev.date);
//         });

//     });

//     // $('#date').datepicker()
//     // .on('changeDate', function(ev){
//     //   if (ev.date.valueOf() < startDate.valueOf()){
//     //   }
//     // });

// }

// function getDayByCityAndEmployee2(url = "/scheduling/day_by_city_and_employee/"){
//     const options = {
//         method: 'GET',
//         mode: 'cors',
//         cache: 'default'
//     }

//     var result = [];

//     url += "?city=" + city.value + "&employee=" + employee.value; // Add parâmetros na url
//     const data  =  fetch(url, options)

//     .then( response => { 
//         response.json()
//         .then(data => console.log(teste(data))
//         )
//         .catch(e => console.log('[!] - ' + e))
//     })
//     .catch(e => console.log('[!] - ' + e))

//     return result;
// }

// function teste(data = []){
//     daysOff, daysActiveOfWeekByCityAndEmployee = [];
//     Object.keys(data).forEach( item => daysActiveOfWeekByCityAndEmployee.push(parseInt(item)-1) )

//     daysOff = arrayDiff(days,daysActiveOfWeekByCityAndEmployee);
//     console.log(daysOff);
//     return daysOff;

// }


//     // dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
//     // dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
//     // dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
//     // monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
//     // monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
//     // nextText: 'Próximo',
//     // prevText: 'Anterior'