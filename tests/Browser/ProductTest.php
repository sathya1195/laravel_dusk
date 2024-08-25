<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Product;

class ProductTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_create_product()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/products/create')
                    ->type('name', 'New Product')
                    ->type('description', 'Product description')
                    ->type('price', '100')
                    ->press('Save')
                    ->assertSee('Product created successfully');

            $this->assertDatabaseHas('products', [
                'name' => 'New Product',
                'price' => 100
            ]);
        });
    }

    public function test_create_product_validation_errors()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/products/create')
                    ->press('Save')
                    ->assertSee('The name field is required')
                    ->assertSee('The price field is required');
        });
    }
    public function test_view_all_products()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/products')
                    ->assertSee('Products');
        });
    }

    public function test_view_single_product()
    {
        $product = Product::create([
            'name' => 'Sample Product',
            'description' => 'Sample Description',
            'price' => 50
        ]);

        $this->browse(function (Browser $browser) use ($product) {
            $browser->visit('/products/' . $product->id)
                    ->assertSee($product->name)
                    ->assertSee($product->description)
                    ->assertSee($product->price);
        });
    }
    public function test_update_product()
    {
        $product = Product::create([
            'name' => 'Old Product',
            'description' => 'Old Description',
            'price' => 100
        ]);

        $this->browse(function (Browser $browser) use ($product) {
            $browser->visit('/products/' . $product->id . '/edit')
                    ->type('name', 'Updated Product')
                    ->type('description', 'Updated Description')
                    ->type('price', '150')
                    ->press('Save')
                    ->assertSee('Product updated successfully');

            $this->assertDatabaseHas('products', [
                'id' => $product->id,
                'name' => 'Updated Product',
                'price' => 150
            ]);
        });
    }

    public function test_update_product_validation_errors()
    {
        $product = Product::create([
            'name' => 'Old Product',
            'description' => 'Old Description',
            'price' => 100
        ]);

        $this->browse(function (Browser $browser) use ($product) {
            $browser->visit('/products/' . $product->id . '/edit')
                    ->type('name', '')
                    ->press('Save')
                    ->assertSee('The name field is required');
        });
    }
    public function test_delete_product()
    {
        $product = Product::create([
            'name' => 'Product to Delete',
            'description' => 'Description',
            'price' => 200
        ]);

        $this->browse(function (Browser $browser) use ($product) {
            $browser->visit('/products')
                    ->press('@delete-button-' . $product->id)
                    ->assertSee('Product deleted successfully');

            $this->assertDatabaseMissing('products', [
                'id' => $product->id
            ]);
        });
    }
}
