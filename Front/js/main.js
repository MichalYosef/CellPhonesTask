$(document).ready(function() {
    // Load phones data into datatable
    $('#phonesTbl').dataTable();  
});

 
/* load manufacturers list from the server into dropdown select element 
    on create new phone modal load 
*/
$('#create').on('shown.bs.modal', function (e) 
{
    // get manufacturers list from the server via jquery ajax GET request
    $.ajax({
        type: "GET",
        url: '../Back/API/API.php' ,
        dataType: 'json',
        data: 
        { 
            objectType: 'manufacturer' ,
            params: { id: -1} // -1 to inform that no params are sent
        },
        success: function(returnedData)
        {
            // add manufecturers to select input element
            $.each(returnedData, function(key, value) 
            {   
                // get the select element by id
                let mySelect = document.getElementById("manuSelectEl");
                
                // create select option object
                let opt = document.createElement("option");

                // add relevant values to the select object
                opt.text = value.name; // the shown text
                //opt.value = value.name; // 
                opt.setAttribute("name", value.id); // keeping manufecturer id 
                // adding current option to the dropdown select element
                mySelect.options.add(opt);
           }); 
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            errtext = 'data:text/html;base64,' + window.btoa(jqXHR.responseText);
            window.open(errtext, '_self');
            
        }   
    }); //end of $.ajax
})

// on button create's click  - send create phone to the server
$('#btnCreate').click(function(){
    createNewPhone();
    
    // close modal that was opened to get new pone's input
    $('#create').modal("hide");
    
    // reload phones data into datatable
    $('#phonesTbl').dataTable(); 
})

// when modal is hidden (closed) clean input fields
$('#create').on('hidden.bs.modal', function () 
{
    $(this).find("input,file,select").val('').end();

});

function createNewPhone()
{
    // load inputs: name and manufecturer id
    let name = $("#create #name").val().trim();
    let manuId = $('#manuSelectEl option:selected').attr("name");
    
    //load image file
    var img = $('input[name="file"]').get(0).files[0];
        
    // add all inputs into FormData object
    var formData = new FormData();
    formData.append('img', img);
    formData.append('phone_name', name);
    formData.append('manufacturer_id', manuId);
    formData.append('objectType', 'phone');
    
    // send all data to server using jquery ajax 
    $.ajax({
      type: "POST",
      url: '../Back/API/API.php',
      data:   formData,
      contentType: false,
      processData: false,
      cache: false,
      complete: function(data) {
      //  alert("success");
      }
    });

}
