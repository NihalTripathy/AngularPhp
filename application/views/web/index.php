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
	    	<h3 style="text-align: center;">Registration Form</h3>
		    <form class=" login-box-body" action="" method="post"  id="frmApplyNew" name="frmApplyNew" >
			   <input type="hidden" id="hidCsrfRegister" name="hidCsrfRegister" value="<?php echo generateToken('frmApplyNew'); ?>"/>
		    		<div class="row fpad form-group">
				         <label class="col-lg-4"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-user" style="color:#E4791A"></i>  First Name</label>
					    <div class="col-lg-8">
					      <input class="form-control" type="text" name="txtFirstName" id="txtFirstName" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" maxlength="50" required="" placeholder="First Name" value="<?=isset($txtFirstName)?$txtFirstName:''?>">
				    	</div>
				    </div>

                   <div class="row fpad form-group">
				    
					 <label class="col-lg-4">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-user" style="color:#E4791A"></i>  Middle Name</label>
                    
                    <div class="col-lg-8">
						<input class="form-control" type="text"  name="txtMiddleName" id="txtMiddleName" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" maxlength="50"  placeholder="Middle Name" value="<?=isset($txtMiddleName)?$txtMiddleName:''?>">
					   </div>
					</div>

					<div class="row fpad form-group">
					  
					  <label class="col-lg-4"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-user" style="color:#E4791A"></i>  Last Name</label>
					 
					 <div class="col-lg-8">
					 	<input class="form-control" type="text" id="txtLastName" name="txtLastName" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" maxlength="50"  placeholder="Last Name (For no last name put a dot(.))" value="<?=isset($txtLastName)?$txtLastName:''?>" data-placement="top" data-toggle="tooltip" title="For no last name put a dot(.)">
					 
					</div>
					</div>
				
				<div class="row fpad form-group">
				 
					 <label class="col-lg-4"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-mobile" style="color:#E4791A"></i>  Mobile No </label>
					
					 <div class="col-lg-8"> 
						 	<input class="form-control" type="text" id="txtCandidatePhone" name="txtCandidatePhone" autocomplete="off" maxlength="10" required="" placeholder="Mobile No" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>" data-placement="top" data-toggle="tooltip" title="Your mobile no. ex: 9040123456">
						</div>
					</div> 

					<div class="row fpad form-group">
					 
					 <label class="col-lg-4"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-envelope" style="color:#E4791A"></i>  Email  </label>
					 
					 <div class="col-lg-8">     
					  <input class="form-control" type="text" name="txtEmail" id="txtEmail" required="" placeholder="Email" autocomplete="off" maxlength="80" value="<?=isset($txtEmail)?$txtEmail:''?>"  data-placement="top" data-toggle="tooltip" title="Your Email-id. ex: xyz@gmail.com">
					 </div>
					</div>
				<div class="row fpad form-group">
				      	<label class="col-lg-4"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-key" style="color:#E4791A"></i>  Password </label>
					    <div class="col-lg-8">   
					      	<input class="form-control" type="password" name="txtPassword" id="txtPassword" required="" autocomplete="off" placeholder="Password" data-placement="top" data-toggle="tooltip" title="Your password ex: P@ssw0rd">
					    </div>
				</div>
				<div class="row fpad form-group">
				      	<label class="col-lg-4"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-key" style="color:#E4791A"></i>  Confirm Password </label>
					    <div class="col-lg-8">   
					      	<input class="form-control" type="password" name="txtConfirmPassword" id="txtConfirmPassword" required="" autocomplete="off" placeholder="Confirm Password" data-placement="top" data-toggle="tooltip" title="Your password ex: P@ssw0rd">
					    </div>
				</div>
                 <div class="row fpad">
				    <div class="col-sm-12 col-xs-6" align="center" >
			   	 		<button class="btn btn-success" style="margin-left: 49px;width: 166px;" type="submit"  onclick="return validate();" id="btnRegister" name="btnRegister"><i class="fa fa-user-plus"></i> Register Now</button>
		    		</div>
		    	</div>
		    </form>
		      <a style="text-align: center;" href="<?php echo base_url(); ?>/login"><button id="login" class="btn btn-primary">Click Here For Login</button></a>
	    </div>
		<div class="col-sm-3 background"></div>
 		</div>
 	</div>
</section>
<script>
	function validate()
	{
		var reg_user_id = document.getElementById("txtCandidatePhone").value; 
		var txtNewPassword1 = document.getElementById("txtPassword").value; 
		var encSaltSHAPassMobile = encryptShaPassCode(reg_user_id,txtNewPassword1);
		$('#txtPassword').val(encSaltSHAPassMobile);
		$('#txtConfirmPassword').val(encSaltSHAPassMobile);
		//alert($('#txtPassword').val());
	}
	base_url = '<?php echo base_url(); ?>';
	$('#frmApplyNew').bootstrapValidator({
        message: 'This value is not valid',
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			var formData = new FormData(document.getElementById("frmApplyNew"));
			$.ajax({
				url:base_url+"Auth/registration",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{  
					var result = JSON.parse(response);
					// console.log(result);
					if(result.status == "Success")
					{
						alert("Congrats,Registration Successfull");
						$('#txtPassword').val('');
						$('#txtConfirmPassword').val('');
						$('#txtFirstName').val('');
						$('#txtMiddleName').val('');
						$('#txtEmail').val('');
						$('#txtLastName').val('');
						$('#txtCandidatePhone').val('');
					}
					else 
					{
						alert("Failed");
						$('#txtPassword').val('');
						$('#txtConfirmPassword').val('');
					}
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
		},
        fields: {
			txtFirstName: {
                validators: {
                	notEmpty: {
                        message: "Please Enter First Name"
					},
					regexp: {
                        regexp: /^([A-Za-z._,]+)$/,
                        message: "Special characters and Numbers are not allowed"
					}, 
					stringLength: {
						max: 50,
						min: 1,
						message: 'First name must be 1 to 50 characters'
					}
                }
            },
			txtMiddleName: {
                validators: {
                    regexp: {
                        regexp: /^([A-Za-z._,]+)$/,
                        message: "Special characters and Numbers are not allowed"
					}, 
					stringLength: {
						max: 50,
						min: 0,
						message: 'Middle name must be 0 to 50 characters'
					}
                }
            },
			txtCandidatePhone: {
                validators: {
                	notEmpty: {
                        message: "Please Enter Mobile No"
					},
					integer: {
							message: 'The value can contain only numbers'
						}, 
					stringLength: {
						max: 10,
						min: 10,
						message: 'Phone no must be 10 characters'
					}
				}
			},
            txtEmail: {
                validators: {
                	notEmpty: {
                        message: "Please Enter Email"
					},
					emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                }
            },
            
			txtPassword: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
            		regexp: {
						regexp: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&]).{6,12}$/,
						message: "The password should contain Minimum 6 and Maximum 12 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character:"
					},
				}
			},
			txtConfirmPassword: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					identical: {
	                    field: 'txtPassword',
	                    message: 'New password and its confirm are not the same'
                	}
				}
			},
			txtCaptcha: {
                validators: {
                	notEmpty: {
                        message: "Please Enter Captcha"
					},
                    
					regexp: {
                        regexp: /^([A-Za-z0-9]+)$/,
                        message: "Special characters are not allowed"
					}, 
					stringLength: {
						max: 6,
						min: 6,
						message: 'Captcha must be 6 characters'
					}
                }
            }	
		}
	});
</script>