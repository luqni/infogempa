<?php

include 'helper/helper.php';

  $data = simplexml_load_file("https://data.bmkg.go.id/DataMKG/TEWS/autogempa.xml") or die("Gagal mengakses!");

  // $gempa [] = [
  //   'tanggal'   => (string)$data->gempa->Tanggal,
  //   'jam'       => (string)$data->gempa->Jam,
  //   'datetime'  => getDisplayDateTime((string)$data->gempa->DateTime),
  //   'magnitudo' => (string)$data->gempa->Magnitude,
  //   'kedalaman' => (string)$data->gempa->Kedalaman,
  //   'koordinat' => (string)$data->gempa->point->coordinates,
  //   'lintang'   => (string)$data->gempa->Lintang,
  //   'bujur'     => (string)$data->gempa->Bujur,
  //   'lokasi'    => (string)$data->gempa->Wilayah,
  //   'potensi'   => (string)$data->gempa->Potensi,
  //   'dirasakan' => (string)$data->gempa->Dirasakan,
  //   'shakemap'  => 'https://data.bmkg.go.id/DataMKG/TEWS/'.(string)$data->gempa->Shakemap,
  // ];

  // print_r(json_encode($gempa));

  echo "<div id='content'>";
  echo "<h5> Terjadi gempa pada hari <b>" .  getDisplayDateTime((string)$data->gempa->DateTime) . "</b></h5>";
  echo "<br><img style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' id='gambar' class='img-fluid' src=\"https://data.bmkg.go.id/DataMKG/TEWS/" . $data->gempa->Shakemap . "\" alt=\"Gempabumi Terbaru\">";
  echo "<h5><br> Magnitudo : <b>" . $data->gempa->Magnitude . "</b> dengan Kedalaman : <b>" . $data->gempa->Kedalaman . "</b></h5>";
  echo "<h5> Koordinat: <b>" . $data->gempa->point->coordinates . "</b></h5>";
  echo "<h5> Lintang: <b>" . $data->gempa->Lintang . "</b>, Bujur : <b>" . $data->gempa->Bujur ."</b></h5>";
  echo "<h5> Lokasi: <b>" . $data->gempa->Wilayah . "</b></h5>";
  echo "<h5> Potensi: <b>" . $data->gempa->Potensi . "</b></h5>";
  echo "<h5> Dirasakan: <b>" . $data->gempa->Dirasakan . "</b></h5>";
  echo "</div>";
?>