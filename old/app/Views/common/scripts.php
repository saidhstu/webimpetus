
<!--script type="text/javascript">
   $(document).ready(function() {
	   $('*[data-href]').on("click",function(){
	  window.location = $(this).data('href');
	  return false;
	});
	$("td > a").on("click",function(e){
	  e.stopPropagation();
	});
	
   });
</script-->
<!-- footer  -->
<script src="/assets/js/jquery-3.4.1.min.js"></script>




<script src="/assets/js/popper.min.js"></script>

<!-- bootstarp js -->
<script src="/assets/js/bootstrap.min.js"></script>
<!-- sidebar menu  -->
<script src="/assets/js/metisMenu.js"></script>
<script src="/assets/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
		if ($(".js-example-basic-multiple").length > 0) {
    $('.js-example-basic-multiple').select2();
		}
});
</script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
		if ($("#example").length > 0) {
			$('#example').DataTable();
		}
		
		if ($(".checkb").length > 0) {
			$('body .checkb').change(function(){
				 if(this.checked) {
					 //alert($(this).data('url'));
					 var status = 1;
				 }else var status = 0;
				 var formData = {
					'id': $(this).val(), 'status': status //for get email 
				};
				 $.ajax({
						url: $(this).data('url'),
						type: "post",
						data: formData,
						success: function(d) {
							alert('status changed successfully!!');
						}
				});
				
			});
		}
		<?php if(empty($_SESSION['role'])){ ?>
		$("table a").click(function(){
			return false;
		});
		<?php } ?>
	} );
	
	
</script>

<script src="/assets/js/custom.js"></script>
<!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script--> 

</body>
</html>