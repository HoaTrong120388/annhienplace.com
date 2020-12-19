<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail, FCommon;

class SendPostEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data;

    public function __construct()
    {
        // $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [
            'email'     => 'ttronghoa12388@gmail.com',
            'subject'   => 'Mail gửi từ laravel'.str_random(40),
            'body'      => 'Nội dung đơn giản thôi nhé'
        ];
        Mail::send('backend.mail.alert', $data, function ($message) use ($data) {
            $message->from('admin@hoa.name.vn', 'Hoa Babe');
            $message->to('ttronghoa12388@gmail.com', 'John Doe');
            $message->bcc('ttronghoa120388@gmail.com', 'John Doe');
            $message->subject($data['subject']);
        });
    }
}
