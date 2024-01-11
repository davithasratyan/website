<?php

use App\Models\Contacts;
function getAllIcons ()
{
    return Contacts::all();
}

function getTelegram()
{
    return Contacts::where('icon', 'telegram')->get();
}
