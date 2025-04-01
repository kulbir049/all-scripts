<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Forgot Your Password Or Username?</h4>
      </div>
      <div class="modal-body">
      <div id="data1"></div>
     <div id="form">
     <form class="example ws-validate">
     <span class="error" style="display:none">You forgot to enter your email.</span>

     <div class="form-group">
     <br>
     <div class="form-group">
     <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
     </div>

     <input type="submit" value="Continue &raquo;" class="submit btn btn-default"/>
     </form>
     </div>
     

     
     
     
     
     </div>
      </div>
      
    </div>
  </div>



<script type="text/javascript" src="https://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js">
</script>
<script type="text/javascript" >
$(function() {
$(".submit").click(function() {
var email = $("#email").val();


var username = $("#email").val();
var dataString = 'email=' + email;

if(email=='')
{
$('.success').fadeOut(200).hide();

$('.error').fadeOut(200).show();
}
else
{
$.ajax({
type: "POST",
url: "main/resend_login_code.php",
data: dataString,

success: function(data){
$('#data1').html(data);
$("#form").fadeOut(200).hide();
$('.error').fadeOut(200).hide();
}
});

}
return false;
});
});
</script>