<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class EmailVerificationCodeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $code = Str::random(6);
        Cache::put($notifiable->email, $code, 60 * 5);

        return (new MailMessage)
                    ->subject('استعادة كلمة المرور')
                    ->line('تم إرسال هذه الرسالة إليك بناءً على طلب إعادة تعيين كلمة مرور حسابك. إذا كنتَ أنت، يُرجى تأكيد الطلب باستخدام رمز التحقق أدناه. إذا لم تكن أنت، فتجاهل هذه الرسالة.')
                    ->line("{$code} :رمز التحقق ")
                    ->line("الرمز صالح لمدة خمس دقائق فقط");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
