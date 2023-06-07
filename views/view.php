<?php

// The View handles the presentation logic

class View {
    public function render($page,$data) {
        include 'pages/'.$page.'.php';
    }
}

?>
