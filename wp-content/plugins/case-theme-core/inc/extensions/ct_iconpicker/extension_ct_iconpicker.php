<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('CT_Redux_Extensions_ct_iconpicker')) {

    class CT_Redux_Extensions_ct_iconpicker {

        protected $parent;
        public $extension_url;
        public $extension_dir;
        public static $theInstance;
        public static $version = "1.0.0";
        public $is_field = false;

        public function __construct($parent) {
            $this->parent = $parent;
            $this->field_name = 'ct_iconpicker';

            self::$theInstance = $this;

            $this->is_field = Redux_Helpers::isFieldInUse($parent, $this->field_name);

            add_filter('redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array(
                $this,
                'overload_field_path'
            ));
        }

        public function overload_field_path($field) {
            return dirname(__FILE__) . '/inc/field_' . $this->field_name . '.php';
        }
    }
}
