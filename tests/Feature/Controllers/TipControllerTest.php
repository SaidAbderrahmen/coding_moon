<?php

namespace Tests\Feature\Controllers;

use App\Models\Tip;
use App\Models\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TipControllerTest extends TestCase
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
    public function it_displays_index_view_with_tips()
    {
        $tips = Tip::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('tips.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.tips.index')
            ->assertViewHas('tips');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_tip()
    {
        $response = $this->get(route('tips.create'));

        $response->assertOk()->assertViewIs('app.tips.create');
    }

    /**
     * @test
     */
    public function it_stores_the_tip()
    {
        $data = Tip::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('tips.store'), $data);

        $this->assertDatabaseHas('tips', $data);

        $tip = Tip::latest('id')->first();

        $response->assertRedirect(route('tips.edit', $tip));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_tip()
    {
        $tip = Tip::factory()->create();

        $response = $this->get(route('tips.show', $tip));

        $response
            ->assertOk()
            ->assertViewIs('app.tips.show')
            ->assertViewHas('tip');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_tip()
    {
        $tip = Tip::factory()->create();

        $response = $this->get(route('tips.edit', $tip));

        $response
            ->assertOk()
            ->assertViewIs('app.tips.edit')
            ->assertViewHas('tip');
    }

    /**
     * @test
     */
    public function it_updates_the_tip()
    {
        $tip = Tip::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(15),
            'link' => $this->faker->text(255),
        ];

        $response = $this->put(route('tips.update', $tip), $data);

        $data['id'] = $tip->id;

        $this->assertDatabaseHas('tips', $data);

        $response->assertRedirect(route('tips.edit', $tip));
    }

    /**
     * @test
     */
    public function it_deletes_the_tip()
    {
        $tip = Tip::factory()->create();

        $response = $this->delete(route('tips.destroy', $tip));

        $response->assertRedirect(route('tips.index'));

        $this->assertModelMissing($tip);
    }
}
