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
                <input type="file" name="photo" id="photo">
                <div id="photo-error" class="error"></div>
                <div id="photo-size-error" class="error" for="photo"></div>
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
            <button id="submit" type="submit" class="btn btn-success float-right">Finish</button>
        </div>
    </div>
</form>
<script>
