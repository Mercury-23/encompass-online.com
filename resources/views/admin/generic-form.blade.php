{{-- resources/views/components/generic-form.blade.php --}}

<form method="POST" action="{{ $action }}">
    @csrf
    @method($method ?? 'POST')

    @foreach($attributes as $attribute => $value)
        <div class="form-group">
            <label for="{{ $attribute }}">{{ ucfirst($attribute) }}</label>

            {{-- Determine the type of input, add more conditions as needed --}}
            @if(is_bool($value))
                <input type="checkbox" name="{{ $attribute }}" id="{{ $attribute }}" {{ $value ? 'checked' : '' }}>
            @else
                <input type="text" name="{{ $attribute }}" id="{{ $attribute }}" value="{{ old($attribute, $value) }}" class="form-control">
            @endif

            {{-- Error Handling --}}
            @error($attribute)
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
