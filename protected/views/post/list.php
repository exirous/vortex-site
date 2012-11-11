<?php
foreach ($posts as $post) {
    echo "<li>".CHTML::link($post->title, array('post/view', 'id' => $post->id))."</li>";
} ?>