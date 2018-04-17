<form id="upload_csv" method="post" enctype="multipart/form-data">
    <div class="row">
            <div class="col-md-3">
                <input type="file" name="persons_file" style="margin-top:15px;" />  
            </div>  
            <div class="col-md-3">  
                <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />  
            </div>  
    </div>
</form>
<br><br>

<table class="table-striped table-hover table-bordered dataTable no-footer jTable" id="groups-table">
    <thead>
        <tr>
            <th>Group Name</th>
            <th>Date Created</th>
        </tr>
    </thead>
</table>