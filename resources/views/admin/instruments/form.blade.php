@push('css')
@endpush

@push('js')
@endpush

<form action="{{ route('admin.instruments.store') }}" method="POST">
    @csrf

    {{--Create Instrument--}}
    <div class="card mb-1">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h5>
                        <i class="fa-solid fa-guitar mr-1"></i>
                        Create Instrument
                    </h5>
                </div>
                <div class="col-12">
                    {{--Errors--}}
                    @if( $errors->any() )
                        <span
                            class="alert alert-danger text-center py-1 w-100 my-1 animate__animated animate__zoomIn d-inline-block">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            <strong>Whoops!</strong>
                            <p>Please fix the errors and try again.</p>
                        </span>
                    @endif
                    {{--Badge Message--}}
                    @if( session('badgeMessage') )
                        <span
                            class="alert alert-success text-center py-1 w-100 mb-0 animate__animated animate__zoomIn d-inline-block">
                            <i class="fas fa-check-circle mr-1"></i>
                            <strong>{{ session('badgeMessage') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            {{--Name Input--}}
            <div class="form-group">
                <label for="name" class="d-none"></label>
                <input type="text"
                       name="name"
                       id="name"
                       class="form-control w-100 @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       placeholder="Name"
                       required
                       autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        {{ $message }}
                    </strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success bg-success btn-sm px-4 float-right save-btn">
                <i class="fas fa-save mr-1"></i>
                Save
            </button>
        </div>
    </div>
</form>
