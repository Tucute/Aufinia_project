<?php

namespace App\Http\Controllers;

use App\Mail\sendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use function Laravel\Prompts\alert;

class EmailController extends Controller
{
    public function SendEmail() {
        // $emailAddress = "thiendam052@gmail.com";
        // Mail::mailer('smtp')->to($emailAddress)->send(new sendEmail);
        // return "Chúc mừng bạn đã gửi email thành công!"; 
        return view('mail_information');
    }
}
