<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Animal;
use App\Models\User;
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model=Animal::class;
    public function definition()
    {
        return [
            //
            'type_id'=>$this->faker->numberBetween(1,3),
            'name'=>$this->faker->name,
            'birthday'=>$this->faker->date(),
            'area'=>$this->faker->city(),
            'fix'=>$this->faker->boolean,
            'description'=>$this->faker->text,
            'personality'=>$this->faker->text,
//            'user_id'=>User::all()->random()->id

        ];
    }
}
