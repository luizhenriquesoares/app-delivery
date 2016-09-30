<?php

use CodeDelivery\Models\OrderItem;
use Illuminate\Database\Seeder;
use CodeDelivery\Models\Order;
class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 10)->create()->each(function ($t) {
            for($i = 0; $i <= 2; $i++) {
                $t->items()->save(factory(OrderItem::class)->make([
                    'product_id' => rand(1,5),
                    'qtd' => 2,
                    'price'=> 50
                ]));
            }

        });
    }
}
