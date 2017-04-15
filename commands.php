<?php 

$available_commands = [

	"/contact" => array("name"=>"contact", "description"=>"description of contact", "permission"=>USER),
	"/post_validation" => array("name"=>"post_validation", "description"=>"description of post_validation", "permission"=>AUTHOR),
	"/cancel" => array("name"=>"cancel", "description"=>"description of cancel", "permission"=>USER),
	"/schedule_post" => array("name"=>"schedule_post", "description"=>"description of schedule_post", "permission"=>ADMIN),
	"/start" => array("name"=>"start", "description"=>"description of start", "permission"=>USER),
	"/help" => array("name"=>"help", "description"=>"description of help", "permission"=>USER),

];

function get_command($text) {
	global $available_commands;
	$contain_these_commands = array();
	foreach ($available_commands as $command=>$command_array) {
		if (contains_word($text, $command))
			$contain_these_commands[] = $command;
	}
	return $contain_these_commands;
}
function run_commands($text, $chat_id, $message_id, $message) {
	global $available_commands;
	$command = get_command($text);
	foreach ($command as $cmd) {
		$func = 'run_' . $available_commands[$cmd]["name"] . '_command';
		$func($chat_id, $text, $message_id, $message);
	}
}

foreach (glob("./commands/*.php") as $filename) {
    require ($filename);
}
