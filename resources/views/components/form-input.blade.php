<div class="form-group">
    <label>{{ $label }}
        @if ($isRequired == 'true')
            <span class="text-danger">*</span>
        @endif
    </label>
    <input type="{{ $type }}" class="form-control" placeholder="{{ $placeholder }}" name="{{ $name }}"
        value="{{ old($name,$data['name']) }}">

    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
