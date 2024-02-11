
<div class="bg-gray-100 rounded-lg !p-4 flex flex-col !gap-4">
    <div class="flex flex-wrap !gap-2 align-items-end  justify-between">
        <h2 class="text-xl font-extrabold   ">
            <i class="fa-duotone fa-user-circle mr-1"></i>{{ $user->name }}</h2>
        <div class=" ">

        </div>
    </div>
    <hr class=" border-gray-500">
    <div class="flex flex-col !gap-4">
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
            {!! $user->information->cell_phone  ?? '<i class="fa-duotone fa-question-circle ml-1"></i>' !!}
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
