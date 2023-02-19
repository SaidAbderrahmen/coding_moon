<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\History;

use App\Models\Hive;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HistoryControllerTest extends TestCase
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
    public function it_displays_index_view_with_histories()
    {
        $histories = History::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('histories.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.histories.index')
            ->assertViewHas('histories');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_history()
    {
        $response = $this->get(route('histories.create'));

        $response->assertOk()->assertViewIs('app.histories.create');
    }

    /**
     * @test
     */
    public function it_stores_the_history()
    {
        $data = History::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('histories.store'), $data);

        $this->assertDatabaseHas('histories', $data);

        $history = History::latest('id')->first();

        $response->assertRedirect(route('histories.edit', $history));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_history()
    {
        $history = History::factory()->create();

        $response = $this->get(route('histories.show', $history));

        $response
            ->assertOk()
            ->assertViewIs('app.histories.show')
            ->assertViewHas('history');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_history()
    {
        $history = History::factory()->create();

        $response = $this->get(route('histories.edit', $history));

        $response
            ->assertOk()
            ->assertViewIs('app.histories.edit')
            ->assertViewHas('history');
    }

    /**
     * @test
     */
    public function it_updates_the_history()
    {
        $history = History::factory()->create();

        $hive = Hive::factory()->create();

        $data = [
            'action' => 'spray',
            'date' => $this->faker->date,
            'hive_id' => $hive->id,
        ];

        $response = $this->put(route('histories.update', $history), $data);

        $data['id'] = $history->id;

        $this->assertDatabaseHas('histories', $data);

        $response->assertRedirect(route('histories.edit', $history));
    }

    /**
     * @test
     */
    public function it_deletes_the_history()
    {
        $history = History::factory()->create();

        $response = $this->delete(route('histories.destroy', $history));

        $response->assertRedirect(route('histories.index'));

        $this->assertModelMissing($history);
    }
}
