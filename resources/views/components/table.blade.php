<div class="row">
    <div class="col col-sm-3">
        <h2 class="text-left">{{ $title }}</h2>
    </div>

    <div class="col col-sm-9 text-md-right">
        {{ $search_form }}
    </div>
</div>
<br>
<table class="table table-striped">

    {{ $thead }}

    <tbody>
        {{ $tbody }}
    </tbody>

</table>
