$(document).ready(function () {
    function initMap() {
        var opt = {
            center: {lat: 34.101511, lng: -118.343705},
            zoom: 16
        };

        var map = new google.maps.Map(document.getElementById("map"), opt);
        var marker = new google.maps.Marker({
            position: opt.center,
            map: map
        });
        var infowindow = new google.maps.InfoWindow({
            content: "7060 Hollywood Blvd, Los Angeles, CA"
        });
        marker.addListener('click', function () {
            infowindow.open(map, marker);
        });
    }
    if (!$('#map').length == 0) {
        initMap();
    }

    $('#datepicker').datepicker({
        endDate: "0d",
        autoclose: true,
    });

    var country = 'CA';
    $('#phone-number').mask(phoneMask[country]);
    $.mask.definitions['*'] = "[0-9]";
    $('#country').change(function () {
        var country = this.val();
        $('#phone-number').mask(phoneMask[country]);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#first-form').submit(function (e) {
        e.preventDefault();

        axios.post('/saveUserInfo', {
           'firstname' : $("input[name='firstname']").val(),
            'lastname' : $("input[name='lastname']").val(),
            'birthday' : $("input[name='birthday']").val(),
            'email' : $("input[name='email']").val(),
            'country' : $("#country").val(),
            'phone' : $("input[name='phone']").val(),
            'reportSubject' : $("input[name='reportSubject']").val(),

        })
            .then( (response) => {
                $('#filling-form').html(response['data']);
            })
            .catch( (error) => {
                //console.log(error.response);
                const errors = error.response.data.errors;
                console.log(errors);
                $('#firstname-error').empty();
                $('#lastname-error').empty();
                $('#birthday-error').empty();
                $('#email-error').empty();
                $('#country-error').empty();
                $('#phone-error').empty();
                $('#reportSubject-error').empty();

                $('#firstname-error').append(errors['firstname']);
                $('#lastname-error').append(errors['lastname']);
                $('#birthday-error').append(errors['birthday']);
                $('#email-error').append(errors['email']);
                $('#country-error').append(errors['country']);
                $('#phone-error').append(errors['phone']);
                $('#reportSubject-error').append(errors['reportSubject']);
            });
    });

    $('#second-form').submit(function (e) {
        e.preventDefault();

        axios.post('/updateUserInfo', {
            'company' : $("input[name='company']").val(),
            'position' : $("input[name='position']").val(),
            'photo' : $('#photo').type,
            'aboutMe' : $("textarea[name='aboutMe']").val()

        })
            .then( (response) => {
                $('#filling-form').html(response['data']);
            })
            .catch( (error) => {
                console.log(error.response);
                const errors = error.response.data.errors;
                console.log(errors);
            });
    });

    function  validate() {
        $(document).on('change', '#photo', function () {

            if (this.files[0].size > 2000000) {
                $("#photo-size-error").html("File must be less than 2 mb.");
                $('#submit').prop('disabled', true);
            } else {
                $('#submit').prop('disabled', false);
                $("#photo-size-error").empty();
            }
        });
    }
    validate();

    $(':checkbox').change(function () {
        axios.put('/admin' + '/changeUserInfo/' + $(this).val())
            .then(function (response) {
                console.log(response['data']);
            })
            .catch(function () {
                console.log('Error: show user failed')
            })

    });

});
