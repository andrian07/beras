<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Login</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style type="text/css">
  body {
  color: #999;
  background: #f5f5f5;
  font-family: "Varela Round", sans-serif;
}
.form-control {body {
  color: #999;
  background: #f5f5f5;
  font-family: "Varela Round", sans-serif;
}
.form-control {
  box-shadow: none;
  border-color: #ddd;
}
.form-control:focus {
  border-color: #4aba70;
}
.login-form {
  width: 350px;
  margin: 0 auto;
  padding: 30px 0;
}
.login-form form {
  color: #434343;
  border-radius: 1px;
  margin-bottom: 15px;
  background: #fff;
  border: 1px solid #f3f3f3;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  padding: 30px;
}
.login-form h4 {
  text-align: center;
  font-size: 22px;
  margin-bottom: 20px;
}
.login-form .avatar {
  color: #fff;
  margin: 0 auto 30px;
  text-align: center;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  z-index: 9;
  background: #4aba70;
  padding: 15px;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.login-form .avatar i {
  font-size: 62px;
}
.login-form .form-group {
  margin-bottom: 20px;
}
.login-form .form-control,
.login-form .btn {
  min-height: 40px;
  border-radius: 2px;
  transition: all 0.5s;
}
.login-form .close {
  position: absolute;
  top: 15px;
  right: 15px;
}
.login-form .btn {
  background: #4aba70;
  border: none;
  line-height: normal;
}
.login-form .btn:hover,
.login-form .btn:focus {
  background: #42ae68;
}
.login-form .checkbox-inline {
  float: left;
}
.login-form input[type="checkbox"] {
  margin-top: 2px;
}
.login-form .forgot-link {
  float: right;
}
.login-form .small {
  font-size: 13px;
}
.login-form a {
  color: #4aba70;
}
body {
  color: #999;
  background: #f5f5f5;
  font-family: "Varela Round", sans-serif;
}
.form-control {
  box-shadow: none;
  border-color: #ddd;
}
.form-control:focus {
  border-color: #4aba70;
}
.login-form {
  width: 350px;
  margin: 0 auto;
  padding: 30px 0;
}
.login-form form {
  color: #434343;
  border-radius: 1px;
  margin-bottom: 15px;
  background: #fff;
  border: 1px solid #f3f3f3;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  padding: 30px;
}
.login-form h4 {
  text-align: center;
  font-size: 22px;
  margin-bottom: 20px;
}
.login-form .avatar {
  color: #fff;
  margin: 0 auto 30px;
  text-align: center;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  z-index: 9;
  background: #4aba70;
  padding: 15px;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.login-form .avatar i {
  font-size: 62px;
}
.login-form .form-group {
  margin-bottom: 20px;
}
.login-form .form-control,
.login-form .btn {
  min-height: 40px;
  border-radius: 2px;
  transition: all 0.5s;
}
.login-form .close {
  position: absolute;
  top: 15px;
  right: 15px;
}
.login-form .btn {
  background: #4aba70;
  border: none;
  line-height: normal;
}
.login-form .btn:hover,
.login-form .btn:focus {
  background: #42ae68;
}
.login-form .checkbox-inline {
  float: left;
}
.login-form input[type="checkbox"] {
  margin-top: 2px;
}
.login-form .forgot-link {
  float: right;
}
.login-form .small {
  font-size: 13px;
}
.login-form a {
  color: #4aba70;
}
body {
  color: #999;
  background: #f5f5f5;
  font-family: "Varela Round", sans-serif;
}
.form-control {
  box-shadow: none;
  border-color: #ddd;
}
.form-control:focus {
  border-color: #4aba70;
}
.login-form {
  width: 350px;
  margin: 0 auto;
  padding: 30px 0;
}
.login-form form {
  color: #434343;
  border-radius: 1px;
  margin-bottom: 15px;
  background: #fff;
  border: 1px solid #f3f3f3;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  padding: 30px;
}
.login-form h4 {
  text-align: center;
  font-size: 22px;
  margin-bottom: 20px;
}
.login-form .avatar {
  color: #fff;
  margin: 0 auto 30px;
  text-align: center;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  z-index: 9;
  background: #4aba70;
  padding: 15px;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.login-form .avatar i {
  font-size: 62px;
}
.login-form .form-group {
  margin-bottom: 20px;
}
.login-form .form-control,
.login-form .btn {
  min-height: 40px;
  border-radius: 2px;
  transition: all 0.5s;
}
.login-form .close {
  position: absolute;
  top: 15px;
  right: 15px;
}
.login-form .btn {
  background: #4aba70;
  border: none;
  line-height: normal;
}
.login-form .btn:hover,
.login-form .btn:focus {
  background: #42ae68;
}
.login-form .checkbox-inline {
  float: left;
}
.login-form input[type="checkbox"] {
  margin-top: 2px;
}
.login-form .forgot-link {
  float: right;
}
.login-form .small {
  font-size: 13px;
}
.login-form a {
  color: #4aba70;
}
body {
  color: #999;
  background: #f5f5f5;
  font-family: "Varela Round", sans-serif;
}
.form-control {
  box-shadow: none;
  border-color: #ddd;
}
.form-control:focus {
  border-color: #4aba70;
}
.login-form {
  width: 350px;
  margin: 0 auto;
  padding: 30px 0;
}
.login-form form {
  color: #434343;
  border-radius: 1px;
  margin-bottom: 15px;
  background: #fff;
  border: 1px solid #f3f3f3;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  padding: 30px;
}
.login-form h4 {
  text-align: center;
  font-size: 22px;
  margin-bottom: 20px;
}
.login-form .avatar {
  color: #fff;
  margin: 0 auto 30px;
  text-align: center;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  z-index: 9;
  background: #4aba70;
  padding: 15px;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.login-form .avatar i {
  font-size: 62px;
}
.login-form .form-group {
  margin-bottom: 20px;
}
.login-form .form-control,
.login-form .btn {
  min-height: 40px;
  border-radius: 2px;
  transition: all 0.5s;
}
.login-form .close {
  position: absolute;
  top: 15px;
  right: 15px;
}
.login-form .btn {
  background: #4aba70;
  border: none;
  line-height: normal;
}
.login-form .btn:hover,
.login-form .btn:focus {
  background: #42ae68;
}
.login-form .checkbox-inline {
  float: left;
}
.login-form input[type="checkbox"] {
  margin-top: 2px;
}
.login-form .forgot-link {
  float: right;
}
.login-form .small {
  font-size: 13px;
}
.login-form a {
  color: #4aba70;
}

  box-shadow: none;
  border-color: #ddd;
}
.form-control:focus {
  border-color: #4aba70;
}
.login-form {
  width: 350px;
  margin: 0 auto;
  padding: 80px 0;
}
.login-form form {
  color: #434343;
  border-radius: 1px;
  margin-bottom: 15px;
  background: #fff;
  border: 1px solid #f3f3f3;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  padding: 30px;
}
.login-form h4 {
  text-align: center;
  font-size: 22px;
  margin-bottom: 20px;
}
.login-form .avatar {
  color: #fff;
  margin: 0 auto 30px;
  text-align: center;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  z-index: 9;
  background: #4aba70;
  padding: 15px;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.login-form .avatar i {
  font-size: 62px;
}
.login-form .form-group {
  margin-bottom: 20px;
}
.login-form .form-control,
.login-form .btn {
  min-height: 40px;
  border-radius: 2px;
  transition: all 0.5s;
}
.login-form .close {
  position: absolute;
  top: 15px;
  right: 15px;
}
.login-form .btn {
  background: #4aba70;
  border: none;
  line-height: normal;
}
.login-form .btn:hover,
.login-form .btn:focus {
  background: #42ae68;
}
.login-form .checkbox-inline {
  float: left;
}
.login-form input[type="checkbox"] {
  margin-top: 2px;
}
.login-form .forgot-link {
  float: right;
}
.login-form .small {
  font-size: 13px;
}
.login-form a {
  color: #4aba70;
}

</style>
 </head>
<body>
<!--  Request me for a signup form or any type of help  -->
<div class="login-form" style="text-align: center;">    
    <form>
      <h4 class="modal-title" style="margin-top: 20px;">ADMIN LOGIN</h4>
        <div class="form-group">
            <input type="text" id="username" class="form-control" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" id="password" class="form-control" placeholder="Password" required="required">
        </div>
        <input id="adminlogin" type="button" class="btn btn-primary btn-block btn-lg" value="Login">              
    </form>     
</div>
</body>

<script type="text/javascript">
      $(document).ready(function() {
      $('#adminlogin').click(function(e){
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();
        var branch = $("#branch").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Admin/processlogin",
            dataType: "json",
            data: {
                    username:username,  
                    password:password
                  },
            success : function(data){
                if (data.code == "200"){
                     window.location.replace("<?php echo base_url(); ?>Admin");
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.msg
                         })
                    }
                }
        });
      });
  });
</script>


</html>       
  
  
  
  
  