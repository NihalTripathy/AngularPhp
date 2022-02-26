<?php include'head.php'; ?>

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>/public/plugins/js/md5_5034.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>/public/plugins/js/profile_sha.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>/public/plugins/js/sha512.js"></script>
<script type="text/javascript">

</script>
<style type="text/css">
	label {
		display: inline-block;
	    max-width: 100%;
	    margin-bottom: 15px;
	    font-weight: bold;
    	color: #000;
    	font-size: 15px;
    }

	@media only screen and (min-width: 1200px){ 
		.container {
		    width: 1246px !important;
		}
	} 
    .fpad{
    	padding-top: 0px;
    }

    .form-group {
	    margin-bottom: 10px;
	}
	.background{
		
	}

	
</style> 
<section>
	<div class="container"><br/><br/><br/>
 		<div class="row">
 			<div class="col-sm-3 background"></div>
 			<div class="col-sm-6 background" style="box-shadow: 2px 2px 2px 3px #c0bdbd;">
	    		<h3 style="text-align: center;">Login Form</h3>
			   <form  class=" login-box-body"  action="" method="post" id="frm_login" name="frm_login">
				    <div class="row form-group" >
				      		<label class ="col-lg-4"for=""><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-mobile" style="color:#E4791A"></i>  Mobile : </label>
				     
				        <div class="col-lg-8">
				           <input class="form-control" type="text" maxlength="10"  id="txtCandidatePhone" name="txtCandidatePhone" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>"  autocomplete="off" placeholder="Mobile Number" data-placement="top" data-toggle="tooltip" title="Mobile Number ex:9040123456" >
				      
				        </div>
					</div> 
				   <div class="row fpad form-group" >
							<label class="col-lg-4" for=""><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-key" style="color:#E4791A"></i> Password :</label>
							<div class="col-lg-8">
								<input class="form-control" type="password" maxlength="80"  id="txtPwd" name="txtPwd" value=""  autocomplete="off" placeholder="Password" data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd" >
							</div>
					</div>
				     <div class="row fpad">
					    <div class="col-sm-12 col-xs-6" align="center" >
				   	 		<button class="btn btn-success"  onclick="return validate();" style="margin-left: 49px;width: 166px;" type="submit" id="btnlogin" name="btnlogin"><i class="fa fa-user-plus"></i> Login</button>
			    		</div>
			    	</div>
				</form>
		      <a href="<?php echo base_url(); ?>"><button id="login" class="btn btn-primary">Click Here For Registration</button></a>
	    </div>
	    <div class="col-sm-3 background"></div>
 		</div>
 		
 	</div>
</section>
<script>
		var base_url = '<?php echo base_url(); ?>';
		function validate()
		{
			//md5KeyValue = "<?php echo $this->session->userdata('key');?>";
			var reg_user_id = document.getElementById("txtCandidatePhone").value; 
			var confirmpassword = document.getElementById("txtPwd").value; 
			var encSaltSHAPassConfirm = encryptShaPassCode(reg_user_id,confirmpassword);
			document.getElementById("txtPwd").value = encSaltSHAPassConfirm; //changed
		}
		
		$('#frm_login').bootstrapValidator({
	        message: 'This value is not valid',
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				var formData = new FormData(document.getElementById("frm_login"));
				var insEncCode = $("#insEncCode").val();
				$.ajax({
					url:base_url+"Auth/registration_login",
					type:"post",
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						var result = JSON.parse(response);
						if(result.status == "Success")
						{
							window.open(base_url+"Auth/login_page","_self");
						}
						else
						{
							$('#txtPwd').val('');
							alert(result.msg);
						}
						
					},
					error:function()
					{
						toastr.error('Unable to Save.Please Try Again ');	
					}
				});
			},
	        fields: {
				txtCandidatePhone: {
	                validators: {
	                	notEmpty: {
	                        message: 'Please Enter Mobile No'
	                    },
	                    integer:{
							message:'Only numbers are allowed'
						}, 
						stringLength: {
							max: 10,
							min: 10,
							message: 'Mobile no must be 10 characters'
						}
	                }
	            },
				txtPwd: {
	                validators: {
	                    notEmpty: {
	                        message: 'Required'
	                    }
	                }
	            },
			}	
      	});
	
</script>