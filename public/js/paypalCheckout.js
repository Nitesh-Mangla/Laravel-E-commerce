$(document).ready(function(){

	var let = $(".payamount").val();
  
  paypal.Buttons({
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: let
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // Capture the funds from the transaction
      return actions.order.capture().then(function(details) {
        // Show a success message to your buyer
        alert('Transaction completed by ' + details.payer.name.given_name);
      }).catch( function(){
      	alert('Transcation Failed');
      } );
    }
  }).render('#paypal-button-container');

  $(".paytm_payment").click( function(){
    document.payment.submit();
  } );
});