<?php

$mstart = "Memory start: " . (memory_get_peak_usage(true) / 1024 / 1024) . " Mb\n";

ini_set("memory_limit", "3000M");

function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float) $usec + (float) $sec);
}

// init
$data = array();

for ($i = 0; $i < 1000; $i++)
    foreach (array('abc', 'bac', 'bbaa', 'abab', 'absc', 'cab', 'bb') as $val)
        $data[] = $val;

$result = array();
// end init

$time_start = microtime_float();

// work
// only arrays!
if (!is_array($data))
    return array(FALSE);
// define temp & results arrays
$tmp = array();
$result = array();
// counter needed for current element
$i = 0;
foreach ($data as $item) {
    // only strings!
    if (!is_string($item))
        return array(FALSE);
    // transform string to array & sort array
    $arr = str_split($item);
    asort($arr);
    // take count symbols in current array & transform array to string
    $arr_count = count($arr);
    $str = implode('', $arr);
    // checking for exist in temps array section by current counts symbols
    if (isset($tmp[$arr_count])) {
        // search this string in temp section
        $i_pre = array_search($str, $tmp[$arr_count]);
        // if search return key. Check this count section in result array & add el if not exist
        if ($i_pre !== FALSE) {
            if (!isset($result[$arr_count][$i_pre]))
                $result[$arr_count][] = $data[$i_pre];
            // add el in this count section in result array 
            $result[$arr_count][] = $data[$i];
        }
    }
    // add el in this count section in temp array  
    $tmp[$arr_count][$i] = $str;
    $i++;
}
// end work

$time_end = microtime_float();
$time = $time_end - $time_start;

// result 
//print_r($result);

echo "Count data: " . count($data) ."\n";
echo "Job time: $time sec.\n";
echo $mstart, "Memory end  : " . (memory_get_peak_usage(true) / 1024 / 1024) . "Mb \n";
