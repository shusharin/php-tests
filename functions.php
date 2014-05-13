<?php
/**
 * Сделайте выборку из массива $data значений, содержащих равное количество одинаковых символов в произвольном порядке.
 * $data = array(‘abc’,‘bac’,‘bbaa’,‘abab’,‘absc’,‘cab’,‘bb’,);
 * $result = array(
 * array(0 => ‘abc’, 1 => ‘bac’, 5 => ‘cab’),
 * array(2 => ‘bbaa’, 3 => ‘abab’),);
 */

/**
 * Find similar strings in array by count symbols
 * @param array $data - array strings
 * @return array
 * 
 * @todo error report
 * @date 14.05.2014
 * @author Valery Shusharin <shusharin_valery@mail.ru>
 * @example 
 * $data = array('abc', 'bac', 'bbaa', 'abab', 'absc', 'cab', 'bb',);
 * print_r(similar_by_count_symbols($data));
 */
function similar_by_count_symbols($data) {
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
    return $result;
}


/**
 * Написать пример рекурсивной функции, которая вычисляет факториал числа переданного ей в качестве параметра, например fac(4) должна вычислить факториал 4!
 * P.S. Факториал - это произведение всех натуральных чисел от 1 до n включительно.
 */

/**
 * Factorial
 * @param int $x
 * @return int
 */
function factorial($x) {
    if ($x === 0)
        return 1;
    else
        return $x * factorial($x - 1);
}