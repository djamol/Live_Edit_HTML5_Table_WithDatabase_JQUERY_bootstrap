<html>
 <head>
  <title>Router Details</title>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:1270px;
   padding:20px;
   background-color:#fff;
   border:1px solid #ccc;
   border-radius:5px;
   margin-top:25px;
   box-sizing:border-box;
  }
  </style>
 </head>
 <body>
  <div class="container box">
   <h1 align="center">Router Details</h1>
   <br />
   <div class="table-responsive">
   <br />
    <div align="right">
     <button type="button" name="add" id="add" class="btn btn-info">Add</button>
	<input type="file" id="upload" style="display:none;"accept=".csv"  />
	<button id="button" name="button" value="Upload" class="btn btn-info" onclick="thisFileUpload();">Upload</button>
	<script>
        function thisFileUpload() {
            document.getElementById("upload").click();
        };
		
		 $(document).ready(function(){
        $("#upload").change(function(){
          var result = confirm("Are you sure you want to Import CSV/Excel File?");
				if (result) {
				console.log("started");
				var formData = new FormData();
				formData.append('file', $('#upload')[0].files[0]);				
									 $.ajax({
						 url:"import.php",
						 method:"POST",
						 processData: false,  // tell jQuery not to process the data
       contentType: false,  // tell jQuery not to set contentType
						 data:formData,
						 success:function(data){
							 var obj = jQuery.parseJSON( data );
							 console.log(obj.data);
							 for(var i =0;i < obj.data.length;i++)
							 if(obj.data[i].indexOf("Added") != -1){
						  $('#alert_message').html('<div class="alert alert-success">'+obj.data[i]+'</div>');
							 }else{
						  $('#alert_message').html('<div class="alert alert-danger">'+obj.data[i]+'</div>');
							 
							 }
						 }
						});
						
				}
        });
    });
</script>
    </div>
    <br />
    <div id="alert_message"></div>
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>SAP ID</th>
       <th>Host Name</th>
       <th>Loop Back</th>
       <th>Mac Address</th>
       <th></th>
      </tr>
     </thead>
    </table>
   </div>
  </div>

 </body>
</html>

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  
  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"fetch.php",
     type:"POST"
    }
   });
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"update.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $('#add').click(function(){
   var html = '<tr>';
   html += '<td  id="data1"></td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td contenteditable id="data3"></td>';
   html += '<td contenteditable id="data4"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
  });
  
  $(document).on('click', '#insert', function(){
   var hostname = $('#data2').text();
   var mac_address = $('#data4').text();
   var loopback = $('#data3').text();
   if(hostname != '' && mac_address != '' )
   {
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{hostname:hostname, mac_address:mac_address,loopback:loopback},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
   else
   {
    alert("Host and Mac Address Fields is required");
   }
  });
  
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
 });
</script>

