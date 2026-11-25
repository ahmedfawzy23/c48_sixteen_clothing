<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ShopStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make("Products", Product::count()),
            Stat::make("Products", Product::count()),
            Stat::make("Products", Product::count())
        ];
    }
}
