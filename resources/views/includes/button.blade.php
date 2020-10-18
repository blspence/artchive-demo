<div class="form-group row mb-0">
    <div class="{{ $div_class }}">
        @if(empty($href))
            <button style="margin:5px;"
                    type="{{ $type }}"
                    class="{{ $class }}">{{ $text }}</button>
        @else
            <a style="margin:5px;"
               href="{{ $href }}"
               class="{{ $class }}">{{ $text }}</a>
        @endif
    </div>
</div>
