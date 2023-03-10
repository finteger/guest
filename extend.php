<?php


namespace Finteger\Guest;


use Flarum\Extend;
use Finteger\Guest\Listeners\LimitGuestPosting;
use Finteger\Guest\Listeners\GuestUserListener;
use Flarum\Api\Middleware\ThrottleApi;
use Psr\Http\Message\ServerRequestInterface as Request;
use Flarum\Post\Post;
use Carbon\Carbon;
use Flarum\Http\AccessToken;

return [
  (new Extend\Frontend('forum'))
    ->js(__DIR__.'/js/dist/forum.js'),
    
    
    (new Extend\ThrottleApi())
        ->set('limitGuestRequests', function (Request $request) {
            
        if (! in_array($request->getAttribute('routeName'), ['guest.create'])) {
           return;
        }
            
        $throttler = $request;
    
        $route = in_array($request->getAttribute('routeName'), ['guest.create']);

        if ($route) {

        $lastPost = Post::where('ip_address', $request->getAttribute('ipAddress'))
        ->orderBy('created_at', 'desc')
        ->first();
        
       //$noob = AccessToken::where('last_ip_address', $request->getAttribute('ipAddress'))->first();
        //var_dump($noob);

     if ($lastPost && $lastPost->created_at->diffInMinutes(Carbon::now()) < 5) {
            return true;
         }
     }

     return false;
    }),


    (new Extend\Routes('api'))
        ->post('/guest', 'guest.create', Api\Controllers\GuestController::class),
        
    (new Extend\Event())
        ->subscribe(Listeners\LimitGuestPosting::class),
    
    
    (new Extend\Event())
        ->subscribe(Listeners\GuestUserListener::class) ,

];