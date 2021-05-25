<script>
document.addEventListener("DOMContentLoaded", e => {

    const apiUrl = "<?= base_url() ?>data_tps?nomor_tps=10&limit=1&order=desc";
    const maxTegangan = 120;
    const reloadTime = 1000; //in ms
    draw()
    const intVal = window.setInterval(draw, reloadTime);

    function draw() {
        return fetch(apiUrl)
            .then(res => res.json())
            .then(resJson => resJson[0])
            .then(datum => datum.value)
            .then(draw => {
                google.charts.load('current', {
                    'packages': ['gauge']
                }).then(_ => {
                    var data = google.visualization.arrayToDataTable([
                        ['Label', 'Value'],
                        ['Surabaya', parseInt(draw)],
                    ]);
                    var options = {
                        redFrom: 0,
                        redTo: 20,
                        yellowFrom: 20,
                        yellowTo: 100,
                        minorTicks: 5,
                        max: maxTegangan,
                    };
                    var chart = new google.visualization.Gauge(document.getElementById('gauge1'));
                    return chart.draw(data, options);
                });
            })
            .catch(err => console.log("Library Google Chart tidak dapat diinisialisasi"))
    }
})

document.addEventListener("DOMContentLoaded", e => {

    const apiUrl = "<?= base_url() ?>data_tps?nomor_tps=20&limit=1&order=desc";
    const maxTegangan = 120;
    const reloadTime = 1000; //in ms
    draw()
    const intVal = window.setInterval(draw, reloadTime);

    function draw() {
        return fetch(apiUrl)
            .then(res => res.json())
            .then(resJson => resJson[0])
            .then(datum => datum.value)
            .then(draw => {
                google.charts.load('current', {
                    'packages': ['gauge']
                }).then(_ => {
                    var data = google.visualization.arrayToDataTable([
                        ['Label', 'Value'],
                        ['Malang', parseInt(draw)],
                    ]);
                    var options = {
                        redFrom: 0,
                        redTo: 20,
                        yellowFrom: 20,
                        yellowTo: 100,
                        minorTicks: 5,
                        max: maxTegangan,
                    };
                    var chart = new google.visualization.Gauge(document.getElementById('gauge2'));
                    return chart.draw(data, options);
                });
            })
            .catch(err => console.log("Library Google Chart tidak dapat diinisialisasi"))
    }
})

document.addEventListener("DOMContentLoaded", e => {

    const apiUrl = "<?= base_url() ?>data_tps?nomor_tps=30&limit=1&order=desc";
    const maxTegangan = 120;
    const reloadTime = 1000; //in ms
    draw()
    const intVal = window.setInterval(draw, reloadTime);

    function draw() {
        return fetch(apiUrl)
            .then(res => res.json())
            .then(resJson => resJson[0])
            .then(datum => datum.value)
            .then(draw => {
                google.charts.load('current', {
                    'packages': ['gauge']
                }).then(_ => {
                    var data = google.visualization.arrayToDataTable([
                        ['Label', 'Value'],
                        ['Sidoarjo', parseInt(draw)],
                    ]);
                    var options = {
                        redFrom: 0,
                        redTo: 20,
                        yellowFrom: 20,
                        yellowTo: 100,
                        minorTicks: 5,
                        max: maxTegangan,
                    };
                    var chart = new google.visualization.Gauge(document.getElementById('gauge3'));
                    return chart.draw(data, options);
                });
            })
            .catch(err => console.log("Library Google Chart tidak dapat diinisialisasi"))
    }
})
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-primary">Smart Trash Meter</h1>


                    <h3 class="m-0 text-secondary">Indikator</h3>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row">


                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <!-- <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i
                                class="fas fa-thermometer-quarter"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Suhu</span>
                            <span class="info-box-number">
                                <div id="line_suhu"></div>
                            </span>
                        </div>

                    </div>
                </div> -->
                <div class="card card-primary card-outline col-lg-4">
                    <div id="gauge1"></div>
                </div>
                <div class="card card-primary card-outline col-lg-4">
                    <div id="gauge2"></div>
                </div>
                <div class="card card-primary card-outline col-lg-4">
                    <div id="gauge3"></div>
                </div>

            </div>
            <!-- /.content-wrapper -->
    </section>



    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-secondary">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->