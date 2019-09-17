<?php
class ftk extends xlib {
    function __construct() {
        $this->req(["head", "body", "footer"]);
        $head = new head();
        $body = new body();
        $footer = new footer();
        $this->execute($head, $body, $footer);
    }
    
    function execute($head, $body, $footer) {
        $head->execute('вапвапвапвап');
        $body->layout_multiForm();
        $footer->execute();
    }
}