{{-- The fields for an experimental space submission  --}}
<div class="experimental_component">

    {{-- check if student is applying as an individual student or on behalf of an RSO--}}
    <div class="form-group row">
        <label for="rso" class="col-sm-2 col-form-label">Are you applying as an individual student or an RSO? @required_field @endrequired_field</label>
        <div class="col-sm-10">
            <div class="radio">
                <input id="individual_student" name="rso" checked="checked" type="radio" value="0">
                <label for="individual_student">Individual Student</label>
            </div>
            <div class="radio">
                <input id="RSO" name="rso" type="radio" value="1">
                <label for="RSO">RSO</label>
            </div>
        </div>
    </div>

    {{-- RSO Name --}}
    <div class="form-group row">
        <label for="rso_name" class="col-sm-2 col-form-label">What is the name of your RSO? (if applicable)</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="rso_name" id="rso_name" placeholder="RSO Name">
        </div>
    </div>

    {{-- RSO Number of participants--}}
    <div class="form-group row">
        <label for="rso_num_participants" class="col-sm-2 col-form-label">How many people from your RSO will participate (if applicable)?</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="rso_num_participants" id="rso_num_participants" placeholder="1" value="1">
        </div>
    </div>

    {{-- RSO Faculty Adviser--}}
    <div class="form-group row">
        <label for="faculty_adviser" class="col-sm-2 col-form-label">Who is your Faculty Adviser (if applicable)?</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="faculty_adviser" id="faculty_adviser" placeholder="Faculty Adviser">
        </div>
    </div>
        <p>How many wall spaces are you requesting? Depending on the size of the work, 1-4
            pieces can fit on one wall panel. This is also dependent on the number of people
            who are participating (if a RSO) and how many people are requesting spaces.
            Pedestals can be requested along with or instead of wal spaces.
        </p>

    {{-- Num walls--}}
    <div class="form-group row">
        <label for="walls" class="col-sm-2 col-form-label">Wall(s) @required_field @endrequired_field</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="walls" id="walls" value="0">
        </div>
    </div>

    {{-- Num pedestals--}}
    <div class="form-group row">
        <label for="pedestals" class="col-sm-2 col-form-label">Pedestal(s) @required_field @endrequired_field</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="pedestals" id="pedestals" value="0">
        </div>
    </div>

    <!-- brick okay checkbox-->

    <p>The brick wall may be an option depending on interest for space in the
        Gallery. Please indicate if you are okay with using the brick wall
        (if necessary).
    </p>

    <div class="form-group row">
        <label for="brick_ok" class="col-sm-2 col-form-label">I am okay with brick</label>
        <div class="col-sm-10">
            <input type="checkbox" checked="checked" id="brick_ok" name="brick_ok"  value="yes"> yes
        </div>
    </div>

    {{-- Technology requirements/additional resources--}}
    <p>Please indicate if you will need an outlet or any technology to facilitate
            your mini exhibition. The Gallery has limited resources which will be granted
            in application submission order.
    </p>
    <div class="form-group row">
        <label for="additional_resources" class="col-sm-2 col-form-label">
            Additional Resources
        </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="additional_resources" id="additional_resources" placeholder="Additional Resources">
        </div>
    </div>

</div>
