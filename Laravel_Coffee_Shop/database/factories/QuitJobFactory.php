<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\QuitJob;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuitJobFactory extends Factory
{
    protected $model = QuitJob::class;

    public function definition(): array
    {
        $descriptions = [
            'My manager schedules me for double shifts with no notice and refuses to pay overtime.',
            'The work environment has become extremely toxic and is affecting my mental health.',
            'I am constantly asked to do work far outside my job role with no compensation.',
            'The company ignores safety regulations and I no longer feel safe at work.',
            'I have not received a raise in years despite increased responsibilities.',
            'My supervisor regularly belittles me in front of customers.',
            'I am expected to be on call 24/7 with no work-life balance.',
            'The company promised remote work but suddenly revoked it without explanation.',
            'I have been denied legally required breaks during long shifts.',
            'The stress from this job has started to affect my physical health.'
        ];

        $job_descriptions = [
            'Must help me sneak out of my company unnoticed.',
            'Need emotional support while I intentionally delete the entire company database.',
            'Looking for someone to tell me ‘you don’t need this job’ every morning.',
            'Please distract my manager while I quietly disappear.',
            'Assist with drafting a resignation email that I will absolutely overthink.',
            'Help me walk out as dramatically as possible.',
            'Need backup while I return my laptop and pretend I’m fine.',
            'Someone convince me quitting is not a bad life decision.',
            'Help me practice saying ‘I’m pursuing other opportunities’ with a straight face.',
            'Stand nearby while I finally hit ‘send’ on my resignation.',
        ];

        return [
            'user_id' => User::factory(),
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->randomElement($descriptions),
            'job_description' => $this->faker->randomElement($job_descriptions),
            'salary' => $this->faker->numberBetween(1, 150),
        ];
    }
}
