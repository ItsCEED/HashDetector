<?php 

$path = filter_input(INPUT_GET, 'path');

if(($path === '/') || ($path === '')){
    include_once 'main.html';
    die();
}

if($path === 'process'){
  //get data from ajax post request
  $tags = filter_input(INPUT_POST, 'tags');
  //$regex ="/#+[a-zA-Z0-9_z]/";
  $exploded = str_replace('#','',explode(' ',$tags));
  $url = "https://www.instagram.com/explore/tags/";
  $banned = [];

  for($i = 0; $i < count($exploded); $i++){
    //get the meta tags from url
    $tags = get_meta_tags($url.$exploded[$i]);

    //if the desscription meta tag contains 0 posts, it is a banned hashtag
    if(substr($tags['description'],0,7) === "0 Posts"){
      //if banned, remove from all tags array
      unset($exploded[$i]);

      //if banned, push into banned array
      array_push($banned,$exploded[$i]);
    }
  }
  //return array of healthy hashtags
  die("#".join(" #",$exploded)); 
}
