<?php

namespace App\Http\Controllers;

use App\Mail\DeliveryReminderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CronJobController extends Controller
{
    public function reminders()
    {
        $email = 'dhruba@webomindapps.com';
        Mail::to($email)->send(new DeliveryReminderMail);
    }
}
