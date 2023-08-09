<?php

namespace App\Providers;

use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\EloquentRepositoryInterface;
use App\Repository\Object\ObjectRepository;
use App\Repository\Object\ObjectRepositoryInterface;
use App\Repository\Sentence\SentenceRepository;
use App\Repository\Sentence\SentenceRepositoryInterface;
use App\Repository\Story\StoryRepository;
use App\Repository\Story\StoryRepositoryInterface;
use App\Repository\User\UserRepository;
use App\Repository\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(StoryRepositoryInterface::class, StoryRepository::class);
        $this->app->bind(SentenceRepositoryInterface::class, SentenceRepository::class);
        $this->app->bind(ObjectRepositoryInterface::class, ObjectRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}