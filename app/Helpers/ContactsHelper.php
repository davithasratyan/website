<?php
use App\Models\FeedBack;
use Illuminate\Support\Facades\Cache;

function getContact()
{
    return Cache::remember('feedback_contacts', now()->addMinutes(3), function () {
        return FeedBack::all();
    });
}

