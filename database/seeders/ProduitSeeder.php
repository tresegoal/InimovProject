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

        for($i=1;$i<10;$i++) {
            $url = "product-0".$i.".jpg";
            $alt = "image-0".$i.".jpg";
            Image::create(['url' => $url, 'alt' => $alt,'category_id'=>null,'produit_id'=>random_int(1,21)]);
        }
    }
}
