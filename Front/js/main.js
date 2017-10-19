$(document).ready(function() {
    // Load phones data into datatable
    $('#phonesTbl').dataTable();  
});

 
$('#create').on('shown.bs.modal', function (e) 
{
    /* load manufacturer list from the server into select element on 
    newPhoneForm load */

    $.ajax({
        type: "GET",
        url: '../Back/API/API.php' ,
        dataType: 'json',
        data: 
        { 
            objectType: 'manufacturer' ,
            params: { id: -1}
        },
        success: function(returnedData)
        {
            console.log(  returnedData );
            
            // add manufecturers to select input element
            $.each(returnedData, function(key, value) {   

                let mySelect = document.getElementById("manuSelectEl");
                let opt = document.createElement("option");
                opt.text = value.name;
                opt.value = value.name;
                opt.setAttribute("name", value.id);
                
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

$('#btnCreate').click(function(){
    createNewPhone();
})

function createNewPhone()
{
    let name = $("#create #name").val().trim();
    let manuId = $('#manuSelectEl option:selected').attr("name");
    //loadImg();
    ////////////
    var img = $('input[name="file"]').get(0).files[0];
    var formData = new FormData();
    formData.append('img', img);
    
    formData.append('phone_name', name);
    formData.append('manufacturer_id', manuId);
    formData.append('objectType', 'phone');
    
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
