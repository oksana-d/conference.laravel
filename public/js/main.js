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
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    }
        initMap();

    $('#datepicker').datepicker({
        endDate: "0d",
        autoclose: true,
    });

    var country = 'CA';
    $('#phone-number').mask(phoneMask[country]);
    $.mask.definitions['*'] = "[0-9]";
    $('body').on('change', '#country', function () {
        //console.log($('#country option:selected').val());
        var country = $('#country option:selected').val();
        $('#phone-number').mask(phoneMask[country]);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#first-form').validate({
        rules: {
            firstname: {
                required: true,
                maxlength: 50
            },
            lastname: {
                required: true,
                maxlength: 50
            },
            birthday: {
                required: true
            },
            reportSubject: {
                required: true,
                maxlength: 250
            },
            country: {
                required: true
            },
            phone: {
                required: true,
                maxlength: 50
            },
            email: {
                required: true,
                email: true,
                maxlength: 50,
                remote: {
                    url: '/checkExistsEmail',
                    type: 'post'
                }
            }
        },
        messages: {
            email: {
                remote: 'User with this email already exists.'
            }
        },
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                url: '/main/saveUserInfo',
                type: 'post',
                enctype: 'multipart/form-data',
                success: function (data) {
                    $('#filling-form').html(data);
                }
            });
        }
    });

    $('#second-form').validate({
        rules: {
            photo: {
                extension: "png|jpe?g|gif"
            }
        },
        messages: {
            photo: {
                extension: 'Only files .jpg, .png, .gif allowed.'
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url        : '/main/updateUserInfo',
                type       : 'post',
                dataType: 'text',
                data       : new FormData(form),
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#filling-form').html(data);
                }
            });
        }
    });
});
