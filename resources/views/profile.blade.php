<form id="second-form">
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" maxlength="50" class="form-control" name="company">
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" maxlength="50" class="form-control" name="position">
            </div>
        </div>
        <div class="col-md-4 col-xl-4">
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" name="photo">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="aboutMe">About me</label>
                <textarea class="form-control" maxlength="255" name="aboutMe" rows="6"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-success float-right">Finish</button>
        </div>
    </div>
</form>
<script>
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
                url        : '/updateUserInfo',
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
</script>
