<?php

use App\Models\Pitch;

test('database seeder creates a public demo pitch for the arena', function () {
    $this->seed();

    expect(Pitch::where('status', 'active')->count())->toBeGreaterThan(0);
});
