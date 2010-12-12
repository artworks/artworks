$(document).ready(function () {

    $('#address_town,#address_address').keyup(function () {

        country = $('#address_country').val();
        town = $('#address_town').val();
        address = $('#address_address').val();

        if ($('#address_town').val().length > 3) {
            $.ajax({
                type: "GET",
                url: generated_url_geo,
                dataType: 'json',
                data: { 'address': address, 'town': town, 'country': country },
                success: function (data) {
                    if (data.status == 'OK') {

                       // $('#address_geo').text(data.results[0].formatted_address);
                    	$("#address_geo option").remove();
                        $.each(data.results,
                             function (index, Element) {
                                 var option = new Option(this.formatted_address, index);
                                 // Use Jquery to get select list element
                                 var dropdownList = $("#address_geo")[0];
                               
                                 if ($.browser.msie) {
                                     dropdownList.add(option);
                                 }

                                 else {   
                                     dropdownList.add(option, null);  
                                 }
                             }
                         );

                    }
                },
                error: function (data) {
                    alert('Un probleme interne au site est survenu, veuilez retenter l\'opération plus tard');
                }
            });

        }
    });   

    $('#addToSelection').click(function (e) {
    	e.preventDefault();
    	   $.ajax({
               type: "GET",
               url: this.href,
               dataType: 'json',
               success: function (data) {
                   if (data.status==="success") {
                	   alert(i18n_generated_artwork_selected); 
                   }
                   else if(data.status==="allready_selected") {
                	   alert(i18n_generated_artwork_allready_selected);                	   
                   }
               }
    	   });
    });
    
    
});