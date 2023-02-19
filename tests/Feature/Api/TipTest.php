<?php

namespace Tests\Feature\Api;

use App\Models\Tip;
use App\Models\User;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TipTest extends TestCase
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
    public function it_gets_tips_list()
    {
        $tips = Tip::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.tips.index'));

        $response->assertOk()->assertSee($tips[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_tip()
    {
        $data = Tip::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.tips.store'), $data);

        $this->assertDatabaseHas('tips', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.tips.update', $tip), $data);

        $data['id'] = $tip->id;

        $this->assertDatabaseHas('tips', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_tip()
    {
        $tip = Tip::factory()->create();

        $response = $this->deleteJson(route('api.tips.destroy', $tip));

        $this->assertModelMissing($tip);

        $response->assertNoContent();
    }
}
