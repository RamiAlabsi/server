<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::deleting(function ($category) {
            foreach ($category->sales as $category_sale) {
                $category_sale->delete();
            }
        });
        Review::saved(function ($review) {
            $product = Product::find($review->product_id);
            $product_reviews = Review::where('product_id', $product->id)->get();
            $total_rate = 0;    
            foreach ($product_reviews as $product_review) {
                $total_rate += $product_review->rate;
            }
            $product->total_rate = $total_rate / count($product_reviews);
            $product->save();
        });
    }
}
