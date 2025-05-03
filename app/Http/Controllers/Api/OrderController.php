<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('customer')->latest()->get();
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $order = Order::create($validatedData);
        $order->load('customer');
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     * NOTE: We don't have a specific '/orders/{id}' GET route defined,
     * so this method might not be directly used unless added to routes/api.php.
     * Keeping it for completeness if needed later.
     */
    public function show(Order $order)
    {
        $order->load('customer');
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     * Only updates the status based on requirements.
     */
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'status' => ['required', Rule::in(['pending', 'shipped'])],
        ]);

        $order->update($validatedData);
        $order->load('customer');
        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     * NOTE: Not required by the spec, keeping for completeness.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }

    /**
     * Calculate and return order statistics.
     */
    public function stats()
    {
        $stats = Order::query()
            ->selectRaw('status, count(*) as total_orders, sum(price * quantity) as total_revenue')
            ->groupBy('status')
            ->get();

        $overallTotalRevenue = $stats->sum('total_revenue');

        return response()->json([
            'stats_by_status' => $stats,
            'overall_total_revenue' => $overallTotalRevenue,
        ]);
    }
}
