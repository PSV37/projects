@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create New User</div>

               
             <div class="panel-body">
                <form class="form-inline form_data">
                  {{csrf_field()}}
                 <div class="row"> 
                     <div class="col-md-4">
                       <div class="form-group">
                          <label for="pwd">FirstName:</label>
                          <input type="text" class="form-control" id="fname" placeholder="First name"  name="fname"  style="width: 96%;">
                       </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="pwd">LastName:</label>
                            <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname"  style="width: 96%;">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"  style="width: 96%;">
                        </div>
                     </div>
                 </div>
                 <div class="row" style="    margin-top: 11px;"> 
                     <div class="col-md-4">
                       <div class="form-group">
                          <label for="pwd">Password:</label>
                          <input type="password" class="form-control" id="password" placeholder="First name"  name="password"  style="width: 96%;">
                       </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="pwd">ConfirmPassword:</label>
                            <input type="password" class="form-control" id="password_confirmation" placeholder="Last Name" name="password_confirmation"   style="width: 96%;">
                        </div>
                     </div>
                 </div>
                  <div class="row">
                    <div class="col-md-4" style="    margin-top: 19px;">
                          <button type="submit" class="btn btn-default create_user">Submit</button>
                    </div>
                  </div>
                    
                </form>
             </div>

             <div class="show_data">
               <table class="table">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Created_by</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                        <tr>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                              @if($user->created_by == Auth::user()->id)
                                <b>You</b>
                              @else
                                {{$user->created_by}}
                              @endif  
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
             </div>
            </div>
        </div>
    </div>
</div>
@endsection

 <script src="{{ asset('js/app.js') }}"></script>

 <script type="text/javascript">
   $(document).ready(function(){
     $('.create_user').on('click',function(e){
          e.preventDefault();
          var fname = $('#fname').val();
          var lname = $('#lname').val();
          var email = $('#email').val();
          var password = $('#password').val();
          var ConfirmPassword = $('#password_confirmation').val();
          if(fname == '')
          {
             alert('Fill First Name');
          } else if (lname == ''){
              alert('Fill Last Name');
          } else if(email =='') {
             alert('Fill Email');
          } else if (password != ConfirmPassword){
             alert('Password Does Not Match');
          }

            var data = $('.form_data').serialize();
             var url = '{{url("post")}}';

             $.ajax({
                 type : 'POST',
                 url : url,
                 headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                 data : data,

                //display success message after success response
                success:function(response){
                  console.log(response.status);
                    if(response.status)
                    {   
                     // console.log(response.data);
                     $users = response.data;
                    }
                 }//end success function

            });

     })
   })
 </script>



                    
                    