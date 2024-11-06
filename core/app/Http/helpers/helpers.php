<?php

use App\General;
use App\User;
use App\Transaction;
use App\Income;
use Carbon\Carbon;

function send_email($to, $subject, $name, $message){
        $general = General::first();
    if ($general->email_nfy == 1){
        $headers = "From: ".$general->web_title." <".$general->esender."> \r\n";
        $headers .= "Reply-To: ".$general->web_title." <".$general->esender."> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $template = $general->emessage;
        $mm = str_replace("{{name}}",$name,$template);
        $message = str_replace("{{message}}",$message,$mm);
         mail($to, $subject, $message, $headers);
        }else {
        return;
    }
}

function send_sms( $to, $message){
    $gnl = General::first();
    if($gnl->sms_nfy == 1) {
        $sendtext = urlencode("$message");
        $appi = $gnl->smsapi;
        $appi = str_replace("{{number}}",$to,$appi);
        $appi = str_replace("{{message}}",$sendtext,$appi);
        $result = file_get_contents($appi);
      }
      return;
}

function bal ($id){

    $uu = User::findOrFail($id);
    $ref_ids = User::where('referrer_id', $id)->where('paid_status', 1)->where('level',$uu->level)->get();
    if($ref_ids->count()!=0) {
    foreach ($ref_ids as $us) {
        $chal[] = $us->id;
    }
    return $chal;
            }

}

function getParentId($id){

    $count = User::whereId($id)->count() ;
    $posid = User::whereId($id)->first();
    if ($count == 1){
        return $posid->referrer_id;
    }else{
        return 0;
    }
}

function isMemberExists($id){
    $count = User::where('id', $id)->count();
    if ($count == 1){
        return true;
    }else{
        return false;
    }
}

function Short_Text($data,$length){
    $first_part = explode(" ",$data);
    $main_part = strip_tags(implode(' ',array_splice($first_part,0, $length)));
    return $main_part ."...." ;
}

function ImageCheck($ext){
    if($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png' && $ext != 'bnp'){
        $ext = "";
    }
    return $ext;
}

function NewFile($name, $data){
    $fh = fopen($name, "w");
    fwrite($fh,$data);
    fclose($fh);
}

function ViewFile($name){
    $fh = fopen($name, "r");
    $data = fread($fh,filesize($name));
    fclose($fh);
    return $data;
}

function Find_fist_int($string){
    preg_match_all('!\d+!', $string, $matches);
    if($matches[0] != ""){
        foreach($matches[0] as $key => $value){
            $url = $value;
            return $url;
            break;
        }
    }
}

function Replace($data) {
    $data = str_replace("'", "", $data);
    $data = str_replace("!", "", $data);
    $data = str_replace("@", "", $data);
    $data = str_replace("#", "", $data);
    $data = str_replace("$", "", $data);
    $data = str_replace("%", "", $data);
    $data = str_replace("^", "", $data);
    $data = str_replace("&", "", $data);
    $data = str_replace("*", "", $data);
    $data = str_replace("(", "", $data);
    $data = str_replace(")", "", $data);
    $data = str_replace("+", "", $data);
    $data = str_replace("=", "", $data);
    $data = str_replace(",", "", $data);
    $data = str_replace(":", "", $data);
    $data = str_replace(";", "", $data);
    $data = str_replace("|", "", $data);
    $data = str_replace("'", "", $data);
    $data = str_replace('"', "", $data);
    $data = str_replace("?", "", $data);
    $data = str_replace("  ", "_", $data);
    $data = str_replace("'", "", $data);
    $data = str_replace(".", "-", $data);
    $data = strtolower(str_replace("  ", "-", $data));
    $data = strtolower(str_replace(" ", "-", $data));
    $data = strtolower(str_replace(" ", "-", $data));
    $data = strtolower(str_replace("__", "-", $data));
    return str_replace("_", "-", $data);
}
