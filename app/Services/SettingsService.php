<?php
namespace App\Services;

use App\Models\Setting;

class SettingsService {


    private $settings;

    const DEFAULT_SETTINGS = [
        'phone_number1' => '+374',
        'phone_number2' => '+374',
        'gmail' => '@gmail.com',
        'address' => 'Ք․Երևան',
        'latitude' => '40',
        'longitude' => '44',
        'min_weight' => null,
        'min_late_debt_allowed' => 100,
        'min_weight_groups' => [],
        'min_weight_categories' => [],
        'homepage_slider' => [],
    ];

    public function __construct()
    {
        $settings = Setting::whereIn('key', array_keys(self::DEFAULT_SETTINGS))->get();
        $this->settings = [];
        foreach ($settings as $setting) {
            $this->settings[$setting->key] = $setting->value;
        }
    }

    public function get($name, $expect = null)
    {
        if (isset($this->settings[$name])) {
            return $this->normalize(@unserialize($this->settings[$name]) ? @unserialize($this->settings[$name]) : $this->settings[$name], $expect);
        }
        if (isset(self::DEFAULT_SETTINGS[$name])) {
            return $this->normalize(self::DEFAULT_SETTINGS[$name], $expect);
        }
        return $this->normalize(null, $expect);
    }

    private function normalize($value, $expect) {
        switch ($expect) {
            case 'array': {
                return is_array($value) ? $value : [];
            }
            case 'bool': {
                return is_bool($value) ? $value : false;
            }
            default: {
                return $value;
            }
        }
    }

    public function list()
    {
        $result = [];

        foreach ($this->settings as $key => $setting) {
            $result[$key] = @unserialize($setting) ? @unserialize($setting) : $setting;
        }

        return $result;
    }

    public function save($key, $setting = null)
    {
        if(!array_key_exists($key, self::DEFAULT_SETTINGS)){
            return;
        }

        if (is_array($setting) && isset($setting['type']) && ($setting['type']) ==='checkbox' ){
            $value = (int)isset($setting['value']);
        } elseif (is_array($setting)) {
            $value = serialize($setting);
        } else {
            $value = $setting;
        }

        Setting::updateOrCreate(
            ["key" => $key],
            ["key" => $key, "value" => $value]
        );
    }
}
