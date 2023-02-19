<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Beekeeper;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BeekeeperTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_beekeepers_list()
    {
        $beekeepers = Beekeeper::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.beekeepers.index'));

        $response->assertOk()->assertSee($beekeepers[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_beekeeper()
    {
        $data = Beekeeper::factory()
            ->make()
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(route('api.beekeepers.store'), $data);

        unset($data['password']);

        $this->assertDatabaseHas('beekeepers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_beekeeper()
    {
        $beekeeper = Beekeeper::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
        ];

        $data['password'] = \Str::random('8');

        $response = $this->putJson(
            route('api.beekeepers.update', $beekeeper),
            $data
        );

        unset($data['password']);

        $data['id'] = $beekeeper->id;

        $this->assertDatabaseHas('beekeepers', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_beekeeper()
    {
        $beekeeper = Beekeeper::factory()->create();

        $response = $this->deleteJson(
            route('api.beekeepers.destroy', $beekeeper)
        );

        $this->assertModelMissing($beekeeper);

        $response->assertNoContent();
    }
}
