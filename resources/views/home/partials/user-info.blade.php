<div class="card">

    <h5 class="card-header">
        <i class="fas fa-user-circle mr-1"></i>
        {{ $user->name }}
        <i class="fas fa-chalkboard-teacher float-right"></i>
    </h5>

    <div class="card-body">

        {{--Clock--}}
        <div class="flex flex-col gap-4 items-center justify-center">
            <div class="alert alert-secondary text-center w-100 p-1 text-muted font-bold" role="alert">
                <div class="dateTime d-inline-block">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </div>
            </div>
        </div>

        <p class="text-lg font-bold mb-3">
            <i class="fa-duotone fa-user mr-1"></i>
            {{ $user->name }}
        </p>

        <p class="font-bold text-gray-500 my-1">
            <i class="fa-duotone fa-phone mr-1"></i>
            {!! $user->phone_number ?? '<i class="fa-duotone fa-question-circle ml-1"></i>' !!}
        </p>

        <p class="font-bold text-gray-500 my-1">
            <i class="fa-duotone fa-envelope mr-1"></i>
            {{ $user->email }}
        </p>

        <p class="font-bold text-gray-500 my-1">
            <i class="fa-duotone fa-calendar mr-1"></i>
            {{ __('Joined') }}
            {{ $user->updated_at->diffForHumans() }}
        </p>

        <p class="font-bold text-gray-500 my-1">
            <i class="fa-duotone fa-calendar mr-1"></i>
            {{ __('Member Since') }}
            {{ $user->created_at->format('M d, Y') }}
        </p>
    </div>
</div>
