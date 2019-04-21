<?php
include dirname(__FILE__).'/../models/Listing.php';
use \WebApp\Model\Listing;

function getListings() {
	if (isset($_GET['user'])) {
		return Listing::getByUser($_GET['user']);
	}
	else if (isset($_GET['query'])) {
		return Listing::search($_GET['query']);
	}
	else {
		return Listing::getLatest(10);
	}
}

function getListing() {
	if (isset($_GET['id'])) {
		return Listing::get($_GET['id']);
	}
	else {
		return NULL;
	}
}

function newListing($user) {
	global $errors;

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['price']) && isset($user)) {
		try {
			$newListing = new Listing($_POST['title'], $_POST['description'], $_POST['price'], time(), $user->name);
			$newListing->put();
			return true;
		}
		catch (Exception $e) {
			$errors .= $e->getMessage();
			return false;
		}
	}
	else {
		return false;
	}
}
//var_dump($listings);

?>
