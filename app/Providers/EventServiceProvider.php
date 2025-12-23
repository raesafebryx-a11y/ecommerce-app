<?php
use Illuminate\Auth\Events\Login;
use App\Listeners\MergeCartListener;
se Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
  protected $listen = [
    Login::class => [
        MergeCartListener::class,
    ],
  ];
}
