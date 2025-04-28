<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Announcement;
use App\Models\AboutUs;
use App\Models\Member;

class MigrateImages extends Command
{
    protected $signature = 'migrate:images';
    protected $description = 'Migrate images from database to storage folder and update paths';

    public function handle()
    {
        $this->migrate(Event::class, 'thumbnail', 'uploads/events');
        $this->migrate(Gallery::class, 'image', 'uploads/gallery');
        $this->migrate(Announcement::class, 'image', 'uploads/announcements');
        $this->migrate(AboutUs::class, 'organization_photo', 'uploads/aboutus');
        $this->migrate(AboutUs::class, 'chairman_photo', 'uploads/aboutus');
        $this->migrate(Member::class, 'photo', 'uploads/members');

        $this->info('Images migration completed.');
    }

    private function migrate($modelClass, $column, $folder)
    {
        $items = $modelClass::all();

        foreach ($items as $item) {
            $imageData = $item->$column;

            if ($imageData && strlen($imageData) > 100) { // Just to make sure it's not empty
                try {
                    $image = base64_decode($imageData);

                    if ($image === false) {
                        $this->warn("Failed to decode image for {$modelClass} ID: {$item->id}");
                        continue;
                    }

                    $filename = uniqid() . '.jpg';  // You can change the extension based on file type
                    $path = $folder . '/' . $filename;

                    Storage::disk('public')->put($path, $image);

                    $item->$column = $path;  // Save the new path in DB
                    $item->save();

                    $this->info("Migrated: {$modelClass} ID: {$item->id}");
                } catch (\Exception $e) {
                    $this->error("Error migrating {$modelClass} ID: {$item->id} - " . $e->getMessage());
                }
            }
        }
    }
}
