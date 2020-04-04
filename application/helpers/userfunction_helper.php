<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function pr($a) {
    echo '<pre>';
    print_r($a);
}

function allowed_month(){
    $month = array(01,04,07,10);
}

function months(){
   return $m = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
}


/**
 * upload_file
 * Upload file on particular location.
 * @access	public
 * @param       $name=name of file, $path=location where to save file
 * @return      saved file name .
 */
function upload_file($name, $path) {
    $CI = & get_instance();
    //$config['upload_path'] = './uploads/';
    $config['encrypt_name'] = TRUE;
    $config['upload_path'] = $path;
    $config['allowed_types'] = '*';
    $config['max_size'] = '0';
    $config['max_width'] = '0';
    $config['max_height'] = '0';
    $CI->load->library('upload', $config);
    $CI->upload->do_upload($name);
    $data = array('upload_data' => $CI->upload->data());
    // echo "<pre>";print_r($data);echo "</pre>"; exit;
    // $error = array('error' => $CI->upload->display_errors());
    //echo "<pre>";print_r($error);echo "</pre>";

    return $data['upload_data']['file_name'];
}

function create_thumbnail_file($path, $newpath, $height = '0', $width = '0', $new_image = '') {
    $CI = & get_instance();
    $config['image_library'] = 'gd2';
    $config['source_image'] = $path;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['width'] = $width;
    $config['height'] = $height;
    $config['quality'] = 100;
    $config['new_image'] = $newpath;

    $CI->load->library('image_lib', $config);
    $CI->image_lib->initialize($config);

    if (!$CI->image_lib->resize()) {
        echo $CI->image_lib->display_errors();
        exit;
    }

    $CI->image_lib->clear();
}

function sendInfo($url, $data) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_PORT, 443);
    //curl_setopt($ch, CURLOPT_SSLVERSION,3);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $returnData = curl_exec($ch);

    curl_close($ch);
    return $returnData;
}
/* takes the input, scrubs bad characters */
function generate_seo_link($input, $replace = '-', $remove_words = true, $words_array = array()) {
    //make it lowercase, remove punctuation, remove multiple/leading/ending spaces
    $return = trim(str_replace(' +', ' ', preg_replace('/[^a-zA-Z0-9\s]/', '', strtolower($input))));

    //remove words, if not helpful to seo
    //i like my defaults list in remove_words(), so I wont pass that array
    if($remove_words) { $return = remove_words($return, $replace, $words_array); }

    //convert the spaces to whatever the user wants
    //usually a dash or underscore..
    //...then return the value.
    return str_replace(' ', $replace, $return);
}

/* takes an input, scrubs unnecessary words */
function remove_words($input,$replace,$words_array = array(),$unique_words = true)
{
    //separate all words based on spaces
    $input_array = explode(' ',$input);

    //create the return array
    $return = array();

    //loops through words, remove bad words, keep good ones
    foreach($input_array as $word)
    {
        //if it's a word we should add...
        if(!in_array($word,$words_array) && ($unique_words ? !in_array($word,$return) : true))
        {
            $return[] = $word;
        }
    }

    //return good words separated by dashes
    return implode($replace,$return);
}


