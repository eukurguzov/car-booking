<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class OrderControllerTest
 * @package Tests\Feature
 * @coversDefaultClass \App\Http\Controllers\OrderController
 */
class OrderControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * @test
     * @covers ::index
     */
    public function we_should_see_a_successful_response_on_index_page_if_we_logged_in()
    {
        $user = User::query()->first();

        $response = $this->actingAs($user)->get(route('orders.index'));

        $response->assertStatus(200);
    }

    /**
     * @test
     * @covers ::index
     */
    public function we_should_be_redirected_from_index_to_login_if_we_are_guest()
    {
        $response = $this->get(route('orders.index'));

        $response->assertStatus(302)->assertRedirectToRoute('login');
    }

    /**
     * @test
     * @covers ::store
     */
    public function we_should_create_booking_and_redirect_to_index_if_we_are_not_guest()
    {
        $user = User::query()->first();
        $data = [
            'name' => $name = $this->faker->name,
            'email' => $email = $this->faker->email,
            'contact' => $this->faker->randomDigitNotNull,
            'size_id' => $this->faker->randomElement([1, 2, 3]),
            'flex' => $this->faker->randomElement([1, 2, 3]),
            'booked_for' => $this->faker->date(),
        ];

        $response = $this->actingAs($user)->post(route('orders.store'), $data);

        $response->assertStatus(302)->assertRedirectToRoute('orders.index');
        $this->assertDatabaseHas('orders', ['name' => $name, 'email' => $email]);
    }

    /**
     * @test
     * @covers ::store
     */
    public function we_should_create_booking_and_redirect_to_create_if_we_are_guest()
    {
        $data = [
            'name' => $name = $this->faker->name,
            'email' => $email = $this->faker->email,
            'contact' => $this->faker->randomDigitNotNull,
            'size_id' => $this->faker->randomElement([1, 2, 3]),
            'flex' => $this->faker->randomElement([1, 2, 3]),
            'booked_for' => $this->faker->date(),
        ];

        $response = $this->post(route('orders.store'), $data);

        $response->assertStatus(302)->assertRedirectToRoute('orders.create');
        $this->assertDatabaseHas('orders', ['name' => $name, 'email' => $email]);
    }

    /**
     * @test
     * @covers ::update
     */
    public function we_should_update_booking_if_we_are_authorized()
    {
        $user = User::query()->first();
        $order = Order::factory()->create();
        $data = [
            'name' => $name = $this->faker->name,
            'email' => $email = $this->faker->email,
            'contact' => $this->faker->randomDigitNotNull,
            'size_id' => $this->faker->randomElement([1, 2, 3]),
            'flex' => $this->faker->randomElement([1, 2, 3]),
            'booked_for' => $this->faker->date(),
        ];

        $response = $this->actingAs($user)->put(route('orders.update', $order->id), $data);

        $response->assertStatus(302)->assertRedirectToRoute('orders.index');
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'name' => $name, 'email' => $email]);
    }

    /**
     * @test
     * @covers ::destroy
     */
    public function we_should_delete_booking_if_we_are_authorized_successfully()
    {
        $user = User::query()->first();
        $order = Order::factory()->create();
        $this->assertDatabaseHas('orders', ['id' => $order->id]);

        $response = $this->actingAs($user)->delete(route('orders.destroy', $order->id));

        $response->assertStatus(302)->assertRedirectToRoute('orders.index');
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }

    /**
     * @test
     * @covers ::approve
     */
    public function we_should_approve_booking_if_we_are_authorized()
    {
        Event::fake();

        $user = User::query()->first();
        $order = Order::factory()->create();

        $response = $this->actingAs($user)->post(route('orders.approve', $order->id));

        $response->assertStatus(302)->assertRedirectToRoute('orders.index');
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'approved' => 1]);
    }
}
