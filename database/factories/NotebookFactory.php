<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Lib\TranslitStr;

class NotebookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        return [
            'user_id' => 1,
            'title' => $name,
            'alias' => TranslitStr::convert($name),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
