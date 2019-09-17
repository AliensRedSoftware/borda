<?php

/**
 * lightbox
 * v2.1.0
 */
class lightbox {
    
    /**
     * Возвращает картинку
     */
    public function img ($url = "https://proxy.duckduckgo.com/iu/?u=http%3A%2F%2Fteapoetry.com%2Fwp-content%2Fuploads%2F2016%2F06%2Frabstol_net_tea_14.jpg&f=1", $width = '50%') {
        return "<a class='example-image-link' href=$url style=\"width:$width;\" data-lightbox='example-1'><img class='example-image' src=$url alt='image-1' style=\"width:$width;\"/></a>";
    }
}