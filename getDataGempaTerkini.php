<?php

include 'helper/helper.php';

  $data = simplexml_load_file("https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.xml") or die("Gagal mengakses!");
  
  // print_r(json_encode($data));
foreach($data as $value){
  
  if($value){
    $gempaTerkinis[] = [
      'tanggal'   => (string)$value->Tanggal,
      'jam'       => (string)$value->Jam,
      'datetime'  =>  getDisplayDateTime((string)$value->DateTime),
      'magnitudo' => (string)$value->Magnitude,
      'kedalaman' => (string)$value->Kedalaman,
      'wilayah'   => (string)$value->Wilayah,
      'potensi'   => (string)$value->Potensi,
    ];
  }
  
}

return $gempaTerkinis;

  // echo "<div id='content'>";
  // echo "<h4> Terjadi gempa pada hari <b>" .  getDisplayDateTime((string)$data->gempa->DateTime) . "</b></h4>";
  // echo "<h4> Magnitudo : <b>" . $data->gempa->Magnitude . "</b> dengan Kedalaman : <b>" . $data->gempa->Kedalaman . "</b></h4>";
  // echo "<h4> Koordinat: <b>" . $data->gempa->point->coordinates . "</b></h4>";
  // echo "<h4> Lintang: <b>" . $data->gempa->Lintang . "</b>, Bujur : <b>" . $data->gempa->Bujur ."</h4>";
  // echo "<h4> Lokasi: " . $data->gempa->Wilayah . "</h4>";
  // echo "<h4> Potensi: " . $data->gempa->Potensi . "</h4>";
  // echo "<h4> Dirasakan: " . $data->gempa->Dirasakan . "</h4>";
  // echo "<br><img style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' id='gambar' class='img-fluid' src=\"https://data.bmkg.go.id/DataMKG/TEWS/" . $data->gempa->Shakemap . "\" alt=\"Gempabumi Terbaru\">";
  // echo "</div>";
?>