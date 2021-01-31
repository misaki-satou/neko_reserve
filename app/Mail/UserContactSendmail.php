<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserContactSendmail extends Mailable
{
    use Queueable, SerializesModels;
    private $radio;
    private $medical_record_number;
    private $family_name;
    private $given_name;
    private $family_name_kana;
    private $given_name_kana;
    private $cat_name;
    private $email;
    private $tel;
    private $entry_date;
    private $entry_start_time;
    private $entry_end_time;
    private $urls;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs, $urls)
    {
        $this->radio = $inputs['radio'];
        $this->medical_record_number= $inputs['medical-record-number'];
        $this->family_name  = $inputs['family-name'];
        $this->given_name = $inputs['given-name'];
        $this->family_name_kana = $inputs['family-name-kana'];
        $this->given_name_kana  = $inputs['given-name-kana'];
        $this->cat_name = $inputs['cat-name'];
        $this->email = $inputs['email'];
        $this->tel  = $inputs['tel'];
        $this->entry_date = $inputs['entry_date'];
        $this->entry_start_time = $inputs['entry_start_time'];
        $this->entry_end_time = $inputs['entry_end_time'];
        $this->urls = $urls;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('m-satou@baywave.com')
            ->subject('ねこの病院　予約完了メール')
            ->view('user.mail')
            ->with([
                'radio' => $this->radio,
                'medical_record_number' => $this->medical_record_number,
                'family_name' => $this->family_name,
                'given_name' => $this->given_name,
                'family_name_kana' => $this->family_name_kana,
                'given_name_kana'  => $this->given_name_kana,
                'cat_name' => $this->cat_name,
                'email' => $this->email,
                'tel'  => $this->tel,
                'entry_date' => $this->entry_date,
                'entry_start_time' => $this->entry_start_time,
                'entry_end_time' => $this->entry_end_time,
                'urls' => $this->urls,
            ]);
    }
}