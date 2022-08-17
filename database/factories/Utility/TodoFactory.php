<?php

namespace Database\Factories\Utility;

use App\Models\User;
use App\Models\Utility\Todo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $is_completed = $this->faker->randomElement([1, 0]);
        $due_date = $this->faker->randomElement([
            Carbon::today()->toDateString(),
            Carbon::yesterday()->toDateString(),
            Carbon::tomorrow()->toDateString()
        ]);
        $due_time = $this->faker->randomElement(['11:30:00', '12:45:00', '13:10:00', '14:15:00', '18:10:00', null]);

        $completed_at = null;

        if ($is_completed) {
            $completed_at = $due_time ? ($due_date.' '.$due_time) : ($due_date.' 11:45:00');
        }

        return [
            'uuid' => Str::uuid(),
            'title' => $this->faker->realText(rand(10,60)),
            'description' => $this->faker->realText(rand(50, 250)),
            'due_date' => $due_date,
            'due_time' => $due_time,
            'user_id' => $this->faker->randomElement(User::all()->pluck('id')->all()),
            'status' => $is_completed,
            'completed_at' => $completed_at
        ];
    }
}
