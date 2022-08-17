<?php

namespace Database\Factories;

use App\Helpers\ArrHelper;
use App\Helpers\CalHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $genders = ArrHelper::getList('genders');

        $gender = $this->faker->randomElement($genders);
        $name = $this->faker->name($gender);
        $username = str_replace(" ", ".", strtolower($name));
        $created_at = CalHelper::randomDate(
            Carbon::now()->startOfYear()->toDateTimeString(),
            Carbon::yesterday()->toDateTimeString()
        );

        return [
            'uuid' => $this->faker->uuid,
            'name' => $name,
            'gender' => $gender,
            'birth_date' => $this->faker->dateTimeBetween($startDate = '-50 years', $endDate = '-18 years', $timezone = null),
            'username' => $username,
            'email' => $username.'@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'status' => 'activated',
            'remember_token' => Str::random(10),
            'created_at' => $created_at
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (User $user) {
            //
        })->afterCreating(function (User $user) {
            $user->assignRole('user');
        });
    }
}
