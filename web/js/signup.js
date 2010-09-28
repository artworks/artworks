$(document).ready(function () {

    $('#town').keyup(function () {

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
                        $('#suggest').text(data.results.formatted_address);
                    }
                },
                error: function (data) {
                    alert('Un probleme interne au site est survenu, veuilez retenter l\'opération plus tard');
                }
            });

        }
    });




});