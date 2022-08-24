<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;

class NewPostNotification extends Notification
{
    use Queueable;

    public $post;
    public $postedBy;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post, $postedBy)
    {
        $this->post = $post;
        $this->postedBy = $postedBy;
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
        if($this->postedBy == 'author'){
            return (new MailMessage)
                        ->greeting('Hello'. env('APP_NAME'))
                        ->subject('New post approval needed.')
                        ->line('New post by ' . $this->post->user->name . 'need to approve')
                        ->line('To approve the post click view button')
                        ->action('View Post', url(route(app()->master->routePrefix . 'post.show', Crypt::encrypt($this->post->id))))
                        ->line('Thank you for using our application!');
        }
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
