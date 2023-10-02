<?php

namespace Varenyky\Http\Controllers;

use Illuminate\View\View;
use VarenykyECom\Models\Order;
use VarenykyECom\Models\Product;
use Carbon\Carbon;

class DashboardController extends BaseController
{
    public function __construct()
    {
        // $this->middleware(['role:admin|editor']);
    }

    public function index(): View
    {
        $isShop = false;

        $orders = 0;
        $oldOrders = 0;
        $orderpercentage = 0;
        $products = 0;
        $oldProducts = 0;
        $productpercentage = 0;
        $sales = 0;
        $oldSales = 0;
        $salespercentage = 0;

        if(class_exists(Order::class)){
            $isShop = true;

            $orders = Order::whereBetween('created_at', [Carbon::now()->startOfWeek()->format('Y-m-d H:i:s'), Carbon::now()->endOfWeek()->format('Y-m-d H:i:s')])->count();
            $oldOrders = Order::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek()->format('Y-m-d H:i:s'), Carbon::now()->subWeek()->endOfWeek()->format('Y-m-d H:i:s')])->count();
            if ($oldOrders != 0) {
                $orderpercentage = (($orders - $oldOrders) / $oldOrders) * 100;
            } else {
                $orderpercentage = 0;
            }

            $products = Product::whereBetween('created_at', [Carbon::now()->startOfWeek()->format('Y-m-d H:i:s'), Carbon::now()->endOfWeek()->format('Y-m-d H:i:s')])->count();
            $oldProducts = Product::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek()->format('Y-m-d H:i:s'), Carbon::now()->subWeek()->endOfWeek()->format('Y-m-d H:i:s')])->count();
            if ($oldProducts != 0) {
                $productpercentage = (($products - $oldProducts) / $oldProducts) * 100;
            } else {
                $productpercentage = 0;
            }

            $sales = Order::whereBetween('created_at', [Carbon::now()->startOfWeek()->format('Y-m-d H:i:s'), Carbon::now()->endOfWeek()->format('Y-m-d H:i:s')])->sum('total');
            $oldSales = Order::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek()->format('Y-m-d H:i:s'), Carbon::now()->subWeek()->endOfWeek()->format('Y-m-d H:i:s')])->sum('total');
            if ($oldSales != 0) {
                $salespercentage = (($sales - $oldSales) / $oldSales) * 100;
            } else {
                $salespercentage = 0;
            }
        }

        return view('varenyky::dashboard.index', compact('isShop', 'sales', 'oldSales', 'salespercentage', 'orders', 'oldOrders', 'orderpercentage', 'products', 'oldProducts', 'productpercentage'));
    }
}
