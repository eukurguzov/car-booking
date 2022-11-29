<?php

namespace Tests\Unit\Services;

use App\Events\BookingApproved;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

/**
 * Class OrderServiceTest
 * @package Tests\Unit\Services
 * @coversDefaultClass \App\Services\OrderService
 */
class OrderServiceTest extends TestCase
{
    /** @var MockObject|OrderService */
    private $service;

    protected function setMockedService(array $methods = []): void
    {
        $this->service = $this->getMockBuilder(OrderService::class)->onlyMethods($methods)->getMock();
    }

    /**
     * @test
     * @covers ::approveOrder
     */
    public function order_should_be_approved_with_event()
    {
        Event::fake();

        $order = $this->createMock(Order::class);
        $this->setMockedService(['getAllOrders']);

        $order->expects($this->once())->method('approve')->willReturnSelf();

        $this->service->approveOrder($order);
        Event::assertDispatched(BookingApproved::class);
    }
}
