<?php

$entity = $vars["entity"];

echo elgg_view("output/text", array("value" => elgg_echo("newsletter:edit:content:description")));

echo "<div class='mvm'>" . elgg_view("input/longtext", array("name" => "content", "value" => $entity->content, "id" => "newsletter-edit-content-" . $entity->getGUID())) . "</div>";

echo elgg_view("newsletter/placeholders");

echo "<div class='elgg-foot mtm'>";
echo elgg_view("input/hidden", array("name" => "guid", "value" => $entity->getGUID()));
echo elgg_view("input/submit", array("value" => elgg_echo("save")));
echo "</div>";

