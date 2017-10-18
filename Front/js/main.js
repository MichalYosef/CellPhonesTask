$(document).ready(function() {
    // Load phones data into datatable
    $('#phonesTbl').dataTable();  
});

 
$('#create').on('shown.bs.modal', function (e) 
{
    // load manufacturer list from the server into select element on newPhoneForm load

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
                /*
                data-foo="dogs"
                */
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
    /*
 <!--   id="name" 
  id="inputImgFile"
  id="manuSelectEl"
    */
    let name = $("#create #name").val().trim();
    let manuId = $('#manuSelectEl option:selected').attr("name");
    loadImg();
    
    $.ajax({
        type: "POST",
        url: '../Back/API/API.php',
        data: 
        { 
            objectType: 'phone' ,
            params: {   'name' : name,
                        'manufacturer_id' : manuId}
        },
        async: false,
        success: function(response)
        {
            $('#phonesTbl').dataTable();
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            
        }   
        }).done(function(response)
        {
            
        });
}

function loadImg()
{
    var file_data = $('#sortpicture').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    alert(form_data);                             
    $.ajax({
                url: 'uploadImg.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                    alert(php_script_response); // display response from the PHP script, if any
                }
     });
}


