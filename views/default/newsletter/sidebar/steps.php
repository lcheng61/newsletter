<?php

$menu = elgg_view_menu("newsletter_steps", array("entity" => $vars["entity"], "class" => "elgg-menu-page"));

echo elgg_view_module("aside", elgg_echo("newsletter:sidebar:steps"), $menu);