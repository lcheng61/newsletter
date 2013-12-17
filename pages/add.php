<?php

	/**
	 * Create a new newsletter
	 *
	 * @uses elgg_get_page_owner_entity() the container in which to create the newsletter
	 */

	gatekeeper();

	$page_owner = elgg_get_page_owner_entity();
	
	// check if we have access
	if (elgg_instanceof($page_owner, "user")) {
		// access to site newsletters is only for admins
		if ($page_owner->isAdmin()) {
			$container_guid = elgg_get_site_entity()->getGUID();
		} else {
			forward(REFERER);
		}
	} elseif (elgg_instanceof($page_owner, "group")) {
		// only for group owners/admins
		if ($page_owner->canEdit()) {
			$container_guid = $page_owner->getGUID();
		} else {
			forward(REFERER);
		}
	} else {
		forward(REFERER);
	}

	// breadcrumb
	elgg_push_breadcrumb(elgg_echo("newsletter:breadcrumb:site"), "newsletter/site");
	if (elgg_instanceof($page_owner, "group")) {
		elgg_push_breadcrumb($page_owner->name, "newsletter/group/" . $page_owner->getGUID());
	}
	elgg_push_breadcrumb(elgg_echo("add"));

	// build page elements
	$title_text = elgg_echo("newsletter:add:title");
	
	$body_vars = array(
		"container_guid" => $container_guid
	);
	$form = elgg_view_form("newsletter/edit", array(), $body_vars);
	
	// build page
	$page_data = elgg_view_layout("content", array(
		"title" => $title_text,
		"content" => $form,
		"filter" => ""
	));
	
	// draw page
	echo elgg_view_page($title_text, $page_data);