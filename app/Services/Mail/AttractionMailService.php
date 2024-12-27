<?php

namespace App\Services\Mail;

use App\Models\Attractions;
use App\Mail\NewAttractionMail;
use Illuminate\Support\Facades\Mail;

class AttractionMailService
{
    /**
     * Send email notification for new attraction
     *
     * @param Attractions $attraction
     * @return void
     */
    // public function sendNewAttractionNotification(Attractions $attraction)
    // {
    //     /// Check if image exists before sending
    //     print_r("Sending to the mail");
    //     if ($attraction->image_path && \Storage::disk('public')->exists($attraction->image_path)) {
    //         Mail::to(config('mail.admin.address'))->queue(new NewAttractionMail($attraction));
    //     } else {
    //         // Send email without image
    //         Mail::to(config('mail.admin.address'))->queue(new NewAttractionMail($attraction, false));
    //     }
    // }

    public function sendAttractionCreatedEmail($adminEmail, $attractionData, $imagePath)
    {
        Mail::to($adminEmail)->send(new NewAttractionMail($attractionData, $imagePath));
    }
}