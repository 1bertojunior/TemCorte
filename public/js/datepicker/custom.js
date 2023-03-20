function innitDatePicker(){
  console.log("\nIniciando o datepicker\n")

      // Chama a API para obter os dias da semana a serem desabilitados
      fetch("http://localhost:8080/scheduling/day_active")
        .then(response => response.json())
        .then(data => {
  
          var disabledDays = data[0].map(item => item - 1); 
          var disabledDates = data[1]; 


          $("#data").datepicker({
              update: '',
              language: "pt-BR",
              format: "d MM yyyy",
              autoclose : true ,
              todayBtn: true,
              maxViewMode: 1,
              multidate: false,
              todayHighlight : true,

              beforeShowDay: function(date) {
                var dayOfWeek = date.getDay();
                if (disabledDays.indexOf(dayOfWeek) !== -1) {
                    return {
                        enabled: false,
                        classes: 'disabled-day',
                        tooltip: 'Este dia não está disponível'
                    };
                } else if (disabledDates.indexOf(date.toISOString().slice(0,10)) !== -1) {
                    return {
                        enabled: false,
                        classes: 'disabled-date',
                        tooltip: 'Esta data não está disponível'
                    };
                } else {
                    return {
                        enabled: true
                    };
                }
            },

          }).on('changeDate', function(e) {
            var dateSelected = e.format('mm-dd-yyyy');            
            var url = getUrl();
            url += "/time?date=" + dateSelected
            console.log(url)


            console.log("Data selecionada: " + dateSelected);
            
            setOption('time', url )
            // setOption('service', url, 'name', 'duration');


          });

        })
        .catch(error => console.error('Erro ao obter dias desabilitados:', error));
}





// function innitDatePicker(){
//     console.log("\nIniciando o datepicker\n")

//     $(document).ready(function() {
//         $("#data").datepicker({
//             update: '',
//             language: "pt-BR",
//             format: "d MM yyyy",
//             autoclose : true ,
//             todayBtn: true,
//             maxViewMode: 1,
//             multidate: false,
//             todayHighlight : true,

//             beforeShowDay: function(date) {
//               var dayOfWeek = date.getDay();
//               var disabledDays = [1, 2, 3]; // Array com os dias da semana a serem desabilitados
//               if (disabledDays.indexOf(dayOfWeek) !== -1) {
//                   return {
//                       enabled: false,
//                       classes: 'disabled-day',
//                       tooltip: 'Este dia não está disponível'
//                   };
//               } else {
//                   return {
//                       enabled: true
//                   };
//               }
//             }

//         });
//     });
// }


// function innitDatePicker(){
//   console.log("\nIniciando o datepicker\n")

//   $(document).ready(function() {
//       // Array com os dias da semana a serem desabilitados (retornados pela API)
//       var disabledDays = [1, 2, 3];

//       $("#data").datepicker({
//           update: '',
//           language: "pt-BR",
//           format: "d MM yyyy",
//           autoclose : true ,
//           todayBtn: true,
//           maxViewMode: 1,
//           multidate: false,
//           todayHighlight : true,
//           beforeShowDay: function(date) {
//               var dayOfWeek = date.getDay();
//               if (disabledDays.indexOf(dayOfWeek) !== -1) {
//                   return {
//                       enabled: false,
//                       classes: 'disabled-day',
//                       tooltip: 'Este dia não está disponível'
//                   };
//               } else {
//                   return {
//                       enabled: true
//                   };
//               }
//           }
//       });
//   });
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