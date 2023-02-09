<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Color;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryColor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Reading xml file
        $xml = simplexml_load_file('https://static.prenatal-services.com/rss-feed/prenatal-it/dentsu-feed.xml', 'SimpleXMLElement', LIBXML_NOCDATA);

        $products = $xml->channel->item;

        foreach ($products as $k => $v) {
            // Storing each product
            $product = Product::create([
                'id' => $v->id,
                'mpn' => (int)$v->mpn,
                'price' => (float)$v->price,
                'sale_price' => (float)$v->sale_price,
                'vip_price' => (float)$v->vip_price,
                'stock' => (int)$v->stock,
                'availability' => $v->availability,
                'taglia' => $v->taglia,
                'parent_id' => ((int)$v->id != (int)$v->parent_id) ? $v->parent_id : '0',
                'title' => $v->title,
                'description' => $v->description,
                'link' => $v->link,
                'image_link' => $v->image_link,
                'product_type' => $v->product_type,
                'eta' => (int)$v->eta,
                'marche' => $v->marche,
                'genere' => $v->genere,
                'personaggi' => $v->personaggi,
                'colore' => $v->colore
            ]);

            // Storing unique color of each product
            if (strlen($v->colore)) {
                $color = Color::updateOrCreate([
                    'name' => $v->colore
                ]);
            }

            // Storing unique category of each product
            $categories = $v->categories;
            foreach ($categories as $category) {
                foreach ($category as $k1 => $v1) {
                    foreach ($v1 as $k2 => $v2) {
                        if ($k2 == 'category1') {
                            $category = Category::updateOrCreate([
                                '_id' => $v2->id,
                                'name' => $v2->name,
                                'parent_id' => null
                            ]);
                        } elseif ($k2 == 'category2') {
                            $category = Category::updateOrCreate([
                                '_id' => $v2->id,
                                'name' => $v2->name,
                                'parent_id' => $v1->category1->id
                            ]);
                        } elseif ($k2 == 'category3') {
                            $category = Category::updateOrCreate([
                                '_id' => $v2->id,
                                'name' => $v2->name,
                                'parent_id' => $v1->category2->id
                            ]);
                        } elseif ($k2 == 'category4') {
                            $category = Category::updateOrCreate([
                                '_id' => $v2->id,
                                'name' => $v2->name,
                                'parent_id' => $v1->category3->id
                            ]);
                        }

                        // Establishing relation product-category for each category
                        $product->categories()->attach($category);

                        // Establishing relation category-color for each category
                        if ($color) {
                            CategoryColor::updateOrCreate([
                                'color_id' => $color->id,
                                'category_id' => $category->id
                            ]);
                        }
                    }
                }
            }

            $gallery = $v->gallery;

            // Establishing relation Product-image for each product 
            foreach ($gallery as $images) {
                foreach ($images as $k => $v) {
                    Gallery::create([
                        'link' => $v,
                        'product_id' => $product->id
                    ]);
                }
            }
        }
    }
}
