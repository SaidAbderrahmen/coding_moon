<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Notification;

use App\Models\Hive;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationControllerTest extends TestCase
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
    public function it_displays_index_view_with_notifications()
    {
        $notifications = Notification::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('notifications.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.notifications.index')
            ->assertViewHas('notifications');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_notification()
    {
        $response = $this->get(route('notifications.create'));

        $response->assertOk()->assertViewIs('app.notifications.create');
    }

    /**
     * @test
     */
    public function it_stores_the_notification()
    {
        $data = Notification::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('notifications.store'), $data);

        $this->assertDatabaseHas('notifications', $data);

        $notification = Notification::latest('id')->first();

        $response->assertRedirect(route('notifications.edit', $notification));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_notification()
    {
        $notification = Notification::factory()->create();

        $response = $this->get(route('notifications.show', $notification));

        $response
            ->assertOk()
            ->assertViewIs('app.notifications.show')
            ->assertViewHas('notification');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_notification()
    {
        $notification = Notification::factory()->create();

        $response = $this->get(route('notifications.edit', $notification));

        $response
            ->assertOk()
            ->assertViewIs('app.notifications.edit')
            ->assertViewHas('notification');
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

        $response = $this->put(
            route('notifications.update', $notification),
            $data
        );

        $data['id'] = $notification->id;

        $this->assertDatabaseHas('notifications', $data);

        $response->assertRedirect(route('notifications.edit', $notification));
    }

    /**
     * @test
     */
    public function it_deletes_the_notification()
    {
        $notification = Notification::factory()->create();

        $response = $this->delete(
            route('notifications.destroy', $notification)
        );

        $response->assertRedirect(route('notifications.index'));

        $this->assertModelMissing($notification);
    }
}
