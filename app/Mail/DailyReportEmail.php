<?php

namespace App\Mail;

use App\Models\{
    Sale,
    Seller
};
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $sales = [];
    protected $total = 0;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $date = Carbon::yesterday();
        $results = Sale::where('created_at','>=', $date)->get();
        $contador = 0;
        foreach ($results as $result){
            $sale = ['seller_email' => Seller::find($result->id)->email,'sale_value' => app(Sale::class)->formatValueFromTwelveDigits($result->sale_value)];
            array_push($this->sales,$sale);
            $contador += $sale['sale_value'];
        }
        $this->total = $contador;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $sales = $this->sales;
        $total = $this->total;
        return $this->view('email.dailyReportEmail')
                    ->from('matheus@teste')
                    ->with([
                        'sales' => $sales,
                        'total' => $total
                    ]);
    }
}
