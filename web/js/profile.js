$(document).ready(function () {
	
	 $('.delete-address').click(function (e) {
		 form = $(this).closest("form");
		 e.preventDefault();
         $.ajax({
             type: "POST",
             url: generated_url_delete_address,
             dataType: 'json',
             data: form.serialize(),
             success: function (data) {
            	 $(form).hide();
             },
             error: function (data) {
                 alert('Un probleme interne au site est survenu, veuilez retenter l\'opération plus tard');
             }
         });
	 });
	 
	 $('.discard-delivery-address,.discard-billings-address').click(function (e) {
		 form = $(this).closest("form");
		 e.preventDefault();
         $.ajax({
             type: "POST",
             url: generated_url_flag_address,
             dataType: 'json',
             data: form.serialize()+"&flag=3",
             success: function (data) {
            	 alert('Operation successful');
             },
             error: function (data) {
                 alert('Un probleme interne au site est survenu, veuilez retenter l\'opération plus tard');
             }
         });
	 });
	 
	 
	 $('.make-delivery-address').click(function (e) {
		 form = $(this).closest("form");
		 e.preventDefault();
         $.ajax({
             type: "POST",
             url: generated_url_flag_address,
             dataType: 'json',
             data: form.serialize()+"&flag=2",
             success: function (data) {
            	alert('Operation successful');
             },
             error: function (data) {
                 alert('Un probleme interne au site est survenu, veuilez retenter l\'opération plus tard');
             }
         });
	 });
	 
	 $('.make-billing-address').click(function (e) {
		 form = $(this).closest("form");
		 e.preventDefault();
         $.ajax({
             type: "POST",
             url: generated_url_flag_address,
             dataType: 'json',
             data: form.serialize()+"&flag=1",
             success: function (data) {
            	 alert('Operation successful');
             },
             error: function (data) {
                 alert('Un probleme interne au site est survenu, veuilez retenter l\'opération plus tard');
             }
         });
	 });


});