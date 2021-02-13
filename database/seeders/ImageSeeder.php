<?php


namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return images
     */
    public function run()
    {
       /* $images = [
            ['url' => "product-06.jpg", 'alt' => 'Informatique','category_id'=>1,'produit_id'=>null],
            ['url' => "product-09.jpg", 'alt' => 'Electronique','category_id'=>2,'produit_id'=>null],
            ['url' => "product-12.jpg", 'alt' => 'Electromenager','category_id'=>3,'produit_id'=>null],
            ['url' => "product-14.jpg", 'alt' => 'Mode','category_id'=>4,'produit_id'=>null],
            ['url' => "slide-07.jpg", 'alt' => 'Super marché','category_id'=>5,'produit_id'=>null],
            ['url' => "banner-06.jpg", 'alt' => 'Maison et buereau','category_id'=>6,'produit_id'=>null]
        ];


        foreach ($images as $image) {
            Image::create($image);
        }*/

        for($i=11;$i<23;$i++) {
            Image::create(['url' => "product-0.$i.jpg", 'alt' => 'image.$i.','category_id'=>null,'produit_id'=>$i]);
        }
    }
}
