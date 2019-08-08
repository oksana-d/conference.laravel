(function () {
  function initMap () {
    let opt = {
      center: { lat: 34.101511, lng: -118.343705 },
      zoom: 16
    }

    let map = new google.maps.Map(document.getElementById('map'), opt)
    let marker = new google.maps.Marker({
      position: opt.center,
      map: map
    })
    let infowindow = new google.maps.InfoWindow({
      content: '7060 Hollywood Blvd, Los Angeles, CA'
    })
    marker.addListener('click', function () {
      infowindow.open(map, marker)
    })
  }

  if ($('#map').length !== 0) {
    initMap()
  }

  $('#datepicker').datepicker({
    endDate: '0d',
    autoclose: true
  })

  $('#phone-number').mask(phoneMask['CA'])
  $.mask.definitions['*'] = '[0-9]'
  $('#country').change(function () {
    let country = $(this).val()
    $('#phone-number').mask(phoneMask[country])
  })

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })

  $('#first-form').submit(function (e) {
    e.preventDefault()
    let data = new FormData(this)
    axios.post('/saveUserInfo', data)
      .then((response) => {
        $('#filling-form').html(response['data'])
      })
      .catch((error) => {
        const errors = error.response.data.errors
        console.log(errors)
        $('#firstname-error').empty()
        $('#lastname-error').empty()
        $('#birthday-error').empty()
        $('#email-error').empty()
        $('#country-error').empty()
        $('#phone-error').empty()
        $('#reportSubject-error').empty()

        $('#firstname-error').append(errors['firstname'])
        $('#lastname-error').append(errors['lastname'])
        $('#birthday-error').append(errors['birthday'])
        $('#email-error').append(errors['email'])
        $('#country-error').append(errors['country'])
        $('#phone-error').append(errors['phone'])
        $('#reportSubject-error').append(errors['reportSubject'])
      })
  })

  $(document).on('submit', '#second-form', function (e) {
    e.preventDefault()
    let data = new FormData(this)
    axios.post('/updateUserInfo', data)
      .then((response) => {
        $('#filling-form').html(response['data'])
      })
      .catch((error) => {
        console.log(error.response)
        const errors = error.response.data.errors
        console.log(errors)
        $('#photo-error').empty()
        $('#photo-error').append(errors['photo'])
      })
  })

  $(document).on('change', '#photo', function () {
    $('#photo-error').empty()
    if (this.files[0].size > 2000000) {
      $('#photo-size-error').html('File must be less than 2 mb.')
      $('#submit').prop('disabled', true)
    } else {
      $('#submit').prop('disabled', false)
      $('#photo-size-error').empty()
    }
  })

  $(':checkbox').change(function () {
    let id = $(this).val()
    console.log($(this).val())
    axios.put('/admin' + '/changeUserInfo/' + id)
      .then(function (response) {
        console.log($(this).id)
        $("label[for='userCheckBox" + id + "']").html(response['data']['message'])
      })
      .catch(function () {
        console.log('Error: show user failed')
      })
  })
})()
