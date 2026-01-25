<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

final class SettingService
{
    /**
     * Fetch the settings and catch the results
     */
    public function getSettings()
    {
        return Cache::rememberForever('settings', function () {
            return Setting::pluck('value', 'key')
                ->toArray();
        });
    }

    /**
     * Sets the settings inside a global config for use
     * 
     * @return void
     */
    public function setSettings(): void
    {
        $settings = $this->getSettings();
        config()->set('settings', $settings);
    }

    /**
     * Clear Cached settings
     * 
     * @return void
     */
    public function clearCachedSettings(): void
    {
        Cache::forget('settings');
    }
}
