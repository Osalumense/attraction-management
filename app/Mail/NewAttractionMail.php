<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Attractions;

class NewAttractionMail extends Mailable implements ShouldQueue
{

    use Queueable, SerializesModels;

    public $attraction;
    public $imagePath;

    /**
     * Create a new message instance.
     *
     * @param $attraction
     * @param bool $hasImage
     */
    public function __construct($attraction, $imagePath)
    {
        $this->attraction = $attraction;
        $this->imagePath = $imagePath;
    }

    public function build()
    {
        $email = $this->subject('New Attraction Created')
                      ->view('emails.attractions.new')
                      ->with([
                          'attraction' => $this->attraction,
                          'imageUrl' => $this->imagePath ?: null,
                      ]);


        //Moved to cloudinary to ensure images are shown in the email
        // if ($this->imagePath) {
        //     $fullPath = public_path($this->imagePath);
        //     $email->attach($fullPath, [
        //         'as' => 'Attraction Image',
        //         'mime' => 'image/png',
        //     ]);
        // }
        return $email;
    }
    
}