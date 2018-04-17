function getData() {
    var endPoint = "functions.php?function=getData";
    var xhr = new XMLHttpRequest();
    xhr.open('GET', endPoint, true);
    xhr.onload = function() {
        if (this.status == 200) {
            var r = JSON.parse(this.response);
            var x = '';

            for (var i = 0, len = r.length; i < len; i++) {
            x += '<li>' + r[i].task + '<button class="btn btn-light" onclick="deleteTask(' + r[i].id + ')">Done!</button> </li> <br>' ;
            }

            document.getElementById('todo').innerHTML = x;


        };
    };
    xhr.send();
}



function addTask() {
    var endPoint = "functions.php?function=addTask";

    var formData = new FormData();

    formData.append("task", document.getElementsByName("task")[0].value);
    


    var xhr = new XMLHttpRequest();
    xhr.open('POST', endPoint, true);

    xhr.onload = function() {
        if (this.status == 200) {
            getData();
        };
    };
    xhr.send(formData);
}

function deleteTask(id) {
    var endPoint = "functions.php?function=deleteTask&id=" + id;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', endPoint, true);
    xhr.onload = function() {
        if (this.status == 200) {
            getData();
        };
    };
    xhr.send();
}