
// Adicionar um ID como um fragmento na URL atual.
// O ID é recebido como um parâmetro da função e é adicionado à URL usando o objeto "window.location.href".
function setIDInUrlScheduling(id = 0) {
    window.location.href = window.location.href.split('#')[0] + '#' + id;
}

function getUrlAdmin(){
    var url = window.location.href;
    // console.log(url)
    var adminIndex = url.indexOf("admin/");
    url = url.substr(0, adminIndex + "admin/".length);
    // console.log(url)

    return url;
}

// Remova todos os elementos <option> de um elemento <select>
function removeAllOptions(select, i =0) {
    while (select.options.length > 1) {
        select.remove(1);
    }
}


// SCHEDULING (INDEX)


function setSchedulingDataInModal(id = 0){
    var url = getUrlAdmin();

    url = url + "infoOfScheduling?id=" + id
    // console.log(url)

    fetch(url)
    .then(response => response.json())
    .then(data => {
        // console.log(data)
        document.getElementById('id_modal').innerHTML = data.id;
        document.getElementById('service_modal').innerHTML = data.service.name;
        document.getElementById('start_modal').innerHTML = data.time_start;
        document.getElementById('end_modal').innerHTML = data.time_end;
        document.getElementById('date_modal').innerHTML = data.date;

        const now = dateObj = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        currentTime =  `${hours}:${minutes}`

    });
}

function setHolidayDataInModal(id = 0){
    var url = getUrlAdmin();

    url = url + "infoOfHoliday?id=" + id
    // console.log("URL: " + url)
    // console.log("ID: " + id)

    fetch(url)
    .then(response => response.json())
    .then(data => {
        // console.log(data)
        document.getElementById('id_modal').innerHTML = data.id;
        document.getElementById('id_modal_post').value = data.id;
        document.getElementById('name_modal').value = data.name;
        document.getElementById('date_modal').value = data.date;
        document.getElementById('repeat_modal').checked  = (data.permanent) ? true : false;

    });
}

function setServiceDataInModal(id = 0){
    var url = getUrlAdmin();

    url = url + "infoOfService?id=" + id
    // console.log("URL: " + url)
    // console.log("ID: " + id)

    fetch(url)
    .then(response => response.json())
    .then(data => {
        // console.log(data)
        document.getElementById('id_modal').innerHTML = data.id;
        document.getElementById('id_modal_post').value = data.id;
        document.getElementById('name_modal').value = data.name;
        document.getElementById(data.duration).selected = true;
    });
}

function setDaysActiveDataInModal(id = 0){
    var url = getUrlAdmin();

    url = url + "infoOfDaysActive?fk_day=" + id
    // console.log("URL: " + url)
    // console.log("ID: " + id)

    fetch(url)
    .then(response => response.json())
    .then(data => {
        // console.log(data)
        document.getElementById('id_modal').innerHTML = data.id;
        document.getElementById('id_modal_post').value = data.id;
        document.getElementById('name_modal').innerHTML = data.name;
        // document.getElementById('name_modal_post').value = data.name;
        document.getElementById('status_modal').checked  = (data.status) ? true : false;

    });
}

function setTimeActiveInModal(id = 0){
    var url = getUrlAdmin();

    url = url + "infoOfTimeActive?fk_day=" + id
    console.log("URL: " + url)
    console.log("ID: " + id)

    fetch(url)
    .then(response => response.json())
    .then(data => {
        console.log(data)
        document.getElementById('id_modal').innerHTML = data.id;
        document.getElementById('id_modal_post').value = data.id;
        document.getElementById('name_modal').innerHTML = data.name;
        
        const select_am_start = document.getElementById('start_am_modal');
        const select_am_end = document.getElementById('end_am_modal');
        const select_pm_start = document.getElementById('start_pm_modal');
        const select_pm_end = document.getElementById('end_pm_modal');

        // Use a função para remover todas as opções dos seus select
        removeAllOptions(select_am_start);
        removeAllOptions(select_am_end);
        removeAllOptions(select_pm_start);
        removeAllOptions(select_pm_end);

        // console.log(data)

        for (const time in data.am.time) {
            if (data.am.time.hasOwnProperty(time)) {
                const select_am_start_option = document.createElement('option');
                const select_pm_start_option = document.createElement('option');
                
                const value = data.am.time[time];
                // const value = data.time_am[time];
                // console.log(value['id'])

                select_am_start_option.value = value['id'];
                select_pm_start_option.value = value['id'];

                select_am_start_option.textContent = value['time'];
                select_pm_start_option.textContent = value['time']
                
                select_am_start.appendChild(select_am_start_option);
                select_am_end.appendChild(select_pm_start_option);
            }
        }

        for (const time in data.pm.time) {
            if (data.pm.time.hasOwnProperty(time)) {
                const select_pm_start_option = document.createElement('option');
                const select_pm_end_option = document.createElement('option');
                
                const value = data.pm.time[time];

                select_pm_start_option.value = value['id'];
                select_pm_end_option.value = value['id'];

                select_pm_start_option.textContent = value['time'];
                select_pm_end_option.textContent = value['time']
                
                select_pm_start.appendChild(select_pm_start_option);
                select_pm_end.appendChild(select_pm_end_option);
                
            }
        }
        
        let am_start = (data.am.start.fk_time) != 0 ? (data.am.start.fk_time) : 0;
        let pm_start = (data.pm.start.fk_time) != 0 ? (data.pm.start.fk_time) : 0;

        let am_end = (data.am.end.fk_time) != 0 ? (data.am.end.fk_time) : 0;
        let pm_end = (data.pm.end.fk_time) != 0 ? (data.pm.end.fk_time) : 0;

        select_am_start.querySelector('option[value="' + am_start  +'"]').selected = true;
        select_am_end.querySelector('option[value="' + am_end  +'"]').selected = true;

        select_pm_start.querySelector('option[value="' + pm_start  +'"]').selected = true;
        select_pm_end.querySelector('option[value="' + pm_end  +'"]').selected = true;
        
        
        // select_pm_start.querySelector('option[value="' + 0  +'"]').selected = true;
        // select_pm_end.querySelector('option[value="' + pm_end  +'"]').selected = true;

    });
}



// DELETE SCHEDULING
const btnDeleteSche = document.getElementById('deleteScheduling');
btnDeleteSche.addEventListener('click', function(event) {
    var url = getUrlAdmin();
    var id = document.getElementById('id_modal').innerHTML;
    url = url + "deleteScheduling?id=" + id;
    // console.log(url);
    window.location.href = url;
});

function deleteHoliday(){
    var url = getUrlAdmin();
    var id = document.getElementById('id_modal').innerHTML;
    url = url + "deleteHoliday?id=" + id;
    console.log(url);
    window.location.href = url;
}

function deleteService(){
    var url = getUrlAdmin();
    var id = document.getElementById('id_modal').innerHTML;
    url = url + "deleteService?id=" + id;
    console.log(url);
    window.location.href = url;
}


