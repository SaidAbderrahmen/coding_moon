<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Hive;

use App\Models\Beekeeper;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HiveControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_hives()
    {
        $hives = Hive::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('hives.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.hives.index')
            ->assertViewHas('hives');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_hive()
    {
        $response = $this->get(route('hives.create'));

        $response->assertOk()->assertViewIs('app.hives.create');
    }

    /**
     * @test
     */
    public function it_stores_the_hive()
    {
        $data = Hive::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('hives.store'), $data);

        $this->assertDatabaseHas('hives', $data);

        $hive = Hive::latest('id')->first();

        $response->assertRedirect(route('hives.edit', $hive));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_hive()
    {
        $hive = Hive::factory()->create();

        $response = $this->get(route('hives.show', $hive));

        $response
            ->assertOk()
            ->assertViewIs('app.hives.show')
            ->assertViewHas('hive');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_hive()
    {
        $hive = Hive::factory()->create();

        $response = $this->get(route('hives.edit', $hive));

        $response
            ->assertOk()
            ->assertViewIs('app.hives.edit')
            ->assertViewHas('hive');
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

        $response = $this->put(route('hives.update', $hive), $data);

        $data['id'] = $hive->id;

        $this->assertDatabaseHas('hives', $data);

        $response->assertRedirect(route('hives.edit', $hive));
    }

    /**
     * @test
     */
    public function it_deletes_the_hive()
    {
        $hive = Hive::factory()->create();

        $response = $this->delete(route('hives.destroy', $hive));

        $response->assertRedirect(route('hives.index'));

        $this->assertModelMissing($hive);
    }
}
