<div class="row justify-content-center">
    @button([
        'type'      => 'submit',
        'class'     => 'btn btn-primary',
        'div_class' => 'col-sm-8 offset-sm-2',
        'href'      => '',
        'text'      => 'Confirm'
    ])

    @button([
        'type'      => '',
        'class'     => 'btn btn-secondary',
        'div_class' => 'col-sm-8 offset-sm-2',
        'href'      => route($route, $object), // PROVIDE x2
        'text'      => 'Cancel'
    ])
</div>
