<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Hive;

use App\Models\Beekeeper;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HiveTest extends TestCase
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
    public function it_gets_hives_list()
    {
        $hives = Hive::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.hives.index'));

        $response->assertOk()->assertSee($hives[0]->tempreture);
    }

    /**
     * @test
     */
    public function it_stores_the_hive()
    {
        $data = Hive::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.hives.store'), $data);

        $this->assertDatabaseHas('hives', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_hive()
    {
        $hive = Hive::factory()->create();

        $beekeeper = Beekeeper::factory()->create();

        $data = [
            'number' => $this->faker->randomNumber,
            'total_bees' => $this->faker->randomNumber(0),
            'present_bees' => $this->faker->randomNumber(0),
            'infected_bees' => $this->faker->randomNumber(0),
            'tempreture' => $this->faker->text(255),
            'humidity' => $this->faker->text(255),
            'status' => 'working',
            'beekeeper_id' => $beekeeper->id,
        ];

        $response = $this->putJson(route('api.hives.update', $hive), $data);

        $data['id'] = $hive->id;

        $this->assertDatabaseHas('hives', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_hive()
    {
        $hive = Hive::factory()->create();

        $response = $this->deleteJson(route('api.hives.destroy', $hive));

        $this->assertModelMissing($hive);

        $response->assertNoContent();
    }
}
