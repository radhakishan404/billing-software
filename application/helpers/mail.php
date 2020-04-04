<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('send_mail'))
{
    function send_mail($to_email, $subject, $body, $cc = '', $bcc = '', $from_email = "example@e.com",$attched_file='') {

    $config = Array(
        'protocol' => 'mail',
        'smtp_host' => 'sg3plcpnl0065.prod.sin3.secureserver.net',
        'smtp_port' => 465,
        'smtp_user' => 'example@e.com',
        'smtp_pass' => 'wifi786zone',
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => TRUE,
        'crlf' => "\r\n",
        'newline' => "\r\n"
    );
    


    $CI = & get_instance();
    $CI->load->library('parser');
    $CI->load->library('email', $config);
    $CI->email->set_newline("\r\n");

    $CI->email->from($from_email, 'example@e.com');
    $CI->email->to($to_email);

    if($attched_file!=''){
        $CI->email->attach($attched_file);
    }
    
    if ($cc != '') {
        $CI->email->cc($cc);
    }

    if ($bcc != '') {
        $CI->email->bcc($bcc);
    }

    $CI->email->subject($subject);
    $CI->email->message($body);

    if ($CI->email->send()) {
        //echo $CI->email->print_debugger(); exit;
        return 1;
    } else {
        echo $CI->email->print_debugger(); exit;

        return 2;
    }
}

?>