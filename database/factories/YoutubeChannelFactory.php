<?php

namespace Database\Factories;

use App\Models\YoutubeChannels;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class YoutubeChannelFactory extends Factory 
{

     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = YoutubeChannels::class;

     /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'uuid' => $this->faker->uuid,
            'picture' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph,
        ];
    }

    

}