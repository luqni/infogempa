<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Info Gempa</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="assets/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
	    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css"> -->
    </head>
    <style>
        /* CSS Kedip | Teks | Objek 
        (Chrome, Safari, Firefox, IE, ...)
        */

        @-webkit-keyframes blinker {
        from {opacity: 1.0;}
        to {opacity: 0.0;}
        }
        .blink{
            text-decoration: blink;
            -webkit-animation-name: blinker;
            -webkit-animation-duration: 1s;
            -webkit-animation-iteration-count:infinite;
            -webkit-animation-timing-function:ease-in-out;
            -webkit-animation-direction: alternate;
        }

        /* css ini di buat oleh caksup */
    </style>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);position: fixed;width:100%">
            <div class="container px-lg-5">
                <a class="navbar-brand" href="index.php">Info Gempa Bumi</a>
                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button> -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <!-- <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li> -->
                        <!-- <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li> -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="py-5">
            <div class="container px-lg-5">
                <p style="margin-top:20px;"><b> *Data diambil dari website resmi BMKG </b></p>
                <div class="p-4 p-lg-5 bg-light rounded-3 text-center" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    <div class="m-4 m-lg-5">
                    <h2 class="display-5 fw-bold blink">Informasi Gempa Bumi Terbaru!</h2>
                    </div>
                </div>
                <br/>
                <div class="p-4 p-lg-5 bg-light rounded-3 text-center" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    <div class="m-4 m-lg-5">
                        <hr/>
                        <div id="p1"><div>
                    </div>
                </div>
                <br/>
                <p>Klik dibawah ini untuk memperbaharui data</p><a onclick="dataGempaAuto()" class="btn btn-warning btn-lg"><i class="bi bi-arrow-repeat"></i></a>
                
            </div>
        </header>
        <!-- Page Content-->
        <section class="pt-4">
            <div class="container px-lg-5">
                <!-- Page Features-->
                    <?php 
                    include 'getDataGempaTerkini.php'; 
                    include 'getDataGempaDirasakan.php'; 
                    // print_r($gempaDirasakans);die();
                    ?>
                    <div class="p-4 p-lg-5 bg-light rounded-3 text-center" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <h2 class="fs-4 fw-bold">Daftar 15 Gempa Bumi M 5.0+</h2>
                        <div class="table-responsive"> 
                            <table id="example"  class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr class="btn-primary">
                                        <th>No</th>
                                        <th>Waktu Gempa (UTC)</th>
                                        <th>Magnitudo</th>
                                        <th>Kedalaman (Km)</th>
                                        <th>Wilayah</th>
                                        <th>Potensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1;
                                        foreach ($gempaTerkinis as $value) // fetch all data from the database
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value['datetime']; ?></td>
                                        <td><?php echo $value['magnitudo']; ?></td>
                                        <td><?php echo $value['kedalaman']; ?></td>
                                        <td><?php echo $value['wilayah']; ?></td>
                                        <td><?php echo $value['potensi']; ?></td>
                                    </tr>
                                    <?php 
                                        $i++;
                                        }
                                    ?>
                                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                       
                    <div class="p-4 p-lg-5 bg-light rounded-3 text-center" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <h2 class="fs-4 fw-bold">Daftar 15 Gempa Bumi Dirasakan</h2>
                        <div class="table-responsive"> 
                            <table id="example2"  class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr class="btn-primary">
                                        <th>No</th>
                                        <th>Waktu Gempa (UTC)</th>
                                        <th>Magnitudo</th>
                                        <th>Kedalaman (Km)</th>
                                        <th>Wilayah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1;
                                        foreach ($gempaDirasakans as $value) // fetch all data from the database
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value['datetime']; ?></td>
                                        <td><?php echo $value['magnitudo']; ?></td>
                                        <td><?php echo $value['kedalaman']; ?></td>
                                        <td><?php echo $value['wilayah']; ?></td>
                                    </tr>
                                    <?php 
                                        $i++;
                                        }
                                    ?>
                                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                   
                <!-- </div> -->
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Developed by M Luqni Baehaqi &copy; 2023 - 2026</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="assets/js/scripts.js"></script>
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
   <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" charset="utf-8"></script>

<script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable({searching: false,"lengthChange": false,"pageLength": 5});
    $('#example2').DataTable({searching: false,"lengthChange": false,"pageLength": 5});
    
});

$(document).ready(function(){
    var loading = '<div class="spinner-border" role="status"><span class="sr-only"></span></div>';
    document.getElementById("p1").innerHTML = loading;
    dataGempaAuto();
    dataGempaTerkini();
    setTimeout(dataGempaAuto,120000);
});

function dataGempaAuto() {
    var loading = '<div class="spinner-border" role="status"><span class="sr-only"></span></div>';
    document.getElementById("p1").innerHTML = loading;
    $.ajax({
    url: "getDataGempaAuto.php",
    
    success: function(html){
        if(html){
            document.getElementById("p1").innerHTML = html;
        }
    }
    });
}

function dataGempaTerkini() {

    $.ajax({
    url: "getDataGempaTerkini.php",
    dataType: 'json',
    success: function(html){
        console.log(html);
        if(html){
            // document.getElementById("p1").innerHTML = html;
        }
    }
    });
}

</script>
