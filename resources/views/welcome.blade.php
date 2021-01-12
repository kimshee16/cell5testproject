<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel Test - Cell 5</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body onclick="getData(event);">
        <!--<div id="app"></div>-->
        <div class="container">
			<div class="card">
			<h5 class="card-header">Cell 5 - Laravel Mix Test</h5>
				<div class="card-body">
					<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="clearfields();">Add Record</a>
          <a href="#" class="btn btn-primary" onclick="displayAll();">Display All Records</a>
          <br><br>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search by tag" aria-label="Recipient's username" aria-describedby="button-addon2" id="searchword">
            <button class="btn btn-outline-secondary" type="button" id="search" onclick="searchWord();">Search</button>
          </div>
					<div class="table-responsive">
						<table class="table table-stripped mt-4" id="hobbiesTable">
							<thead>
								<tr>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Hobby</th>
									<th hidden>Tags</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
									
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

        <!-- Create Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add/Edit Hobby</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/store" method="post" onsubmit="submitForm();">
                {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">ID</label>
                        <input type="text" class="form-control" name="id" id="id" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">First name</label>
                        <input type="text" class="form-control" name="firstname" id="firstname">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="lastname" id="lastname">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Hobby</label>
                        <input type="text" class="form-control" name="hobbies" id="hobby">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tags (separated by comma if more than one)</label>
                        <input type="text" class="form-control" name="tags" id="tags">
                    </div>
                    
                    <button type="submit" class="btn btn-primary" id="submitNew">Create/Update</button>
                </form>
              </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Wiki Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="wiki"></p>
              </div>
          </div>
        </div>
      </div>

       <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    </body>
</html>


<script type='text/javascript'>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function clearfields() {
      $(document).ready(function(){
           document.getElementById('id').value = '';
           document.getElementById('firstname').value = '';
           document.getElementById('lastname').value = '';
           document.getElementById('hobby').value = '';
           document.getElementById('tags').value = '';
           
      });
    }


    function displayAll() {
      $.ajax({
         url: 'getHobbies/',
         type: 'get',
         dataType: 'json',
         success: function(response){


           var len = 0;
           $('#hobbiesTable tbody').empty(); // Empty <tbody>
           if(response['data'] != null){
              len = response['data'].length;
           }

           if(len > 0){
              for(var i=0; i<len; i++){
                var id = response['data'][i].id;
                 var firstname = response['data'][i].firstname;
                 var lastname = response['data'][i].lastname;
                 var hobbies = response['data'][i].hobbies;
                 var tags = response['data'][i].tags;

                 var tr_str = "<tr>" +
                    "<input type='hidden' id='hobbyid' value='"+id+"'>" +
                   "<td>" + firstname + "</td>" +
                   "<td>" + lastname + "</td>" +
                   "<td>" + hobbies + "</td>" +
                   "<td hidden>" + tags + "</td>" +
                   "<td><button class='btn btn-warning' id='editBut"+id+"' value="+id+" data-bs-toggle='modal' data-bs-target='#exampleModal'>Edit</button> <a href='destroy/"+id+"' class='btn btn-danger'>Delete</a> <a href='https://en.wikipedia.org/wiki/"+firstname+"_"+lastname+"' target='_blank' class='btn btn-success'>Wiki Info</a></td>" +
                 "</tr>";

                 $("#hobbiesTable tbody").append(tr_str);
              }
           }else{
              var tr_str = "<tr>" +
                  "<td align='center' colspan='4'>No record found.</td>" +
              "</tr>";

              $("#hobbiesTable tbody").append(tr_str);
           }

         }
       });
    }

    function searchWord() {
      var x = document.getElementById('searchword').value;
      $.ajax({
         url: 'searchHobby/'+x,
         type: 'get',
         dataType: 'json',
         success: function(response){
           var len = 0;
           $('#hobbiesTable tbody').empty(); // Empty <tbody>
           if(response['data'] != null){
              len = response['data'].length;
           }

           if(len > 0){
              for(var i=0; i<len; i++){
                var id = response['data'][i].id;
                 var firstname = response['data'][i].firstname;
                 var lastname = response['data'][i].lastname;
                 var hobbies = response['data'][i].hobbies;
                 var tags = response['data'][i].tags;

                 var tr_str = "<tr>" +
                    "<input type='hidden' id='hobbyid' value='"+id+"'>" +
                   "<td>" + firstname + "</td>" +
                   "<td>" + lastname + "</td>" +
                   "<td>" + hobbies + "</td>" +
                   "<td hidden>" + tags + "</td>" +
                   "<td><button class='btn btn-warning' id='editBut"+id+"' value="+id+" data-bs-toggle='modal' data-bs-target='#exampleModal'>Edit</button> <a href='destroy/"+id+"' class='btn btn-danger'>Delete</a> <a href='https://en.wikipedia.org/wiki/"+firstname+"_"+lastname+"' target='_blank' class='btn btn-success'>Wiki Info</a></td>" +
                 "</tr>";

                 $("#hobbiesTable tbody").append(tr_str);
              }
           }else{
              var tr_str = "<tr>" +
                  "<td align='center' colspan='4'>No record found.</td>" +
              "</tr>";

              $("#hobbiesTable tbody").append(tr_str);
           }

         }
       });

    }

     $(document).ready(function(){
       $.ajax({
         url: 'getHobbies/',
         type: 'get',
         dataType: 'json',
         success: function(response){


           var len = 0;
           $('#hobbiesTable tbody').empty(); // Empty <tbody>
           if(response['data'] != null){
              len = response['data'].length;
           }

           if(len > 0){
              for(var i=0; i<len; i++){
                var id = response['data'][i].id;
                 var firstname = response['data'][i].firstname;
                 var lastname = response['data'][i].lastname;
                 var hobbies = response['data'][i].hobbies;
                 var tags = response['data'][i].tags;

                 var tr_str = "<tr>" +
                    "<input type='hidden' id='hobbyid' value='"+id+"'>" +
                   "<td>" + firstname + "</td>" +
                   "<td>" + lastname + "</td>" +
                   "<td>" + hobbies + "</td>" +
                   "<td hidden>" + tags + "</td>" +
                   "<td><button class='btn btn-warning' id='editBut"+id+"' value="+id+" data-bs-toggle='modal' data-bs-target='#exampleModal'>Edit</button> <a href='destroy/"+id+"' class='btn btn-danger'>Delete</a> <a href='https://en.wikipedia.org/wiki/"+firstname+"_"+lastname+"' target='_blank' class='btn btn-success'>Wiki Info</a></td>" +
                 "</tr>";

                 $("#hobbiesTable tbody").append(tr_str);
              }
           }else{
              var tr_str = "<tr>" +
                  "<td align='center' colspan='4'>No record found.</td>" +
              "</tr>";

              $("#hobbiesTable tbody").append(tr_str);
           }

         }
       });

     });

     function getData(event){
        var id;
        id = document.getElementById(event.target.id).value;
        $.ajax({
         url: 'getHobby/'+id,
         type: 'get',
         dataType: 'json',
         success: function(response){

           var len = 0;
           $('#hobbyid').empty();
           $('#firstname').empty();
           $('#lastname').empty();
           $('#hobby').empty();
           $('#tags').empty();

           if(response['data'] != null){
              len = response['data'].length;
           }

           if(len > 0){
              for(var i=0; i<len; i++){
                var hobbyid = response['data'][i].id;
                var firstname = response['data'][i].firstname;
                var lastname = response['data'][i].lastname;
                var hobbies = response['data'][i].hobbies;
                var tags = response['data'][i].tags;
                
                 $("#id").val(hobbyid);
                 $("#firstname").val(firstname);
                 $("#lastname").val(lastname);
                 $("#hobby").val(hobbies);
                 $("#tags").val(tags);
                 
                
              }
           }

         }
       });

       $.ajax({
         url: 'https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&titles='+id+'&redirects=true',
         type: 'get',
         dataType: 'json',
         success: function(response){

           var len = 0;
           $('#wifi').empty();

           if(response['pages'] != null){
              len = response['pages'].length;
           }

           if(len > 0){
              for(var i=0; i<len; i++){
                var Wpageid = response['pages'][i].pageid;
                
                $("#wiki").val(response['pages'][i].Wpageid.extract); 
                
              }
           }

         }
       });

     }


    $("#submitNew").click(function() {
        oid = $("#id").val();      
        fn = $("#firstname").val();
        ln = $("#lastname").val();
        h = $("#hobby").val();
        t = $("#tags").val();
        alert("Successfully saved the data!");
       $.ajax({
         url: 'store2/id='+oid+'/fn='+fn+'/ln='+ln+'/h='+h+'/t='+t,
         type: 'get',
         success: function(response){

           alert("Successfully saved the data!");

         }
       });
    });

     </script>