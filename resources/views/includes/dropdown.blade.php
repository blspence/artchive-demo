
@if(!empty($label))
    <div class="form-group row align-items-center">

            <div class="col-sm-4 text-md-right">
                <label class="form-label" for="{{ $attribute }}">
                    <strong>{{ $label }}</strong>
                </label>
            </div>

            <div class="col-sm-8">
@endif
                <select class="custom-select" style="width: 100% !important;" name="{{ $attribute }}" aria-label="select">

                    @foreach ($options as $value)
                        @if($condition == $value)
                            @if(strpos($value, 'All') !== false)
                                {{-- Don't include a value if searching for 'All*' of anything --}}
                                <option value="" selected>{{ $value }}</option>
                            @else
                                <option value="{{ $value }}" selected>{{ $value }}</option>
                            @endif
                        @else
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endif
                    @endforeach

                </select>
@if(!empty($label))
            </div>
        </div>
@endif
