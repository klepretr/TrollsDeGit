document.getElementById("addtaskbutton").onclick = function(e) {
    e.preventDefault();
    $(".table-task > tbody").append(
        "<tr><td><input type='checkbox' name='addtask[]' value='"+document.getElementById("addtask").value+"' checked > "+ document.getElementById("addtask").value +"</td></tr>"
    )
    document.getElementById("addtask").value="";

};
