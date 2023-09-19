
<?php

function isValidEmail($email)
{
    $re = '/([\w\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)/m';
    preg_match_all($re, $email, $matches, PREG_SET_ORDER, 0);
    if(count($matches) > 0) return $matches[0][0] === $email;
    return false;
}

function isValidPhone($phone){
    if(preg_match('/^[0-9]{10}+$/', $phone)) {
     return true;
    } else {
     return false;
    }
}

function umur ($noic) {
    //$no_ic = 800211085631; //CONTOH NO IC   871118077020

    if (is_numeric($noic)){

        $no_ic = $noic;

        $tmp_hari = substr($no_ic,4,2);
        $tmp_bulan = substr($no_ic,2,2);
        $tmp_tahun = substr($no_ic,0,2);
        $tmp_negeri = substr($no_ic,6,2);
        $tmp_jantina = substr($no_ic,11,1);


        //TARIKH LAHIR//////////////////////////////////////
        if($tmp_hari == 00 && $tmp_tahun == 00) {
            $tmp_tahun = 0000;
        } else {

            if($tmp_tahun >= 00 && $tmp_tahun <= 25) {
                $tmp_tahun = 2000+$tmp_tahun;
            }

            if($tmp_tahun >= 26 && $tmp_tahun <= 99) {
                $tmp_tahun = 1900+$tmp_tahun;
            }
        }

        $tarikh_lahir = $tmp_hari."/".$tmp_bulan."/".$tmp_tahun;

        //UMUR//////////////////////////////////////
         if($tmp_tahun == 0) {
            $umur = 0;
         } else {
            if (($tmp_hari > 31) && ($tmp_bulan >= 12) && ($tmp_tahun >= 99)) {
                $umur = 0;
            } else {
                $tmp_tarikh_lahir = $tmp_tahun."-".$tmp_bulan."-".$tmp_hari;
                $umur = date_create($tmp_tarikh_lahir)->diff(date_create('today'))->y;
            } 
        }  
    } else {
        $umur = 0;
    }

    return $umur;
    //return $tmp_tahun;
}

function yuran ($pertalian, $umur) {
    $sql =& get_instance();
    $sql->db->select('yf_jumlah, yf_agelimit');
    $sql->db->where('yf_name', $pertalian); 
    $result = $sql->db->get('tbl_kadar_yuran_family')->row();   
    $hadumur = $result->yf_agelimit; 

    if($pertalian == "ANAK"){
        if($umur > $hadumur) {
          $yuran = $result->yf_jumlah; //selain anak lebih had umur                       
        } else {
          $yuran = 0;
        }
    } else {
        $yuran = $result->yf_jumlah; 
    }

    return number_format($yuran,2);
}

function total_yuran_in_year ($month,$yuran) {

    //$month_left = 13 - $month;
    $month_left = 12; //lumpsum setahun
    $total_amount = $yuran * $month_left;

    return number_format($total_amount,2);
}

function total_renew_yuran_in_year ($yuran) {

    $month_left = 12;
    $total_amount = $yuran * $month_left;

    return number_format($total_amount,2);
}

function yuran_pendaftaran () {
    $kadarid = 1;
    $sql =& get_instance();
    $sql->db->select('y_jumlah');
    $sql->db->where('yid', $kadarid); //administrator
    $result = $sql->db->get('tbl_kadar_yuran')->row();  
    $registration_fee = $result->y_jumlah; 
    
    return number_format($registration_fee,2);
}

function yuran_tahunan_semasa () {
    $cur_year = date('Y');
    $sql =& get_instance();
    $sql->db->select('y_jumlah');
    $sql->db->where('y_tahun', $cur_year); 
    $result = $sql->db->get('tbl_kadar_yuran')->row();  
    $yearly_fee = $result->y_jumlah; 
    
    return number_format($yearly_fee,2);
}
?>