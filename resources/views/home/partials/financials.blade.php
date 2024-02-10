<?php

use Carbon\Carbon;

//$formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
$lessonsComplete = $user->lessons->where('completed', 1);
$unPaid = $user->lessons->where('completed', 2)->sum('price');

$todayLessons = $lessonsComplete->filter(function ($lesson) {
    // Check if the lesson's start date is today
    return Carbon::parse($lesson->start_time)->isSameDay(Carbon::today());
});
$__todayLessons = $lessonsComplete->where('completed', 1)->filter(function ($lesson) {
    // Check if the lesson's start date is today
    return Carbon::parse($lesson->start_time)->isSameDay(Carbon::yesterday());
})->sum('price');
$diff_days = $todayLessons->sum('price') - $__todayLessons;

$weekLessons = $lessonsComplete->filter(function ($lesson) {
    // Check if the lesson's start date is within the current week
    return Carbon::parse($lesson->start_date)->between(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());
});
$__weekLessons = $lessonsComplete->filter(function ($lesson) {
    return Carbon::parse($lesson->start_date)
        ->between(Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek());
})->sum('price');
$diff_weeks = $weekLessons->sum('price') - $__weekLessons;

$monthLyLessons = $lessonsComplete->filter(function ($lesson) {
    return Carbon::parse($lesson->start_date)
        ->between(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
});
$__monthLyLessons =$lessonsComplete->filter(function ($lesson) {
    return Carbon::parse($lesson->start_date)
        ->between(Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth());
})->sum('price');
$diff_month = $monthLyLessons->sum('price') - $__monthLyLessons;

?>

<div class="dark:bg-slate-900 bg-gray-100 rounded-lg !p-4 flex flex-col !gap-4">
    <div class="flex flex-wrap !gap-2 align-items-end  justify-between">
        <h2 class="text-xl font-extrabold dark:text-white"><i class="fa-duotone fa-money-bill mr-1"></i>Finance</h2>
        <div class=" ">
            <div class=" font-bold text-lg text-green-600">
                ${{number_format($lessonsComplete->sum('price'), 2, ',', ' ')}}</div>
        </div>
    </div>
    <hr class=" border-gray-500">
    <div class="flex flex-col !gap-4">
        <!-- Financial Metrics -->
        <div class="financial-metrics">
            <div class="flex justify-between flex-wrap !gap-3">
                <div class="text-gray-500 font-semibold">Paid</div>
                <div class=" font-bold text-sm text-green-600"> ${{number_format($lessonsComplete->sum('price'), 2, ',', ' ')}}</div>
            </div>
            <div class="flex justify-between flex-wrap !gap-2">
                <div class="text-gray-500 font-semibold">Unpaid</div>
                <div class=" font-bold text-sm text-green-600"> ${{number_format($unPaid, 2, ',', ' ')}}</div>
            </div>
        </div>
        <hr class=" border-gray-500">
        <!-- Financial Summary -->
        <div class="summary-item">
            <div class="text-xs font-bold uppercase">Daily</div>
            <div class="  text-right">
                <div class=" ">${{number_format($todayLessons->sum('price'), 2, ',', ' ')}}</div>
                <div class="text-sm">
                    <span class="{{$diff_days>0 ?'text-green-600':'text-red-500' }} font-bold">
                        <i class="fa-solid  {{$diff_month>0 ?'fa-arrow-up':'fa-arrow-down' }}"></i>
                    ${{number_format($diff_days, 2, ',', ' ')}}
                    </span>
                    from yesterday
                </div>
            </div>
        </div>
        <div class="summary-item">
            <div class="text-xs font-bold uppercase">Weekly</div>
            <div class="details text-right">
                <div class=" ">${{number_format($weekLessons->sum('price'), 2, ',', ' ')}}</div>
                <div class="text-sm">
                    <span class="{{$diff_weeks>0 ?'text-green-600':'text-red-500' }} font-bold">
                        <i class="fa-solid  {{$diff_month>0 ?'fa-arrow-up':'fa-arrow-down' }}"></i>
                    ${{number_format($diff_weeks, 2, ',', ' ')}}
                    </span>
                    from yesterday
                </div>
            </div>
        </div>
        <div class="summary-item">
            <div class="text-xs font-bold uppercase">Monthly</div>
            <div class="details text-right">
                <div class=" ">${{number_format($monthLyLessons->sum('price'), 2, ',', ' ')}}</div>
                <div class="text-sm">
                    <span class="{{$diff_month>0 ?'text-green-600':'text-red-500' }} font-bold">
                        <i class="fa-solid  {{$diff_month>0 ?'fa-arrow-up':'fa-arrow-down' }}"></i>
                    ${{number_format($diff_month, 2, ',', ' ')}}
                    </span>
                    from yesterday
                </div>
            </div>
        </div>
    </div>
</div>
