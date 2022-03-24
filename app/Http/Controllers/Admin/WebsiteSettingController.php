<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Setting;
use App\Models\StaticDataTranslation;
use App\Models\cat_setting;
use Illuminate\Http\Request;

class WebsiteSettingController extends Controller
{
    public function homePageSettingsEdit()
    {
        $languages = Language::all();
        $settings = [];
        foreach (Setting::all() as $settings_obj)
      
        return view('admin.website_settings.home_page', compact('languages', 'settings'));
    }

    public function homePageSettingsUpdate()
    {
        $rules = [
            "index_features_text1" => ['required'],
            "index_feature_icon1_class" => ['required'],
            "index_features_text2" => ['required'],
            "index_feature_icon2_class" => ['required'],
            "index_features_text3" => ['required'],
            "index_feature_icon3_class" => ['required'],

            "index_main_ad" => ['image', 'mimes:jpg,jpeg,png,gif,svg', 'max:2048'],

            "index_sub_ad1_url" => ['image', 'mimes:jpg,jpeg,png,gif,svg', 'max:2048'],
            "index_sub_ad2_url" => ['image', 'mimes:jpg,jpeg,png,gif,svg', 'max:2048'],
        ];
        request()->validate($rules);
        // dd(request());
        $delete_me = [
            "index_features_on" => "on",
            "index_features_text1" => null,
            "index_feature_icon1_class" => "fa fa-cc-discover",
            "index_features_text2" => null,
            "index_feature_icon2_class" => "fa fa-cc-discover",
            "index_features_text3" => null,
            "index_feature_icon3_class" => "fa fa-cc-discover",

            "index_main_ad_section_on" => "on",
            "index_main_ad" => null,

            "index_sub_ad_section_on" => "on",
            "index_sub_ad1_url" => null,
            "index_sub_ad2_url" => null,

            "index_newest_products_section_on" => "on",
            "index_side_category_on" => "on"

        ];
        $change_settings = [
            "index_features_on" => (request("index_features_on") == 'on'),
            "index_feature_icon1_class" => request("index_feature_icon1_class"),
            "index_feature_icon2_class" => request("index_feature_icon2_class"),
            "index_feature_icon3_class" => request("index_feature_icon3_class"),
            "index_main_ad_section_on" => (request("index_main_ad_section_on") == 'on'),
            "index_sub_ad_section_on" => (request("index_sub_ad_section_on") == 'on'),
            "index_newest_products_section_on" => (request("index_newest_products_section_on") == 'on'),
            "index_side_category_on" => (request("index_side_category_on") == 'on'),
        ];
        $potential_images = [
            "index_main_ad",
            "index_sub_ad1_url",
            "index_sub_ad2_url"
        ];
        foreach ($potential_images as $potential_image) {
            if (request()->hasFile($potential_image)) {
                $image = request($potential_image);
                $image_new_name = time() . rand(10, 10000) . '.' . $image->extension();
                $image->move(public_path('storage/images_uploaded/'), $image_new_name);
                $change_settings[$potential_image] = 'public/storage/images_uploaded/' . $image_new_name;
            }
        }
        foreach ($change_settings as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            $setting->value = $value;
            $setting->save();
        }
      $sid=Setting::where('key','index_side_category_on')->first();
        foreach($sid->cats as $s){
            $s->delete();
        }
        foreach(request('cat_side') as $cat){
            cat_setting::create(['cat_id'=>$cat,'setting_id'=>$sid->id]);
        }
        $change_static_data_translations = [
            "index_features_text1" => request("index_features_text1"),
            "index_features_text2" => request("index_features_text2"),
            "index_features_text3" => request("index_features_text3")
        ];
        foreach ($change_static_data_translations as $static_data_key => $static_data_value) {
            foreach (Language::all() as $language_key => $language) {
                $static_data_translation = StaticDataTranslation::where('key', $static_data_key)
                    ->where('language_id', $language->id)->first();
                $static_data_translation->value = $static_data_value[$language_key];
                $static_data_translation->save();
            }
        }
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' => __('lang.alert_congrats'),
            'text' => __('lang.alert_success_add')
        ]]);
    }

    // image, text, content, textarea, icon, setting_text
    private static $about_us_content = [
        [
            "cnt" => "",
            "trans_key" => "who_we_are",
            "key" => "about_who_we_are_section_on",
            "data" => [
                ["trans_key" => "image", "cnt" => "", "key" => "about_who_we_are_image", "type" => "image"],
                ["trans_key" => "title_", "cnt" => "", "key" => "about_who_we_are_title", "type" => "text"],
                ["trans_key" => "content", "cnt" => "", "key" => "about_who_we_are_content", "type" => "content"],
            ]
        ],
        [
            "cnt" => "",
            "trans_key" => "why_choose_us",
            "key" => "about_choose_us_section_on",
            "data" => [
                ["trans_key" => "title_", "cnt" => "", "key" => "about_choose_us_title", "type" => "text"],
                ["trans_key" => "description", "cnt" => "", "key" => "about_choose_us_description", "type" => "textarea"],

                ["trans_key" => "icon", "cnt" => " 1", "key" => "about_choose_us_icon1", "type" => "icon"],
                ["trans_key" => "icon", "cnt" => " 2", "key" => "about_choose_us_icon2", "type" => "icon"],
                ["trans_key" => "icon", "cnt" => " 3", "key" => "about_choose_us_icon3", "type" => "icon"],

                ["trans_key" => "card_title", "cnt" => " 1", "key" => "about_choose_us_section1_title", "type" => "text"],
                ["trans_key" => "card_title", "cnt" => " 2", "key" => "about_choose_us_section2_title", "type" => "text"],
                ["trans_key" => "card_title", "cnt" => " 3", "key" => "about_choose_us_section3_title", "type" => "text"],

                ["trans_key" => "card_text", "cnt" => " 1", "key" => "about_choose_us_section1_text", "type" => "textarea"],
                ["trans_key" => "card_text", "cnt" => " 2", "key" => "about_choose_us_section2_text", "type" => "textarea"],
                ["trans_key" => "card_text", "cnt" => " 3", "key" => "about_choose_us_section3_text", "type" => "textarea"],
            ]
        ],
        [
            "cnt" => "",
            "trans_key" => "features",
            "key" => "about_features_section_on",
            "data" => [
                ["trans_key" => "icon", "cnt" => " 1",  "key" => "about_feature1_icon", "type" => "icon"],
                ["trans_key" => "icon", "cnt" => " 2",  "key" => "about_feature2_icon", "type" => "icon"],
                ["trans_key" => "icon", "cnt" => " 3",  "key" => "about_feature3_icon", "type" => "icon"],

                ["trans_key" => "feature_title", "cnt" => " 1",  "key" => "about_feature1_title", "type" => "text"],
                ["trans_key" => "feature_title", "cnt" => " 2",  "key" => "about_feature2_title", "type" => "text"],
                ["trans_key" => "feature_title", "cnt" => " 3",  "key" => "about_feature3_title", "type" => "text"],

                ["trans_key" => "feature_text", "cnt" => " 1",  "key" => "about_feature1_text", "type" => "textarea"],
                ["trans_key" => "feature_text", "cnt" => " 2",  "key" => "about_feature2_text", "type" => "textarea"],
                ["trans_key" => "feature_text", "cnt" => " 3",  "key" => "about_feature3_text", "type" => "textarea"],
            ]
        ],
        // [
        //     "trans_key" => "image",
        //     "key" => "about_members_section_on",
        //     "data" => [
        //         ["trans_key" => "text", "cnt" => " 1",  "key" => "about_member1_name", "type" => "text"],
        //         ["trans_key" => "text", "cnt" => " 1",  "key" => "about_member2_name", "type" => "text"],
        //         ["trans_key" => "text", "cnt" => " 1",  "key" => "about_member3_name", "type" => "text"],
        //         ["trans_key" => "text", "cnt" => " 1",  "key" => "about_member4_name", "type" => "text"],

        //         ["trans_key" => "image", "cnt" => " 1",  "key" => "about_members_image1", "type" => "image"],
        //         ["trans_key" => "image", "cnt" => " 1",  "key" => "about_members_image2", "type" => "image"],
        //         ["trans_key" => "image", "cnt" => " 1",  "key" => "about_members_image3", "type" => "image"],
        //         ["trans_key" => "image", "cnt" => " 1",  "key" => "about_members_image4", "type" => "image"],

        //         ["trans_key" => "title_", "cnt" => " 1",  "key" => "about_members_title", "type" => "text"],
        //         ["trans_key" => "description", "cnt" => " 1",  "key" => "about_members_description", "type" => "textarea"],

        //         ["trans_key" => "text", "cnt" => " 1",  "key" => "about_member1_role", "type" => "text"],
        //         ["trans_key" => "text", "cnt" => " 1",  "key" => "about_member2_role", "type" => "text"],
        //         ["trans_key" => "text", "cnt" => " 1",  "key" => "about_member3_role", "type" => "text"],
        //         ["trans_key" => "text", "cnt" => " 1",  "key" => "about_member4_role", "type" => "text"],
        //     ]
        // ],
    ];
    private static $website_layout_content = [
        [
            "cnt" => "",
            "trans_key" => "header_features",
            "key" => "header_features_on",
            "data" => [
                ["trans_key" => "feature", "cnt" => "1", "key" => "header_feature_1", "type" => "text"],
                ["trans_key" => "feature", "cnt" => "2", "key" => "header_feature_2", "type" => "text"],
            ]
        ],
        [
            "cnt" => "1",
            "trans_key" => "social",
            "key" => "social1_on",
            "data" => [
                ["trans_key" => "url", "cnt" => "", "key" => "social1_url", "type" => "setting_text"],
                ["trans_key" => "icon", "cnt" => "", "key" => "social1_icon", "type" => "icon"],
            ]
        ],
        [
            "cnt" => "2",
            "trans_key" => "social",
            "key" => "social2_on",
            "data" => [
                ["trans_key" => "url", "cnt" => "", "key" => "social2_url", "type" => "setting_text"],
                ["trans_key" => "icon", "cnt" => "", "key" => "social2_icon", "type" => "icon"],
            ]
        ],
        [
            "cnt" => "3",
            "trans_key" => "social",
            "key" => "social3_on",
            "data" => [
                ["trans_key" => "url", "cnt" => "", "key" => "social3_url", "type" => "setting_text"],
                ["trans_key" => "icon", "cnt" => "", "key" => "social3_icon", "type" => "icon"],
            ]
        ],
        [
            "cnt" => "4",
            "trans_key" => "social",
            "key" => "social4_on",
            "data" => [
                ["trans_key" => "url", "cnt" => "", "key" => "social4_url", "type" => "setting_text"],
                ["trans_key" => "icon", "cnt" => "", "key" => "social4_icon", "type" => "icon"],
            ]
        ],
        [
            "cnt" => "5",
            "trans_key" => "social",
            "key" => "social5_on",
            "data" => [
                ["trans_key" => "url", "cnt" => "", "key" => "social5_url", "type" => "setting_text"],
                ["trans_key" => "icon", "cnt" => "", "key" => "social5_icon", "type" => "icon"],
            ]
        ],
        [
            "cnt" => "",
            "trans_key" => "small_description",
            "key" => "footer_small_description_on",
            "data" => [
                ["trans_key" => "empty_string", "cnt" => "", "key" => "about_us_small_description", "type" => "text"],
            ]
        ],
        [
            "cnt" => "",
            "trans_key" => "phone",
            "key" => "footer_phone_on",
            "data" => [
                ["trans_key" => "empty_string", "cnt" => "", "key" => "phone", "type" => "setting_text"],
            ]
        ],
        [
            "cnt" => "",
            "trans_key" => "email",
            "key" => "footer_email_on",
            "data" => [
                ["trans_key" => "empty_string", "cnt" => "", "key" => "email", "type" => "setting_text"],
            ]
        ],
        [
            "cnt" => "1",
            "trans_key" => "mobile_app",
            "key" => "footer_app1_on",
            "data" => [
                ["trans_key" => "image", "cnt" => "", "key" => "footer_app_image1", "type" => "image"],
                ["trans_key" => "url", "cnt" => "", "key" => "footer_app_url1", "type" => "setting_text"],
            ]
        ],
        [
            "cnt" => "2",
            "trans_key" => "mobile_app",
            "key" => "footer_app2_on",
            "data" => [
                ["trans_key" => "image", "cnt" => "", "key" => "footer_app_image2", "type" => "image"],
                ["trans_key" => "url", "cnt" => "", "key" => "footer_app_url2", "type" => "setting_text"],
            ]
        ],
        [
            "cnt" => "",
            "trans_key" => "site_logo",
            "key" => "site_logo_on",
            "data" => [
                ["trans_key" => "image", "cnt" => "", "key" => "site_logo", "type" => "image"],
            ]
        ],
        [
            "cnt" => "",
            "trans_key" => "site_logo_footer",
            "key" => "site_logo_footer_on",
            "data" => [
                ["trans_key" => "image", "cnt" => "", "key" => "site_logo_footer", "type" => "image"],
            ]
        ],
        [
            "cnt" => "",
            "trans_key" => "site_icon",
            "key" => "site_icon_on",
            "data" => [
                ["trans_key" => "image", "cnt" => "", "key" => "site_icon", "type" => "image"],
            ]
        ],
    ];
    private static $term_condition_content = [
        [
            "cnt" => "",
            "trans_key" => "terms_and_conditions",
            "key" => "off",
            "data" => [
                ["trans_key" => "empty_string", "cnt" => "",  "key" => "terms_and_conditions_content", "type" => "content"],
            ]
        ],
    ];
    // private static
    private static $icons = [
        "flaticon-shipped",
        "fab fa-cc-visa",
        "fas fa-life-ring",
        "fal fa-money-bill-wave",
        "fal fa-clock",
        "fad fa-credit-card",
        "flaticon-money-back",
        "flaticon-support",
        "ti-pencil-alt",
        "ti-layers",
        "ti-email",
        "fal fa-phone",
        "fal fa-envelope",
        "fab fa-linkedin-in",
        "fab fa-facebook-f",
        "fab fa-twitter",
        "fab fa-instagram",
        "fab fa-snapchat-ghost",
        "fab fa-youtube",
        "fal fa-envelope",
    ];

    public function websiteSettingEdit($page_name)
    {
        $content = self::${"${page_name}_content"};
        $languages = Language::all();
        $settings = [];
        foreach (Setting::all() as $settings_obj)
            $settings[$settings_obj->key] = $settings_obj->value;
        $icons = self::$icons;
        return view('admin.website_settings.website_settings', compact('languages', 'settings', "content", "icons", "page_name"));
    }

    public function websiteSettingUpdate(Request $request, $page_name)
    {
        /*
        all types: image, text, content, textarea, icon

        $potential_images => images
        $change_settings => icons, sections
        $change_static_data_translations => text, content, textarea
        */
        $change_settings = [];
        $potential_images = [];
        $change_static_data_translations = [];
        $rules = [];
        foreach (self::${"${page_name}_content"} as $section) {
            $section_key = $section["key"];
            $change_settings["$section_key"] = (request($section_key) == "on");
            foreach ($section['data'] as $item) {
                $item_key = $item["key"];
                if ($item["type"] == "image") {
                    array_push($potential_images, $item_key);
                    $rules["$item_key"] = ['image', 'mimes:jpg,jpeg,png,gif,svg', 'max:2048'];
                } elseif ($item["type"] == "icon" || $item["type"] == "setting_text") {
                    $change_settings["$item_key"] = (request($item_key));
                } else {
                    $change_static_data_translations["$item_key"] = (request($item_key));
                    if ($item['type'] == "text")
                        $rules["$item_key"] = ['required', "max:255"];
                    else
                        $rules["$item_key"] = ['required'];
                }
            }
        }
        request()->validate($rules);

        foreach ($potential_images as $potential_image) {
            if (request()->hasFile($potential_image)) {
                $image = request($potential_image);
                $image_new_name = time() . rand(10, 10000) . '.' . $image->extension();
                $image->move(public_path('storage/images_uploaded/'), $image_new_name);
                $change_settings[$potential_image] = 'public/storage/images_uploaded/' . $image_new_name;
            }
        }

        foreach ($change_settings as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            $setting->value = $value;
            $setting->save();
        }

        foreach ($change_static_data_translations as $static_data_key => $static_data_value) {
            foreach (Language::all() as $language_key => $language) {
                $static_data_translation = StaticDataTranslation::where('key', $static_data_key)
                    ->where('language_id', $language->id)->first();
                $static_data_translation->value = $static_data_value[$language_key];
                $static_data_translation->save();
            }
        }
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' => __('lang.alert_congrats'),
            'text' => __('lang.alert_success_add')
        ]]);
    }

    public function websiteLayoutEdit()
    {
    }
}
