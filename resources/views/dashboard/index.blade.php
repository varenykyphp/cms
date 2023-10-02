@extends('varenykyAdmin::app')

@section('content')
    @if ($isShop)
        <div class="card p-3">
            <div class="row">
                <div class="col-6">
                    <div class="border p-4">
                        <h2 class="text-success">Hi {{ auth()->user()->name }}!</h2>
                        <p class="lead">This is what happened with
                            {{ \Varenyky\Models\Setting\Setting::where('key', 'site-name')->first()->value }} this week.</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-4">
                            <div class="border p-4">
                                <small>Orders</small>
                                <h1 class="mb-0 mt-2">{{ $orders }}</h1>
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted">{{ $oldOrders }}</small>
                                    </div>
                                    <div class="col-6 text-end">
                                        @if ($orderpercentage > 0)
                                            <small class="text-success">{{ number_format($orderpercentage, 2) }}%</small>
                                        @elseif($orderpercentage < 0)
                                            <small class="text-danger">{{ number_format($orderpercentage, 2) }}%</small>
                                        @else
                                            <small class="text-muted">{{ number_format($orderpercentage, 2) }}%</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border p-4">
                                <small>New products</small>
                                <h1 class="mb-0 mt-2">{{ $products }}</h1>
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted">{{ $oldProducts }}</small>
                                    </div>
                                    <div class="col-6 text-end">
                                        @if ($productpercentage > 0)
                                            <small class="text-success">{{ number_format($productpercentage, 2) }}%</small>
                                        @elseif($productpercentage < 0)
                                            <small class="text-danger">{{ number_format($productpercentage, 2) }}%</small>
                                        @else
                                            <small class="text-muted">{{ number_format($productpercentage, 2) }}%</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border p-4">
                                <small>Turnover</small>
                                <h1 class="mb-0 mt-2">&dollar; {{ number_format($sales, 2, ',') }}</h1>
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted">&dollar; {{ number_format($oldSales, 2, ',') }}</small>
                                    </div>
                                    <div class="col-6 text-end">
                                        @if ($salespercentage > 0)
                                            <small class="text-success">{{ $salespercentage }}%</small>
                                        @elseif($salespercentage < 0)
                                            <small class="text-danger">{{ $salespercentage }}%</small>
                                        @else
                                            <small class="text-muted">{{ $salespercentage }}%</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
