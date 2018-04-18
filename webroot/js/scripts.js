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

}); 