<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\Products;
  
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'productname' => 'Purple Reign FA',
                'description' => 'FA4532',
                'image' => 'https://dummyimage.com/200x300/000/fff&text=Samsung',
                'price' => 100
            ],
            [
                'productname' => 'Enchanting Belle',
                'description' => 'FA3518',
                'image' => 'https://dummyimage.com/200x300/000/fff&text=Iphone',
                'price' => 200
            ],
            [
                'productname' => 'Red Rose',
                'description' => 'FA1234',
                'image' => 'https://dummyimage.com/200x300/000/fff&text=Google',
                'price' => 400
            ],
            [
                'productname' => 'Purple Lily',
                'description' => 'FA2234',
                'image' => 'https://dummyimage.com/200x300/000/fff&text=LG',
                'price' => 200
            ]
        ];
  
        foreach ($products as $key => $value) {
            Products::create($value);
        }
    }
}