$(document).ready(function () {

    $('#town,#address').keyup(function () {

        country = $('#prospects_country').val();
        town = $('#town').val();
        address = $('#address').val();

        if ($('#town').val().length > 3) {
            $.ajax({
                type: "GET",
                url: '/geo/geoSearch',
                dataType: 'json',
                data: { 'address': address, 'town': town, 'country': country },
                success: function (data) {
                    if (data.status == 'OK') {

                       // $('#prospects_geo').text(data.results[0].formatted_address);

                        $.each(data.results,
                             function (index, Element) {
                                 var option = new Option(this.formatted_address, index);
                                 // Use Jquery to get select list element
                                 var dropdownList = $("#prospects_geo")[0];

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

});