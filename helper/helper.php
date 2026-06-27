<?php 

function getNameMonth() {
    
    return array(
        1   => 'Januari',
        2   => 'Februari',
        3   => 'Maret',
        4   => 'April',
        5   => 'Mei',
        6   => 'Juni',
        7   => 'Juli',
        8   => 'Agustus',
        9   => 'September',
        10  => 'Oktober',
        11  => 'November',
        12  => 'Desember',
    );
}

function getNameDay() {
    return array(
        "Sunday"    => "Minggu",
        "Monday"    => "Senin",
        "Tuesday"   => "Selasa",
        "Wednesday" => "Rabu",
        "Thursday"  => "Kamis",
        "Friday"    => "Jum'at",
        "Saturday"  => "Sabtu",
    );
}

function getDisplayDateTime($dateTime) {
     
    
    if ($dateTime == NULL || $dateTime == 'NULL') {
        return '';
    }
    
    $nameMonth = getNameMonth();
    $nameDay = getNameDay();
    
    $tmp = date('l-d-m-Y-H:i', strtotime($dateTime));

    

    $expDate = explode('-', $tmp);

    $expDate[0] = !empty($expDate[0]) ? $expDate[0] : '-';
    $expDate[1] = !empty($expDate[1]) ? $expDate[1] : '-';
    $expDate[2] = !empty($expDate[2]) ? $expDate[2] : '-';

    $expTime[0] = !empty($expTime[0]) ? $expTime[0] : '-';
    $expTime[1] = !empty($expTime[1]) ? $expTime[1] : '-';

    
    $date = $nameDay[$expDate[0]] .', '. $expDate[1] . ' '. $nameMonth[(int)$expDate[2]] . ' '. $expDate[3] .' '. $expDate[4] .' WIB';
    
 
     return $date;
 
  }

?>