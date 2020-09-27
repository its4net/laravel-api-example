<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class StockGain extends Notification
{
    use Queueable;

    /**
     * StockQuote object with info on stock
     * @var StockQuote
     */
    public $stock;
    
    /**
     * Percentage of stock gain
     * @var float
     */
    public $percent;

    /**
     * Create a new notification instance.
     *
     *@param StockQuote $stock
     *@param float $percent
     * @return void
     */
    public function __construct($stock, $percent)
    {
        $this->stock = $stock;
        $this->percent = $percent;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'stock' => $this->stock->symbol,
            'message' => "You have a gain of {$this->percent}%"
        ];
    }
}
