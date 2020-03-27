<?php
$url = "https://spreadsheets.google.com/feeds/list/0Ai2EnLApq68edEVRNU0xdW9QX1BqQXhHRl9sWDNfQXc/od6/public/basic?alt=json";
$json = file_get_contents($url);
$data = json_decode($json);
$array_of_cities = ['Damascus','Mogadishu','Ibiza','Cairo','Kathmandu','Nairobi','Tahrir','Madrid','Athens','Istanbul'];
function contains($needles, $haystack) {
    return (array_intersect($needles, explode(" ", preg_replace("/[^A-Za-z0-9' -]/", "", $haystack))));
}
$o = [];
foreach ($data->feed->entry as $sad){
    $this_Array = explode(',',$sad->content->{'$t'});
    $o[] =[
        'message_id'=>  str_replace('messageid:','',$this_Array[0]),
        'message'   =>  str_replace('message:','',$this_Array[1]),
        'city'      =>  implode(' ',contains($array_of_cities,$sad->content->{'$t'})),
        'sentiment'    => str_replace('sentiment:','',end($this_Array)),

    ];

}
echo "<pre>";
print_r($o);
echo "</pre>";
