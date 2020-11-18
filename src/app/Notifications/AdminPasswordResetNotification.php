<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class AdminPasswordResetNotification extends ResetPasswordNotification
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->subject(Lang::get('パスワードリセット'))
            ->line(Lang::get('パスワードリセットを行う場合、以下のリンクをクリックしてください。'))
            ->action(Lang::get('Reset Password'), url(config('app.url').route('admin.password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
            ->line(Lang::get('パスワードリセットリンクの有効期限は:count秒です。', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->view(
                'mail.html.adminPasswordReset',
                [
                    'reset_url' => url('password/reset', $this->token),
                ]);
    }
}
