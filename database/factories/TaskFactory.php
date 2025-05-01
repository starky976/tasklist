<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $content = ['Web用', '機械学習用', 'フロントエンド用', '業務用', 'Unitiy用'];
        $status = ['未達成', '着手', 'レビュー待ち', '公開依頼', '完了', '外部委託'];

        $content = $content[rand(0, count($content) - 1)];
        $status = $status[rand(0, count($status) - 1)];
        return [
            'content' => $content,
            'status' => $status,
        ];
    }
}
