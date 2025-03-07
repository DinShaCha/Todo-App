<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Event Broadcasting Channels
|--------------------------------------------------------------------------
|
| Define all the broadcasting channels supported by your application here.  
| The provided authorization callbacks determine if an authenticated user  
| has permission to listen to a specific channel.  
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
