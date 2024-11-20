<?php

namespace App\Console\Commands;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class PushCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:push-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $remoteServerUrl = env('REMOTE_SERVER_URL');
        $response = Http::get($remoteServerUrl . '/api/get_categories');
        //dd($response->json());

        $categories = $response->json();
        $currentDateTime = Carbon::now('Asia/Dhaka')->format('Y-m-d H:i:s');
        foreach ($categories as $category) {
            //categoryTime will be format('Y-m-d H:i:s')
            $categoryTime = Carbon::parse($category['time'])->format('Y-m-d H:i:s');
            //compare category time with current time
            // dd($categoryTime, $category['name']);

            // Check if category time is less than or equal to current time
            if ($categoryTime <= $currentDateTime) {
                $existingCategory = Category::where('name', $category['name'])
                    ->where('time', $category['time'])
                    ->first();

                if ($existingCategory) {
                    // dd('Category already exists');
                } else {
                    // Create a new category in Project 1's database
                    //dd($category);
                    $newCategory = new Category();
                    $newCategory->name = $category['name'];
                    $newCategory->time = $category['time'];
                    $newCategory->save();
                }
            }
        }
    }
}
