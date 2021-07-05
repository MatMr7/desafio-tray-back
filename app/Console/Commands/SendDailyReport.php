<?php

namespace App\Console\Commands;

use App\Mail\DailyReportEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:send {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a daily sales report';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');
        $this->info("Sending email to: $email!");
        Mail::to($email)->send(new DailyReportEmail);
        $this->info("Email Sended to: $email!");

    }
}
