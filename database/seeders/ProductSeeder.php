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
                'image' => 'https://cdn.shopify.com/s/files/1/1589/6833/products/OUFBUN1233_Wondrous-Violet-Bouquet_800x.jpg?v=1600748115',
                'price' => 100
            ],
            [
                'productname' => 'Enchanting Belle',
                'description' => 'FA3518',
                'image' => 'https://cdn.shopify.com/s/files/1/1589/6833/products/OUFBUN1251_Chica-Bonita-Bouquet_7559761d-95b3-4f2d-9364-6994e03707fd_800x.jpg?v=1631612289',
                'price' => 200
            ],
            [
                'productname' => 'Red Rose',
                'description' => 'FA1234',
                'image' => 'https://cdn.shopify.com/s/files/1/1589/6833/products/midnight-bouquet_800x.jpg?v=1612264694',
                'price' => 400
            ],
            [
                'productname' => 'Purple Lily',
                'description' => 'FA2234',
                'image' => 'https://cdn.shopify.com/s/files/1/1589/6833/products/97bdea6c-effc-43b7-896c-38eb21d51c13_e49e472f-18a9-47c9-8f43-58a3325a76e6_800x.jpg?v=1582183804',
                'price' => 200
            ]
        ];
  
        foreach ($products as $key => $value) {
            Products::create($value);
        }
    }
}