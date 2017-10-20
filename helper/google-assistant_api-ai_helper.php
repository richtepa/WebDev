<?php
$helper_message_counter = 0;
$helper_item_counter = 0;
$items;

$helper = helper_input();
echo json_encode($helper_output);

$helper_log["data"] = $helper;
$helper_log["output"] = $helper_output;

if($helper_config["log"]){
	$fp = fopen('log.json', 'w');
	fwrite($fp,json_encode($helper_log));
	fclose($fp);
}

function helper_input(){
	global $helper, $helper_config, $helper_log;
	$data = json_decode(file_get_contents("php://input"), true);
	$helper_log["input"] = $data;

	$helper["audio"] = false;
	$helper["screen"] = false;

	if($data["originalRequest"]["data"]["surface"]["capabilities"][0]["name"] == "actions.capability.AUDIO_OUTPUT"){
		$helper["audio"] = true;
	} else if($data["originalRequest"]["data"]["surface"]["capabilities"][0]["name"] == "actions.capability.SCREEN_OUTPUT"){
		$helper["screen"] = true;
	}
	if($data["originalRequest"]["data"]["surface"]["capabilities"][1]["name"] == "actions.capability.AUDIO_OUTPUT"){
		$helper["audio"] = true;
	} else if($data["originalRequest"]["data"]["surface"]["capabilities"][1]["name"] == "actions.capability.SCREEN_OUTPUT"){
		$helper["screen"] = true;
	}

	$helper["timestamp"] = $data["timestamp"];
	$helper["query"] = $data["originalRequest"]["data"]["inputs"][0]["rawInputs"][0]["query"];
	$helper["method"] = $data["originalRequest"]["data"]["inputs"][0]["rawInputs"][0]["inputType"];
	$helper["locale"] = $data["originalRequest"]["data"]["user"]["locale"];
	$helper["userId"] = $data["originalRequest"]["data"]["user"]["userId"];
	$helper["conversationId"] = $data["originalRequest"]["data"]["conversation"]["conversationId"];
	$helper["parameters"] = $data["result"]["parameters"];
	$helper["intent"] = $data["result"]["metadata"]["intentName"];

	if($helper_config["intent-function"]){
		$helper["intent"]();
	}

	return $helper;
}

function log_out($log){
	$fp = fopen('log_out.json', 'w');
	fwrite($fp,json_encode($log));
	fclose($fp);
}

function simple_response($text){
	global $helper, $helper_message_counter, $helper_output;

	$helper_output["messages"][$helper_message_counter]["platform"] = "google";
	$helper_output["messages"][$helper_message_counter]["type"] = "simple_response";
	$helper_output["messages"][$helper_message_counter]["textToSpeech"] = $text;

	$helper_message_counter ++;

}

function suggestion_chips($chips){
	global $helper, $helper_message_counter, $helper_output;

	$helper_output["messages"][$helper_message_counter]["platform"] = "google";
	$helper_output["messages"][$helper_message_counter]["type"] = "suggestion_chips";

	$length = count($chips);
	for($i = 0; $i < $length; $i++){
		$helper_output["messages"][$helper_message_counter]["suggestions"][$i]["title"] = $chips[$i];
	}

	$helper_message_counter ++;
}

function basic_card($title, $text, $img_url, $img_text, $link_title, $link_url){
	global $helper, $helper_message_counter, $helper_output, $helper_log;

	$helper_output["messages"][$helper_message_counter]["platform"] = "google";
	$helper_output["messages"][$helper_message_counter]["type"] = "basic_card";
	$helper_output["messages"][$helper_message_counter]["title"] = $title;
	$helper_output["messages"][$helper_message_counter]["formattedText"] = $text;
	$helper_output["messages"][$helper_message_counter]["image"]["url"] = $img_url;
	$helper_output["messages"][$helper_message_counter]["image"]["accessibilityText"] = $img_text;
	//$helper_output["messages"][$helper_message_counter]["buttons"][0]["title"] = $link_title;
	//$helper_output["messages"][$helper_message_counter]["buttons"][0]["openUrlAction"] = $link_url;

	$helper_message_counter ++;
}

function list_selector($title){
	global $helper, $helper_message_counter, $helper_output, $items;

	$helper_output["messages"][$helper_message_counter]["platform"] = "google";
	$helper_output["messages"][$helper_message_counter]["type"] = "list_card";
	$helper_output["messages"][$helper_message_counter]["title"] = $title;

	$amount = count($items);
	for($i = 0; $i < $amount; $i++){
		$helper_output["messages"][$helper_message_counter]["items"][$i] = $items[$i];
	}

	$helper_message_counter ++;
}

function carousel_selector($title){
	global $helper, $helper_message_counter, $helper_output, $items;

	$helper_output["messages"][$helper_message_counter]["platform"] = "google";
	$helper_output["messages"][$helper_message_counter]["type"] = "carousel_card";

	$amount = count($items);
	for($i = 0; $i < $amount; $i++){
		$helper_output["messages"][$helper_message_counter]["items"][$i] = $items[$i];
	}

	$helper_message_counter ++;
}

function addItem($title, $description, $img_url, $img_text){
	global $helper_item_counter, $items;
	$items[$helper_item_counter]["optionInfo"]["synonyms"][0] = $title;
	$items[$helper_item_counter]["optionInfo"]["key"] = $title;
	$items[$helper_item_counter]["title"] = $title;

	if($description != "" && $description != null){
		$items[$helper_item_counter]["description"] = $description;
	}
	if($img_url != "" && $img_url != null){
		$items[$helper_item_counter]["image"]["url"] = $img_url;
	}
	if($img_text != "" && $img_text != null){
		$items[$helper_item_counter]["image"]["accessibility_text"] = $img_text;
	}
	$helper_item_counter++;
}
