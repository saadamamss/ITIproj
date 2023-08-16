<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=MainSetting>
 */
class MainSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'siteName'=>'mshop',
            'siteUrl'=>'mshop.lm',
            'siteDesc'=>'site description',
            'email'=>'contact@mshop.lm',
            'phone'=>'+201224541874',
            'address'=>'562 Wellington Road',
            'sitelogo'=>'logo.png',
            'social'=>'facebook.com,instagram.com,twitter.com,youtube.com,pinterest.com',
        ];
    }
}
