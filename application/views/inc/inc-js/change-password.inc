<style>
.list-group{
    z-index:10;display:none; 
	position:absolute; 
    color:red;
}
.msg
{
	position:absolute; 
    color:red;
}
</style>
 
<script>
$(document).ready(function() {
////////////////////


$('#frmcp').submit(function() {   
    
    if($('#new_password').val() == $('#retype_password').val()) { 
         $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'change-password', id: $('#user_id').val(), old_pwd:  $('#old_password').val(), new_pwd:  $('#new_password').val()},
                success: function(d) {  
                    alert(d.msg);
                    if(d.flg == 1)
                        window.location = "logout"; 
                }
         });
          return false;
    } else {
        alert("New Password Mis-Match ... Retry New Password");
        $('#retype_password').val('');
        $('#retype_password').focus();
        
        return false;
         
    } 


});  


$('#new_password').keyup(function(){
var str=$('#new_password').val();
var upper_text= new RegExp('[A-Z]');
var lower_text= new RegExp('[a-z]');
var number_check=new RegExp('[0-9]');
var special_char= new RegExp('[!/\'^?$%&*()}{@#~?><>,|=_+?-\]');

var flag='T';

if(str.match(upper_text)){
$('#d12').html("<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> One Upper Case Letter ");
$('#d12').css("color", "green");
}else{$('#d12').css("color", "red");
$('#d12').html("<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> One Upper Case Letter ");
flag='F';}

if(str.match(lower_text)){
$('#d13').html("<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> One Lower Case Letter ");
$('#d13').css("color", "green");
}else{$('#d13').css("color", "red");
$('#d13').html("<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> One Lower Case Letter ");
flag='F';}

if(str.match(special_char)){
$('#d14').html("<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> One Special Char ");
$('#d14').css("color", "green");
}else{
$('#d14').css("color", "red");
$('#d14').html("<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> One Special Char ");
flag='F';}

if(str.match(number_check)){
$('#d15').html("<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> One Number ");
$('#d15').css("color", "green");
}else{
$('#d15').css("color", "red");
$('#d15').html("<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> One Number ");
flag='F';}


if(str.length>7){
$('#d16').html("<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Length 8 Char ");

$('#d16').css("color", "green");
}else{
$('#d16').css("color", "red");
$('#d16').html("<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Length 8 Char ");

flag='F';}


if(flag=='T'){
$("#d1").fadeOut();
$('#display_box').css("color","green");
$('#display_box').html("<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> "+str);
}else{
$("#d1").show();
$('#display_box').css("color","red");
$('#display_box').html("<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> "+str);
}
});
///////////////////
$('#new_password').blur(function(){
$("#d1").fadeOut();
});
///////////
$('#new_password').focus(function(){
$("#d1").show();
});
////////////
/////displaying password/////
$("#ckb").change(function(){
 var ckb_status = $("#ckb").prop('checked');
if(ckb_status){$('#new_password').prop('type', 'text');}
else{$('#new_password').prop('type', 'password');}
});

/////
})
</script>