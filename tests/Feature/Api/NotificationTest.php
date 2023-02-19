<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Notification;

use App\Models\Hive;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationTest extends TestCase
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
    public function it_gets_notifications_list()
    {
        $notifications = Notification::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.notifications.index'));

        $response->assertOk()->assertSee($notifications[0]->details);
    }

    /**
     * @test
     */
    public function it_stores_the_notification()
    {
        $data = Notification::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.notifications.store'), $data);

        $this->assertDatabaseHas('notifications', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_notification()
    {
        $notification = Notification::factory()->create();

        $hive = Hive::factory()->create();

        $data = [
            'event' => 'infected bee',
            'details' => $this->faker->sentence(20),
            'date' => $this->faker->date,
            'hive_id' => $hive->id,
        ];

        $response = $this->putJson(
            route('api.notifications.update', $notification),
            $data
        );

        $data['id'] = $notification->id;

        $this->assertDatabaseHas('notifications', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_notification()
    {
        $notification = Notification::factory()->create();

        $response = $this->deleteJson(
            route('api.notifications.destroy', $notification)
        );

        $this->assertModelMissing($notification);

        $response->assertNoContent();
    }
}
