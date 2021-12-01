<?php

class CT_CtProgressbar_Widget extends Case_Theme_Core_Widget_Base{
    protected $name = 'ct_progressbar';
    protected $title = 'Case Progress Bar';
    protected $icon = 'eicon-skill-bar';
    protected $categories = array( 'case-theme-core' );
    protected $params = '{"sections":[{"name":"source_section","label":"Source Settings","tab":"content","controls":[{"name":"progressbar_list","label":"Progress Bar Lists","type":"repeater","controls":[{"name":"title","label":"Title","type":"text","label_block":true},{"name":"percent","label":"Percentage","type":"slider","default":{"size":50,"unit":"%"},"label_block":true}],"title_field":"{{{ title }}}"},{"name":"layout","label":"Layout","type":"select","options":{"1":"Layout 1","2":"Layout 2","3":"Layout 3","4":"Layout 4","5":"Layout 5","6":"Layout 6"},"default":"1"}]},{"name":"section_title","label":"Style","tab":"style","controls":[{"name":"title_color","label":"Title Color","type":"color","selectors":{"{{WRAPPER}} .ct-progressbar .ct-progress-title":"color: {{VALUE}};"}},{"name":"typography","label":"Title Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .ct-progressbar .ct-progress-title"},{"name":"percent_color","label":"Percentage Color","type":"color","selectors":{"{{WRAPPER}} .ct-progressbar .ct-progress-percentage":"color: {{VALUE}};"}},{"name":"percent_typography","label":"Percentage Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .ct-progressbar .ct-progress-percentage"},{"name":"bar_color","label":"Bar Color","type":"color","selectors":{"{{WRAPPER}} .ct-progressbar .ct-progress-holder":"background-color: {{VALUE}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'progressbar','ct-progressbar-widget-js' );
}