<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class ResetPassword extends ResetPasswordNotification
{
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(trans('notifications.email.password-reset.action'))
                    ->line(trans('notifications.email.password-reset.reason'))
                    ->action(trans('notifications.email.password-reset.action'), url('password/reset', $this->token))
                    ->line(trans('notifications.email.password-reset.explanation'));
    }
}
