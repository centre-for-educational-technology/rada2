<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Activity;
use App\Game;
use App\ActivityItem;
use App\DiscountVoucher;

class MigratePublicStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:public:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrates public storage to a new structure.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Return full path to certain file or directory
     * @param  string $path Path within storage directory
     * @return string       Full path to file or directory
     */
    private function publicImagesUploadPath($path)
    {
        return public_path("uploads/images/$path");
    }

    /**
     * Recursively create directories for the given path
     * @param  string $path Full path to directory
     * @return void
     */
    private function recursiveCreateDirectory($path)
    {
        if ( !File::isDirectory($path) )
        {
            File::makeDirectory($path, 0755, true);
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $migratedCounts = [
            'activity' => 0,
            'game' => 0,
            'item' => 0,
            'voucher' => 0,
        ];

        Activity::withTrashed()->chunk(50, function($activities) use (&$migratedCounts)
        {
            foreach ( $activities as $activity )
            {
                if ( !!$activity->featured_image )
                {
                    $imageFullPath = $this->publicImagesUploadPath($activity->featured_image);
                    if ( File::exists($imageFullPath) && File::isFile($imageFullPath) )
                    {
                        $this->recursiveCreateDirectory($this->publicImagesUploadPath("activities/{$activity->id}"));
                        File::move($imageFullPath, $this->publicImagesUploadPath("activities/{$activity->id}/{$activity->featured_image}"));
                        $migratedCounts['activity'] += 1;
                    }
                }
            }
        });

        Game::chunk(50, function($games) use (&$migratedCounts)
        {
            foreach ( $games as $game )
            {
                $oldFullStoragePath = $this->publicImagesUploadPath($game->id);
                if ( File::exists($oldFullStoragePath) && File::isDirectory($oldFullStoragePath) )
                {
                    $this->recursiveCreateDirectory($this->publicImagesUploadPath("activities/{$game->activity_id}"));
                    File::moveDirectory($oldFullStoragePath, $this->publicImagesUploadPath("activities/{$game->activity_id}/{$game->id}"));
                    $migratedCounts['game'] += 1;
                }
            }
        });

        ActivityItem::chunk(50, function($items) use (&$migratedCounts)
        {
            foreach ( $items as $item )
            {
                $oldFullStoragePath = $this->publicImagesUploadPath(sha1("activity_item_{$item->id}"));
                if ( File::exists($oldFullStoragePath) && File::isDirectory($oldFullStoragePath) )
                {
                    $this->recursiveCreateDirectory($this->publicImagesUploadPath("activity_items/{$item->id}"));
                    File::moveDirectory($oldFullStoragePath, $this->publicImagesUploadPath("activity_items/{$item->id}"));
                    $migratedCounts['item'] += 1;
                }
            }
        });

        DiscountVoucher::chunk(50, function($vouchers) use (&$migratedCounts)
        {
            foreach ( $vouchers as $voucher )
            {
                if ( !!$voucher->image )
                {
                    $imageFullPath = $this->publicImagesUploadPath($voucher->image);
                    if ( File::exists($imageFullPath) && File::isFile($imageFullPath) )
                    {
                        $this->recursiveCreateDirectory($this->publicImagesUploadPath("discount_vouchers/{$voucher->id}"));
                        File::move($imageFullPath, $this->publicImagesUploadPath("discount_vouchers/{$voucher->id}/{$voucher->image}"));
                        $migratedCounts['voucher'] += 1;
                    }
                }
            }
        });

        $this->info('Migrated:');

        foreach ( $migratedCounts as $key => $count )
        {
            $this->info( ucfirst($key) . ': ' . $count);
        }
    }
}
