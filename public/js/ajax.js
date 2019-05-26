	

	function ajax( id, url, qyt, price, data, method  )
	{
		console.log(data);
		let promise = new Promise( ( resolve, reject ) => {
				$.ajax({
					url: 'https://localhost:8080/online_shopping/public'+url,
					data: { "_token": "{{ csrf_token() }}", 'id': id, 'qyt': qyt, 'price' : price, 'data' : data, },
					success: function( data )
					{
						resolve( data );
					},
					error:function( error )
					{
						reject( error );
					}
				});
		} );

		return promise;	
	}

// Decrease product quantity from card
	$('.minus').click(function(){
		let id = this.id;
		let qyt = $('#qty'+id).val();
		let price  = $('#price'+id).text();
		if( qyt == 1 ){
			alert("Quantities Can't be in Negative");
		}else{
			price = price - price/qyt;
			qyt = qyt - 1;

		}
		ajax(id, '/updateProductQuantities', qyt, price ,'GET').then( (success)=>console.log('Updated') )
		.catch( (error)=>console.log(error) );
		$('#price'+id).text(price);
		$('#total'+id).text(price);
		$('#qty'+id).val(qyt);
		

	});

// increase product quantity in card
	$('.plus').click(function(){
		let id = this.id;
		let qyt = $('#qty'+id).val();
		let price  = $('#price'+id).text();
		let totalQuantity = $('#quantity'+id).attr('value');
		price = parseInt(price)+parseInt(price)/qyt;
		if( qyt ===  totalQuantity)
		{
			alert("No More Quantity is Available");

		}else{
			qyt = parseInt(qyt) + 1;
		ajax(id, '/updateProductQuantities', qyt, price, '','GET').then( (success)=>console.log('Updated') )
		.catch( (error)=>console.log(error) );
		$('#price'+id).text(price);
		$('#total'+id).text(price);
		$('#qty'+id).val(qyt);

		}
		
	});


// delete product user card
	$('a').click( function() {
		let id = this.id;	
		var tr = $(this).closest('tr');	
		ajax( id,'/deleteCardProduct' ).then( ( data )=>{
			if( data != "" ){
				alert(data);
			}
		} )
			.catch( (error)=>console.log(error) );
				 tr.find('td').fadeOut(1000,function(){ 
                 $tr.remove();                    
           	});	
	});

//Edit user profile
$(document).ready(function(){	 
	$("#successMsg").hide();
	$("#errorMsg").hide();

	$(".save_profile").click(function(e){                //Change user profile
		e.preventDefault(); 
		var form = $('form')[0];
	 let formData = $("form").serializeArray();	 
	 ajax('', '/editProfile', '', '', formData, 'POST').then( ( success )=>{
	 	$("#successMsg").show();
	 	$("#successMsg").append("<strong>Success!</strong> Profile Successfully Updated.");
	 	location.reload();
	 } ).catch( ( error ) => {
	 	$("#errorMsg").show();
	 	$("#errorMsg").append("<strong>Warning!</strong> Something Went wrong.");
	 	$("#errorMsg").append('');
		 });
	});	



	// Change profile pics


		$(".profile").click(function() {	
		    $("#file").trigger('click');
		});
		
		var input = document.querySelector('input[type=file]'); 
		input.onchange = function () {
		var id = $(this).attr('class');
		var file_data = $("#file").prop("files")[0]; // Getting the properties of file from file field
		var form_data = new FormData();
        form_data.append('file', $("#file").prop("files")[0]);
        form_data.append('id', id);
	    var filename = $('#file').val();
	     // alert(filename);
	    $.ajax({
					type: "POST",
					datatype: 'JSON',
					headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  },
					url: 'https://localhost:8080/online_shopping/public/changeUserProfile',
					data: form_data ,
			        contentType: false,
		            cache: false,
		            processData:false,
					success: function( data )
					{
						alert(data);
						location.reload();
					},
					error:function( error )
					{
						alert( data );
					}
				});		
	}
	
});

