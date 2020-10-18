
<div class="create_experimental_proposal">
    <h3>Project Proposal</h3>
    <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label">Title @required_field @endrequired_field</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="title[]" id="title" placeholder="Title" required>
            <small id="titleHelpBlock" class="form-text text-muted">
                Minimum of 3 characters, maximum of 255.
            </small>
        </div>
    </div>

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
            <textarea class="form-control" name="description[]" id="description" placeholder="Description" rows="4" required></textarea>
            <small id="descriptionHelpBlock" class="form-text text-muted">
                Minimum of 3 characters, maximum of 255.
            </small>
        </div>
    </div>
    <div class="input-group control-group row">
        <label for="submission_photo" class="col-sm-2 col-form-label">Exhibit Map @required_field @endrequired_field</label>
        <div class="col-sm-10">
            <input type="file" name="submission_photo[]" id="description" class="form-control" aria-describedby="mapHelpBlock" required>
            <small id="mapHelpBlock" class="form-text text-muted">
                The Exhibit map is a photograph or illustration of the layout of your installation.
            </small>
        </div>
    </div>
</div>
