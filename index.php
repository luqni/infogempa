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
        <link rel="manifest" href="manifest.json">
        <meta name="theme-color" content="#212529">
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
    <body style="padding-top: 56px;">
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); z-index: 1030;">
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

        <div class="sticky-top" style="top: 56px; z-index: 1020;" id="notif-banner-wrapper">
            <div class="alert alert-info shadow-sm mb-0 rounded-0 border-0 d-none flex-column flex-md-row align-items-center justify-content-between gap-3 text-center text-md-start" role="alert" id="notif-banner">
                <div id="notif-text">
                    <i class="bi bi-bell-fill me-2"></i> Aktifkan notifikasi untuk menerima peringatan instan saat terjadi gempa bumi.
                </div>
                <button id="notif-btn" onclick="enableNotif()" class="btn btn-primary btn-sm text-nowrap"><i class="bi bi-bell-fill"></i> Aktifkan Notifikasi</button>
            </div>
        </div>

        <!-- Header-->
        <header class="py-4">
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
                <p>Klik dibawah ini untuk memperbaharui data</p>
                <a onclick="dataGempaAuto()" class="btn btn-warning btn-lg" title="Refresh Data"><i class="bi bi-arrow-repeat"></i></a>
                
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
            
            const content = document.getElementById('content');
            if(content) {
                const waktu = content.getAttribute('data-waktu');
                const mag = content.getAttribute('data-mag');
                if(lastWaktuGempa !== null && lastWaktuGempa !== waktu) {
                    playAlarm();
                    if (Notification.permission === "granted") {
                        new Notification("Peringatan Gempa Baru!", {
                            body: `Gempa M${mag} terdeteksi! Waktu: ${waktu}`,
                            icon: "assets/icon-192.png"
                        });
                    }
                }
                lastWaktuGempa = waktu;
                updateDistanceUI();
            }
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

// Web Audio API beep
function playAlarm() {
    const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    const oscillator = audioCtx.createOscillator();
    const gainNode = audioCtx.createGain();
    
    oscillator.connect(gainNode);
    gainNode.connect(audioCtx.destination);
    
    oscillator.type = 'square';
    oscillator.frequency.setValueAtTime(440, audioCtx.currentTime);
    oscillator.frequency.setValueAtTime(880, audioCtx.currentTime + 0.5);
    
    gainNode.gain.setValueAtTime(1, audioCtx.currentTime);
    gainNode.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 1);
    
    oscillator.start(audioCtx.currentTime);
    oscillator.stop(audioCtx.currentTime + 1);
}

// Distance calculation
function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1); 
  var dLon = deg2rad(lon2-lon1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2); 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; 
  return d;
}

function deg2rad(deg) {
  return deg * (Math.PI/180)
}

let lastWaktuGempa = null;
let userLat = null;
let userLng = null;

function enableNotif() {
    if ("Notification" in window) {
        if (Notification.permission === "granted") {
            const content = document.getElementById('content');
            let notifBody = "Ini adalah notifikasi percobaan. Semuanya berfungsi dengan baik!";
            let notifTitle = "Test Peringatan Gempa!";
            
            if (content) {
                const waktu = content.getAttribute('data-waktu');
                const mag = content.getAttribute('data-mag');
                const wilayah = content.getAttribute('data-wilayah');
                if (waktu && mag && wilayah) {
                    notifTitle = `Peringatan Dini Gempa M${mag}`;
                    notifBody = `Telah terjadi gempa pada ${waktu} di wilayah ${wilayah}. (Sample Notifikasi)`;
                }
            }
            
            new Notification(notifTitle, {
                body: notifBody,
                icon: "assets/icon-192.png"
            });
        } else {
            Notification.requestPermission().then(function (permission) {
                if (permission === "granted") {
                    new Notification("Notifikasi Aktif!", {
                        body: "Push notif sudah diaktifkan. Anda akan menerima notif jika ada update informasi gempa.",
                        icon: "assets/icon-192.png"
                    });
                    const btn = document.getElementById('notif-btn');
                    if (btn) btn.innerHTML = '<i class="bi bi-bell"></i> Test Notif';
                } else {
                    alert("Izin notifikasi ditolak. Silakan izinkan melalui pengaturan browser (ikon gembok di sebelah URL).");
                }
            });
        }
    } else {
        alert("Browser Anda tidak mendukung fitur Notifikasi.");
    }
}

// Check notification permission on load to toggle banner visibility
window.addEventListener('DOMContentLoaded', () => {
    const banner = document.getElementById('notif-banner');
    if (!banner) return;
    
    if (window.isSecureContext === false || !("Notification" in window)) {
        // Not secure or not supported
        document.getElementById('notif-text').innerHTML = '<i class="bi bi-exclamation-triangle-fill text-danger me-2"></i> <span class="text-danger">Notifikasi diblokir browser karena koneksi tidak aman (Bukan HTTPS/Localhost).</span>';
        document.getElementById('notif-btn').style.display = 'none';
        banner.classList.remove('d-none');
        banner.classList.add('d-flex');
    } else if (Notification.permission === "default") {
        // Needs permission
        banner.classList.remove('d-none');
        banner.classList.add('d-flex');
    } else if (Notification.permission === "granted") {
        // Granted, keep banner but change button text
        document.getElementById('notif-btn').innerHTML = '<i class="bi bi-bell"></i> Test Notif';
        banner.classList.remove('d-none');
        banner.classList.add('d-flex');
    } else {
        // Denied
        document.getElementById('notif-text').innerHTML = '<i class="bi bi-x-circle-fill text-danger me-2"></i> <span class="text-danger">Anda menolak izin notifikasi. Silakan buka pengaturan browser jika ingin mengaktifkan peringatan gempa.</span>';
        document.getElementById('notif-btn').style.display = 'none';
        banner.classList.remove('d-none');
        banner.classList.add('d-flex');
    }
});

if (window.isSecureContext === false) {
    console.warn("Aplikasi diakses dari koneksi tidak aman (bukan HTTPS/localhost). Fitur Geolokasi mungkin diblokir oleh browser.");
}

if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(
        function(position) {
            userLat = position.coords.latitude;
            userLng = position.coords.longitude;
            updateDistanceUI();
        },
        function(error) {
            console.warn("Geolocation error: " + error.message);
        }
    );
}

function updateDistanceUI() {
    const content = document.getElementById('content');
    if(content && userLat && userLng) {
        const coordsStr = content.getAttribute('data-koordinat');
        if(coordsStr) {
            const parts = coordsStr.split(',');
            if(parts.length === 2) {
                const gempaLat = parseFloat(parts[0]);
                const gempaLng = parseFloat(parts[1]);
                const dist = getDistanceFromLatLonInKm(userLat, userLng, gempaLat, gempaLng);
                
                let distEl = document.getElementById('jarak-gempa');
                if(!distEl) {
                    distEl = document.createElement('h5');
                    distEl.id = 'jarak-gempa';
                    distEl.style.color = '#dc3545';
                    content.appendChild(distEl);
                }
                distEl.innerHTML = `Jarak dari lokasi Anda: <b>${dist.toFixed(2)} Km</b>`;
            }
        }
    }
}

// PWA Service Worker Registration
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('sw.js').then(registration => {
      console.log('SW registered: ', registration);
    }).catch(registrationError => {
      console.log('SW registration failed: ', registrationError);
    });
  });
}
</script>
