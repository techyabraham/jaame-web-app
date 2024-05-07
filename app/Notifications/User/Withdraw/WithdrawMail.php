<?php

namespace App\Notifications\User\Withdraw;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;

class WithdrawMail extends Notification
{
    use Queueable;

    public $user;
    public $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {


        $user = $this->user;
        $data = $this->data;
        $trx_id = $this->data->trx_id;
        $date = Carbon::now(); 
        $dateTime = $date->format('Y-m-d h:i:s A');
        if($data->gateway_type == "MANUAL"){
            $status = "Pending";
        }else{
            $status = "Success";
        }
        return (new MailMessage)
            ->greeting("Hello ".$user->fullname." !")
            ->subject("Withdraw Money Via ". $data->gateway_name.' ('.$data->gateway_type.' )')
            ->line("Your withdraw money request send successfully via ".$data->gateway_name." , details of withdraw money:")
            ->line("Transaction Id: " .$trx_id)
            ->line("Request Amount: " . getAmount($data->amount,4).' '.$data->sender_currency)
            ->line("Exchange Rate: " ." 1 ". $data->sender_currency.' = '. getAmount($data->exchange_rate,4).' '.$data->gateway_currency)
            ->line("Fees & Charges: " . getAmount($data->gateway_charge,4).' '.$data->gateway_currency)
            ->line("Will Get: " .  get_amount($data->will_get,$data->gateway_currency,'',4))
            ->line("Total Payable Amount: " . get_amount($data->payable,$data->sender_currency,'4'))
            ->line("Status: ". $status)
            ->line("Date And Time: " .$dateTime)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
