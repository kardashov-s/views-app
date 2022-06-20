<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

abstract class AbstractNotification extends Notification
{
    use Queueable;

    public function fullContent()
    {
        return $this->content;
    }

    public function shouldBeSentBySlack(): bool
    {
        return true;
    }
}
