<?php

use App\Models\Agreement;
use App\Models\Offer;
use App\Models\Pitch;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(DatabaseTransactions::class);

test('investor can upload and send an agreement to entrepreneur', function () {
    Storage::fake('public');

    $entrepreneur = User::factory()->create(['role' => 'entrepreneur']);
    $investor = User::factory()->create(['role' => 'investor']);

    $pitch = Pitch::create([
        'user_id' => $entrepreneur->id,
        'startup_name' => 'Future Tech',
    ]);

    $offer = Offer::create([
        'pitch_id' => $pitch->id,
        'investor_id' => $investor->id,
        'offer_amount' => 100000,
        'time_period' => '2 years',
        'valuation' => 1000000,
        'status' => 'accepted',
    ]);

    $agreement = Agreement::create([
        'offer_id' => $offer->id,
        'pitch_id' => $pitch->id,
        'entrepreneur_id' => $entrepreneur->id,
        'investor_id' => $investor->id,
        'ownership_stake' => 10,
        'estimated_roi' => 150000,
        'agreement_date' => now()->toDateString(),
        'status' => 'pending_signature',
    ]);

    $file = UploadedFile::fake()->create('contract.pdf', 1000, 'application/pdf');

    // Investor uploads agreement
    $response = $this->actingAs($investor)->post(route('investor.agreements.upload', $agreement->id), [
        'agreement_file' => $file,
    ]);

    $response->assertSessionHas('success');
    expect($agreement->fresh()->status)->toBe('investor_uploaded');
    expect($agreement->fresh()->agreement_file)->not->toBeNull();

    // Investor sends agreement to entrepreneur
    $sendResponse = $this->actingAs($investor)->post(route('investor.agreements.send', $agreement->id));
    $sendResponse->assertSessionHas('success');
    expect($agreement->fresh()->status)->toBe('sent_to_entrepreneur');

    // Entrepreneur views agreements page and signs
    $this->actingAs($entrepreneur)->get(route('entrepreneur.agreements'))->assertStatus(200);

    $base64Signature = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==';
    $signResponse = $this->actingAs($entrepreneur)->post(route('entrepreneur.agreements.sign', $agreement->id), [
        'signature' => $base64Signature,
    ]);
    $signResponse->assertSessionHas('success');
    expect($agreement->fresh()->status)->toBe('active');
    expect($agreement->fresh()->entrepreneur_file)->not->toBeNull();
});

test('deleting a pitch preserves its agreements', function () {
    $entrepreneur = User::factory()->create(['role' => 'entrepreneur']);
    $investor = User::factory()->create(['role' => 'investor']);

    $pitch = Pitch::create([
        'user_id' => $entrepreneur->id,
        'startup_name' => 'Green Energy',
    ]);

    $offer = Offer::create([
        'pitch_id' => $pitch->id,
        'investor_id' => $investor->id,
        'offer_amount' => 200000,
        'time_period' => '3 years',
        'valuation' => 2000000,
        'status' => 'accepted',
    ]);

    $agreement = Agreement::create([
        'offer_id' => $offer->id,
        'pitch_id' => $pitch->id,
        'entrepreneur_id' => $entrepreneur->id,
        'investor_id' => $investor->id,
        'ownership_stake' => 15,
        'estimated_roi' => 180000,
        'agreement_date' => now()->toDateString(),
        'status' => 'active',
    ]);

    $pitch->delete();

    $preservedAgreement = Agreement::find($agreement->id);

    expect($preservedAgreement)->not->toBeNull();
    expect($preservedAgreement->pitch_id)->toBeNull();
});

test('entrepreneur can reject an agreement with a reason', function () {
    $entrepreneur = User::factory()->create(['role' => 'entrepreneur']);
    $investor = User::factory()->create(['role' => 'investor']);

    $pitch = Pitch::create([
        'user_id' => $entrepreneur->id,
        'startup_name' => 'Bio Tech',
    ]);

    $offer = Offer::create([
        'pitch_id' => $pitch->id,
        'investor_id' => $investor->id,
        'offer_amount' => 50000,
        'time_period' => '1 year',
        'valuation' => 500000,
        'status' => 'accepted',
    ]);

    $agreement = Agreement::create([
        'offer_id' => $offer->id,
        'pitch_id' => $pitch->id,
        'entrepreneur_id' => $entrepreneur->id,
        'investor_id' => $investor->id,
        'ownership_stake' => 10,
        'estimated_roi' => 75000,
        'agreement_date' => now()->toDateString(),
        'status' => 'sent_to_entrepreneur',
    ]);

    $rejectResponse = $this->actingAs($entrepreneur)->post(route('entrepreneur.agreements.reject', $agreement->id), [
        'rejection_reason' => 'Terms are not favorable',
    ]);

    $rejectResponse->assertSessionHas('success');
    expect($agreement->fresh()->status)->toBe('rejected');
    expect($agreement->fresh()->rejection_reason)->toBe('Terms are not favorable');
});

test('investor can update profile and focus sectors', function () {
    $investor = User::factory()->create(['role' => 'investor', 'name' => 'Old Name']);

    $response = $this->actingAs($investor)->post(route('investor.profile.update'), [
        'name' => 'New Malik',
        'city' => 'Karachi',
        'phone' => '03001234567',
        'bio' => 'New investor bio',
        'interested_businesses' => 'AI, Robotics, Solar',
    ]);

    $response->assertSessionHas('success');
    expect($investor->fresh()->name)->toBe('New Malik');
    expect($investor->fresh()->city)->toBe('Karachi');
    expect($investor->fresh()->bio)->toBe('New investor bio');
    expect($investor->fresh()->investorProfile->interested_businesses)->toBe(['AI', 'Robotics', 'Solar']);
});
