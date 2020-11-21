<?php

namespace GDebrauwer\Hateoas\Tests\App\Providers;

use GDebrauwer\Hateoas\Tests\App\Message;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::post('message', function () {
            return [
                'id' => 1,
                'text' => 'Hello world!',
            ];
        })->name('message.store');

        Route::get('message/{message}', function (Message $message) {
            return $message;
        })->name('message.show');

        Route::put('message/{message}', function (Message $message) {
            return $message;
        })->name('message.update');

        Route::post('message/{message}/reply', function (Message $message) {
            return [
                'id' => 3,
                'text' => 'Thank you!',
            ];
        })->name('message.reply');

        Route::delete('message/{message}', function (Message $message) {
            return response(null);
        })->name('message.destroy');
    }
}
