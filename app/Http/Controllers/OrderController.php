<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->middleware('auth')->except(['create', 'store']);
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =$this->orderService->getAllOrders();

        return view('home', ['data' => $data, 'sizes' => $this->orderService->getCarSizes()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('create', ['sizes' => $this->orderService->getCarSizes()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return RedirectResponse
     */
    public function store(OrderRequest $request)
    {
        Order::create($request->all());
        $redirectTo = auth()->id() ? 'orders.index' : 'orders.create';

        return redirect()->route($redirectTo)->with('success', 'The car has been booked successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return Application|Factory|View
     */
    public function edit(Order $order)
    {
        return view('edit', ['order' => $order, 'sizes' => $this->orderService->getCarSizes()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderRequest $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function update(OrderRequest $request, Order $order)
    {
        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return RedirectResponse
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'The order has been deleted successfully.');
    }

    /**
     * @param Order $order
     * @return RedirectResponse
     */
    public function approve(Order $order)
    {
        $this->orderService->approveOrder($order);

        return redirect()->route('orders.index')->with('success', 'The order has been approved successfully.');
    }
}
