<?php

use App\Models\EntrepreneurProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

test('entrepreneur can update profile and venture details', function () {
    $user = User::factory()->create(['role' => 'entrepreneur', 'name' => 'Old Name']);

    $response = $this->actingAs($user)->post(route('entrepreneur.profile.update'), [
        'name' => 'Naeem Azhar Updated',
        'city' => 'Lahore',
        'phone' => '03211234567',
        'bio' => 'Focusing on scaling tech ventures',
        'company_name' => 'Acme Shoes',
        'industry' => 'Retail Tech',
        'experience_years' => 10,
        'total_valuation' => 5000000,
        'future_valuation' => 15000000,
        'website' => 'https://acmeshoes.com',
    ]);

    $response->assertSessionHas('success');

    // Check User details
    $user->refresh();
    expect($user->name)->toBe('Naeem Azhar Updated');
    expect($user->city)->toBe('Lahore');
    expect($user->phone)->toBe('03211234567');
    expect($user->bio)->toBe('Focusing on scaling tech ventures');

    // Check EntrepreneurProfile details
    $profile = $user->entrepreneurProfile;
    expect($profile)->not->toBeNull();
    expect($profile->company_name)->toBe('Acme Shoes');
    expect($profile->industry)->toBe('Retail Tech');
    expect($profile->experience_years)->toBe(10);
    expect($profile->total_valuation)->toBe(5000000);
    expect($profile->future_valuation)->toBe(15000000);
    expect($profile->website)->toBe('https://acmeshoes.com');
});

test('investor cannot update entrepreneur profile details', function () {
    $investor = User::factory()->create(['role' => 'investor']);

    $response = $this->actingAs($investor)->post(route('entrepreneur.profile.update'), [
        'name' => 'Should fail',
    ]);

    $response->assertStatus(403);
});

test('validation errors when inputting invalid entrepreneur profile details', function () {
    $user = User::factory()->create(['role' => 'entrepreneur']);

    $response = $this->actingAs($user)->post(route('entrepreneur.profile.update'), [
        'name' => '', // Name is required
        'experience_years' => 'not-an-integer',
        'total_valuation' => 'not-a-number',
    ]);

    $response->assertSessionHasErrors(['name', 'experience_years', 'total_valuation']);
});
