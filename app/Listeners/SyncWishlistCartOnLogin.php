<?php

namespace App\Listeners;

use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\WishlistController;
use Illuminate\Auth\Events\Login;
use IlluminateAuthEventsLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SyncWishlistCartOnLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \IlluminateAuthEventsLogin  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $userId = $event->user->id;
        $wishlistController = new WishlistController();
        $cartController = new CartController();
        $wishlistController->synceWishlistFromSessionToUser($userId);
        $cartController->synceCartFromSessionToUser($userId);
    }
}
