$(document).ready(function() {

    var table = $('#groups-table').DataTable({
        paging: true,
        ajax: {
            url: 'list',
            dataSrc: '',
            type: 'POST'
        },
        columns: [
            {
                "title":"Group Name",
                "data": "group_name",
                "render": function ( data, type, row, meta ) {
                        return "<a href='../persons/view/"+row.id+"'>"+row.group_name+"</a>";
                },
            },
            {
                "title":"Group Name",
                "data": "created"
            },
            
        ]
    });

    $('#upload_csv').on("submit", function(e){  
        e.preventDefault(); //form will not submitted  
        $.ajax({  
             url:'uploadcsv',  
             method:"POST",  
             data:new FormData(this),  
             contentType:false,          // The content type used when sending data to the server.  
             cache:false,                // To unable request pages to be cached  
             processData:false,          // To send DOMDocument or non processed data file it is set to false  
             success: function(data){  
                  if(data=='Error1')  
                  {  
                       alert("Invalid File");  
                  }  
                  else if(data == "Error2")  
                  {  
                       alert("Please Select File");
                  }  
                  else  
                    {  
                            table.ajax.reload(); 
                        
                  }  
             }  
        })  
    });

}); 