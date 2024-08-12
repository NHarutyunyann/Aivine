<?php
namespace App\Services;

use Cocur\Slugify\Slugify;
use Illuminate\Support\Facades\Session;


class HelperService {

    public function getAllSubCategoryIds($category, $onlyId = true) {
        $result = $onlyId ? [$category->id] : [$category];

        if(!$category->subCategories->isEmpty()) {
            foreach ($category->subCategories as $subCategory) {
                $result = array_merge($result, $this->getAllSubCategoryIds($subCategory, $onlyId));
            }
        }
        return $result;
    }

    public function formatPrice(string $price) {
        if(!$price) {
            return $price;
        }

        if(trim($price)) {
            if(in_array(substr($price, -3, 1), [',', '.'])) {
                $price = substr_replace($price, '|', -3, 1);
            }
        }

        $price = str_replace(str_split(' ,.'), '', $price);
        $price = preg_replace('/\xc2\xa0/', '', $price);
        $price = str_replace('|', '.', $price);

        if(is_numeric($price)) {
            $price = +number_format($price, 2, '.', '');
        }

        return $price;
    }

    public function formatNumber($number) {
        if(!$number) {
            return $number;
        }

        $number = str_replace(str_split(' ,.'), '', $number);
        $number = preg_replace('/\xc2\xa0/', '', $number);

        if(is_numeric($number)) {
            $number = (int)+number_format($number, 2, '.', '');
        }

        return $number;
    }

    public function cleanString($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }

    public function filterText($text) {
        if(!is_string($text)) {
            return $text;
        }

        return htmlspecialchars_decode(trim(preg_replace('/\s+/', '', $text)));
    }

    public function isMobile() {
        return isset($_SERVER["HTTP_USER_AGENT"]) ? preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]) : false;
    }

    public static function slugify($text) {
        $slugify = new Slugify();
        $slugify->activateRuleSet('armenian');
        $slugify->addRule('&', 'and');
        $slugify->addRule('.', '-');
        $slugify->addRule('/', '-');
        $slugify->addRule('\\', '-');
        return $slugify->slugify($text);
    }

    public function getAuthUser () {
        $user = \Illuminate\Support\Facades\Auth::user();

        if(!$user) {
            return null;
        }

        $role = $user->roles && isset($user->roles[0]) ? $user->roles[0]['name'] : null;

        return [
          'id' => $user->id,
          'name' => $user->name,
          'email' => $user->email,
          'role' => $role,
          'isAdmin' => $role === 'admin' || $role === 'Super Admin',
          'isSuperAdmin' => $role === 'Super Admin',
          'details' => $user->details ?? [],
        ];
    }

    public function translate($obj, $name){
        
        if(!Session::get('locale') || Session::get('locale') == 'en'){
           return $obj->$name;
        } else{
            return $obj->{$name . '_' . Session::get('locale') };
         }
    }
}
