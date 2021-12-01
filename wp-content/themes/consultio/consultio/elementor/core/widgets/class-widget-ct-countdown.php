<?php

class CT_CtCountdown_Widget extends Case_Theme_Core_Widget_Base{
    protected $name = 'ct_countdown';
    protected $title = 'Case Countdown';
    protected $icon = 'eicon-countdown';
    protected $categories = array( 'case-theme-core' );
    protected $params = '{"sections":[{"name":"countdown_section","label":"Content","tab":"content","controls":[{"name":"date","label":"Date","type":"text","label_block":true,"description":"Set date count down (Date format: yy\/mm\/dd)"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}