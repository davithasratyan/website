<?php

use App\Models\Contacts;
use Illuminate\Support\Facades\Cache;

function getAllIcons()
{
    return Cache::remember('all_icons', now()->addMinutes(3), function () {
        return Contacts::all();
    });
}

function getTelegram()
{
    return Cache::remember('telegram_contacts', now()->addMinutes(3), function () {
        return Contacts::where('icon', 'telegram')->get();
    });
}
