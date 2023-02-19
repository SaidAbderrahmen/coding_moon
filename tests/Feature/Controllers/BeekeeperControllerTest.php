<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Beekeeper;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BeekeeperControllerTest extends TestCase
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
    public function it_displays_index_view_with_beekeepers()
    {
        $beekeepers = Beekeeper::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('beekeepers.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.beekeepers.index')
            ->assertViewHas('beekeepers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_beekeeper()
    {
        $response = $this->get(route('beekeepers.create'));

        $response->assertOk()->assertViewIs('app.beekeepers.create');
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

        $response = $this->post(route('beekeepers.store'), $data);

        unset($data['password']);

        $this->assertDatabaseHas('beekeepers', $data);

        $beekeeper = Beekeeper::latest('id')->first();

        $response->assertRedirect(route('beekeepers.edit', $beekeeper));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_beekeeper()
    {
        $beekeeper = Beekeeper::factory()->create();

        $response = $this->get(route('beekeepers.show', $beekeeper));

        $response
            ->assertOk()
            ->assertViewIs('app.beekeepers.show')
            ->assertViewHas('beekeeper');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_beekeeper()
    {
        $beekeeper = Beekeeper::factory()->create();

        $response = $this->get(route('beekeepers.edit', $beekeeper));

        $response
            ->assertOk()
            ->assertViewIs('app.beekeepers.edit')
            ->assertViewHas('beekeeper');
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

        $response = $this->put(route('beekeepers.update', $beekeeper), $data);

        unset($data['password']);

        $data['id'] = $beekeeper->id;

        $this->assertDatabaseHas('beekeepers', $data);

        $response->assertRedirect(route('beekeepers.edit', $beekeeper));
    }

    /**
     * @test
     */
    public function it_deletes_the_beekeeper()
    {
        $beekeeper = Beekeeper::factory()->create();

        $response = $this->delete(route('beekeepers.destroy', $beekeeper));

        $response->assertRedirect(route('beekeepers.index'));

        $this->assertModelMissing($beekeeper);
    }
}
