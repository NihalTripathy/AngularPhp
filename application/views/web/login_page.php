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
<?php if($this->session->userdata('reg_user_id') != '') {?>
	<div class="container">
 		<div class="row">
 		<h1 style="text-align: center;">WELCOME TO DASHBOARD</h1>
 		<h1 style="text-align: center;">WELCOME <?php echo $this->session->userdata('first_name');?></h1>
 			<input type="text" id="name" class="form-control" readonly=""/>
 			<input type="text" id="email" class="form-control" readonly=""/>
 			<input type="text" id="phone" class="form-control" readonly=""/>
 		</div><br /><br /><br /><br />
 		<div class="row">
 		<div class="card">
 		<h4 style="text-align: center">Image Upload</h4>
 			<form  id="frmimage" name="frmimage" style="margin-top: 2%;"> 
	        	<input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo generateToken('frmimage'); ?>">
                  <div class="form-group  col-sm-6">
                    <label class="sr-only" for="exampleInputAmount"></label>
                    <div class="input-group">
                      <div class="input-group-addon lbl">Attach Image :</div>
                      <input type="file" name="photo" id="photo" accept="image/*" class="form-control tooltips" >
                    </div>
                  </div> 
               		<div class="clearfix"></div>
               		<div class="form-group  col-sm-6">
					<button type="submit"  class="btn btn-primary hoverClass" name="create" id="create" ><i class='fa fa-save'></i> Save</button>
					</div>
            </form>
        </div>
 		</div>
 		<a href="<?php echo base_url(); ?>/logout"><button id="login" class="btn btn-primary">Logout</button></a>
 	</div>
<?php } else{?>
<h4 style="color:red;">Unauthorized Access</h4>
<?php } ?>
</section>
<script>
		base_url = '<?php echo base_url(); ?>';
		reg_user_id = '<?php echo $this->session->userdata("reg_user_id"); ?>';
		function validate()
		{
			 $.ajax({
					url:base_url+"Auth/get_emp_data",
					type:"post",
					data:{ reg_user_id:reg_user_id },
					success:function(response){ 
						var result = JSON.parse(response);	
						console.log(result);
						$('#name').val(result[0].first_name);
						$('#email').val(result[0].email_id);
						$('#phone').val(result[0].reg_user_id);
					},
					error:function(){
						toastr.error("We are unable to Process.Please contact Support");
					}
				});
		}
		validate();
		$('#frmimage').bootstrapValidator({ 
		message: 'This value is not valid',
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
				var formData = new FormData(document.getElementById("frmimage"));
				$.ajax({
					url :base_url+'Auth/add_image',  
					type:"post",
					data:formData,
					contentType: false,
			        processData: false,
					success:function(response)
					{  
						//alert(response);
						
						try {
								var obj = JSON.parse(response);
								if(obj.status == true)
								{
									alert("Upload Successfully");
								}
								else
								{
									alert("Upload Failed");
								}
								
							} 
							catch (e) {
			               		 alert("Sorry",'Unable to Save.Please Try Again !');
			            	}
							
						
					},
					error:function()
					{
						toastr.error('We are unable to process please contact support');	
					}
				});
			
		},
    	//live: 'enabled',
        fields:
        {
           
		}	
	});
	
</script>