<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = [
            ['name' => 'Panadol Extra', 'desc' => 'Pain relief tablets for headaches, fever, and body aches', 'price' => 45.00],
            ['name' => 'Antinal', 'desc' => 'Treatment for diarrhea and intestinal infections', 'price' => 28.50],
            ['name' => 'Congestal', 'desc' => 'Cold and flu relief tablets', 'price' => 35.00],
            ['name' => 'Augmentin 1g', 'desc' => 'Antibiotic for bacterial infections', 'price' => 120.00],
            ['name' => 'Brufen 600mg', 'desc' => 'Anti-inflammatory and pain relief medication', 'price' => 52.00],
            ['name' => 'Strepsils Honey & Lemon', 'desc' => 'Sore throat lozenges', 'price' => 30.00],
            ['name' => 'Ventolin Inhaler', 'desc' => 'Asthma relief inhaler', 'price' => 85.00],
            ['name' => 'Vitamin D3 5000 IU', 'desc' => 'Vitamin D supplement for bone health', 'price' => 95.00],
            ['name' => 'Omega 3 Fish Oil', 'desc' => 'Heart health and brain function supplement', 'price' => 180.00],
            ['name' => 'Zinc 50mg', 'desc' => 'Immune system support supplement', 'price' => 70.00],
            ['name' => 'Blood Pressure Monitor', 'desc' => 'Digital automatic blood pressure monitor', 'price' => 650.00],
            ['name' => 'Glucometer Kit', 'desc' => 'Blood sugar monitoring device with 50 test strips', 'price' => 450.00],
            ['name' => 'First Aid Kit', 'desc' => 'Complete first aid kit for home use', 'price' => 280.00],
            ['name' => 'Digital Thermometer', 'desc' => 'Fast and accurate digital thermometer', 'price' => 120.00],
            ['name' => 'Face Masks (50pcs)', 'desc' => 'Disposable medical face masks', 'price' => 95.00],
        ];

        $product = fake()->randomElement($products);

        return [
            'name' => $product['name'],
            'description' => $product['desc'],
            'price' => $product['price'],
            'stock' => fake()->numberBetween(10, 200),
            'image' => null, // Will be added manually or via seeder
        ];
    }
}