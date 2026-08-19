<?php

use App\Models\Pitch;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(DatabaseTransactions::class);

test('entrepreneur can create a pitch with a valid video under 2500MB', function () {
    Storage::fake('public');

    $user = User::factory()->create(['role' => 'entrepreneur']);

    $video = UploadedFile::fake()->create('pitch.mp4', 10000, 'video/mp4'); // 10MB

    $response = $this->actingAs($user)->post(route('entrepreneur.pitch.store'), [
        'startup_name' => 'Tech Startup',
        'invested_amount' => 5000000,
        'monthly_net_value' => 1000000,
        'monthly_growth' => 25,
        'vision_statement' => 'Revolutionizing the market',
        'funding_required' => 2000000,
        'return_time' => 3,
        'total_valuation' => 10000000,
        'video' => $video,
    ]);

    $response->assertRedirect(route('entrepreneur.dashboard'));
    $this->assertDatabaseHas('pitches', [
        'user_id' => $user->id,
        'startup_name' => 'Tech Startup',
        'invested_amount' => 5000000,
        'funding_required' => 2000000,
    ]);

    $pitch = Pitch::where('user_id', $user->id)->first();
    expect($pitch->video_path)->not->toBeNull();
    Storage::disk('public')->assertExists($pitch->video_path);
});
