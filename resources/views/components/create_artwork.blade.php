
<div class="create_artwork_component">
        <h2>Artwork</h2>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title @required_field @endrequired_field</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="title[]" id="title" placeholder="Title" required>
                <small id="titlepHelpBlock" class="form-text text-muted">
                    Minimum of 3 characters, maximum of 255.
                </small>
            </div>
        </div>

        @if($exhibit->type=="ANNUAL_STUDENT_SHOW")
            <div class="form-group row">
                <label for="instructor" class="col-sm-2 col-form-label">Instructor @required_field @endrequired_field</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="instructor[]" id="instructor" placeholder="Instructor" required>
                    <small id="instructorHelpBlock" class="form-text text-muted">
                        Minimum of 3 characters, maximum of 255.
                    </small>
                </div>
            </div>
            <div class="form-group row">
                <label for="course" class="col-sm-2 col-form-label">Course @required_field @endrequired_field</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="course[]" id="course" placeholder="Course" required>
                    <small id="courseHelpBlock" class="form-text text-muted">
                        Minimum of 3 characters, maximum of 255.
                    </small>
                </div>
            </div>
            <div class="form-group row">
                <label for="semester" class="col-sm-2 col-form-label">Semester @required_field @endrequired_field</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="semester[]" id="semester" placeholder="Winter 2019" required>
                    <small id="semesterHelpBlock" class="form-text text-muted">
                        Minimum of 3 characters, maximum of 255.
                    </small>
                </div>
            </div>
        @endif

        <div class="form-group row">
            <label for="medium" class="col-sm-2 col-form-label">Medium @required_field @endrequired_field</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="medium[]" id="medium" placeholder="Medium" required>
                <small id="mediumHelpBlock" class="form-text text-muted">
                    Minimum of 3 characters, maximum of 255.
                </small>
            </div>
        </div>

        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Description @required_field @endrequired_field</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="description[]" placeholder="Description" id="description" rows="4" required></textarea>
                <small id="descriptionHelpBlock" class="form-text text-muted">
                    Minimum of 3 characters, maximum of 255.
                </small>
            </div>
        </div>
        <div class="input-group control-group">
            <label for="submission_photo" class="col-sm-2 col-form-label">Upload Photo @required_field @endrequired_field</label>
            <div class="col-sm-10">
                <input type="file" name="submission_photo[]" id="submission_photo" class="form-control" required>
            </div>
        </div>
    </div>
