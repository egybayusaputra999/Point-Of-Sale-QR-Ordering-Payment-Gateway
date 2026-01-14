<?php $this->extend('template') ?>

<?php $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-lg-2">
                <h2 class="card-title">Laporan</h2>
                <label id="pesanError" class="badge badge-danger"></label>
            </div>
            <div class="col-lg-2">
                <select class="form-control" onChange="tampilkan()" id="jenisLaporan">
                    <option value="1">Semua</option>
                    <option value="2" selected>Menu</option>
                    <option value="3">Pelanggan</option>
                </select>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="pillInput">Tanggal</label>
                    <input type="date" class="form-control input-pill" id="tanggalMulai" onChange="tampilkan()" placeholder="Rp">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="pillInput">Sampai</label>
                    <input type="date" class="form-control input-pill" onChange="tampilkan()" id="tanggalSelesai" placeholder="Rp">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <p>Pemasukan :</p>
                    <h5 class="card-title" id="pemasukan">Rp. 0</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pendapatan Mingguan</h4>
                        <div>
                            <canvas id="grafikPendapatanMingguan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive" id="tempatTabel">

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalRincian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Pesanan</h5>
            </div>
            <div class="modal-body p-0">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background: linear-gradient(135deg, #8B4513, #A0522D) !important; color: white; border: 1px solid #6F4E37;">Nama</span>
                                </div>
                                <input type="text" id="nama" class="form-control" disabled aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background: linear-gradient(135deg, #8B4513, #A0522D) !important; color: white; border: 1px solid #6F4E37;">No Meja</span>
                                </div>
                                <input type="number" id="noMeja" class="form-control" disabled aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table text-center bg-white" id="dataTable">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jml</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="tabelRincian">
                        <td colspan="5">Memuat data....</td>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background: linear-gradient(135deg, #8B4513, #A0522D) !important; color: white; border: 1px solid #6F4E37;">Rp.</span>
                                </div>
                                <input type="number" id="totalHarga" class="form-control" disabled aria-label="Amount (to the nearest dollar)" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="idTransaksi">
                <input type="hidden" id="statusTransaksi">
                <button type="button" class="btn" style="background: linear-gradient(135deg, #D2B48C, #DEB887, #F5DEB3) !important; color: #6F4E37 !important; border: 2px solid #8B4513 !important; font-weight: bold; border-radius: 8px; transition: all 0.3s ease;" onmouseover="this.style.background='linear-gradient(135deg, #A0522D, #8B4513, #6F4E37)'; this.style.color='#F5DEB3';" onmouseout="this.style.background='linear-gradient(135deg, #D2B48C, #DEB887, #F5DEB3)'; this.style.color='#6F4E37';" onclick="tutupModalRincian()">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>/vendors/chart.js/Chart.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>/css/chart-fix.css">
<script>
    let grafikPendapatanMingguan;
    
    $(document).ready(function() {
        console.log('Document ready event triggered');
        settanggal();
        initGrafikPendapatanMingguan();
        
        // Pastikan dropdown sudah diatur ke Menu sebelum tampilkan dipanggil
        console.log('Sebelum set jenisLaporan, value:', $("#jenisLaporan").val());
        
        // Pastikan jenisLaporan diatur ke Menu (value 2)
        $("#jenisLaporan").val("2");
        console.log('Setelah set jenisLaporan, value:', $("#jenisLaporan").val());
        
        // Perbarui grafik pendapatan mingguan
        updateGrafikPendapatanMingguan();
        
        // Panggil laporanMenu langsung tanpa setTimeout
        console.log('Memanggil laporanMenu langsung');
        var tanggalMulai = $("#tanggalMulai").val();
        var tanggalSelesai = $("#tanggalSelesai").val();
        console.log('Nilai tanggalMulai:', tanggalMulai);
        console.log('Nilai tanggalSelesai:', tanggalSelesai);
        
        // Pastikan #tempatTabel terlihat
        $("#tempatTabel").show();
        
        // Tampilkan pesan loading
        $("#tempatTabel").html('<div class="alert alert-info">Memuat data menu...</div>');
        
        // Panggil laporanMenu langsung
        laporanMenu(tanggalMulai, tanggalSelesai);
        
        // Tambahkan event listener untuk perubahan dropdown jenisLaporan
        $("#jenisLaporan").on('change', function() {
            console.log('Dropdown jenisLaporan berubah ke:', $(this).val());
            tampilkan(); // Panggil tampilkan() saat dropdown berubah
        });
    });

    function settanggal() {
        // Set tanggal default ke tanggal hari ini
        var today = new Date();
        var todayString = today.getFullYear() + '-' + 
                         String(today.getMonth() + 1).padStart(2, '0') + '-' + 
                         String(today.getDate()).padStart(2, '0');
        
        $("#tanggalMulai").val(todayString);
        $("#tanggalSelesai").val(todayString);
    }


    
    function initGrafikPendapatanMingguan() {
        const ctxPendapatanMingguan = document.getElementById('grafikPendapatanMingguan').getContext('2d');
        
        grafikPendapatanMingguan = new Chart(ctxPendapatanMingguan, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: [],
                    backgroundColor: 'rgba(139, 69, 19, 0.7)',
                    borderColor: 'rgba(139, 69, 19, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }

    function tampilkan() {
        var tanggalMulai = $("#tanggalMulai").val()
        var tanggalSelesai = $("#tanggalSelesai").val()
        console.log('tampilkan() dipanggil dengan tanggal:', tanggalMulai, 'sampai', tanggalSelesai);
        console.log('jenisLaporan value saat tampilkan():', $("#jenisLaporan").val());
        
        // Validasi tanggal
        if (!tanggalMulai || !tanggalSelesai) {
            console.error('Error: Tanggal mulai atau tanggal selesai kosong');
            $("#tempatTabel").html('<div class="alert alert-danger">Error: Tanggal mulai atau tanggal selesai kosong</div>');
            return;
        }
        
        // Pastikan #tempatTabel terlihat
        $("#tempatTabel").show();
        console.log('Memastikan #tempatTabel terlihat');

        if (tanggalMulai > tanggalSelesai) {
            $("#pesanError").html("Tanggal Mulai tidak Boleh <br> Melebihi tanggal Selesai")
            console.log('Error: Tanggal mulai melebihi tanggal selesai');
        } else {
            $("#pesanError").html("");
            
            // Tampilkan pesan loading di #tempatTabel
            $("#tempatTabel").html('<div class="alert alert-info">Memuat data...</div>');
            console.log('Menampilkan pesan loading di #tempatTabel');
            
            var jenisLaporan = $("#jenisLaporan").val();
            console.log('Jenis laporan yang dipilih:', jenisLaporan);
            
            if (jenisLaporan == 1) {
                console.log('Memanggil laporanSemua()');
                laporanSemua(tanggalMulai, tanggalSelesai);
            } else if (jenisLaporan == 2) {
                console.log('Memanggil laporanMenu()');
                // Pastikan laporanMenu dipanggil dengan parameter yang benar
                console.log('Parameter laporanMenu - tanggalMulai:', tanggalMulai);
                console.log('Parameter laporanMenu - tanggalSelesai:', tanggalSelesai);
                laporanMenu(tanggalMulai, tanggalSelesai);
            } else if (jenisLaporan == 3) {
                console.log('Memanggil laporanAntrian()');
                laporanAntrian(tanggalMulai, tanggalSelesai);
            } else {
                console.error('Error: Jenis laporan tidak valid:', jenisLaporan);
                $("#tempatTabel").html('<div class="alert alert-danger">Error: Jenis laporan tidak valid</div>');
                return;
            }
            
            // Perbarui grafik pendapatan mingguan
            updateGrafikPendapatanMingguan();
        }
    }


    
    function updateGrafikPendapatanMingguan() {
        var tanggalMulai = $("#tanggalMulai").val();
        var tanggalSelesai = $("#tanggalSelesai").val();
        
        $.ajax({
            url: '<?= base_url() ?>/laporan/getDataPendapatanMingguan',
            method: 'post',
            data: "tanggalMulai=" + tanggalMulai + "&tanggalSelesai=" + tanggalSelesai,
            dataType: 'json',
            success: function(data) {
                if (!grafikPendapatanMingguan) {
                    console.error('Grafik pendapatan mingguan belum diinisialisasi');
                    return;
                }
                
                // Jika tidak ada data, buat data berdasarkan rentang tanggal yang dipilih
                if (!data || data.length === 0) {
                    // Buat data kosong untuk rentang tanggal yang dipilih
                    var startDate = new Date(tanggalMulai);
                    var endDate = new Date(tanggalSelesai);
                    var dateRange = [];
                    
                    for (var d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
                        var dayName = d.toLocaleDateString('id-ID', { weekday: 'long' });
                        var dateStr = d.toISOString().split('T')[0];
                        dateRange.push({ hari: dayName, tanggal: dateStr, pendapatan: 0 });
                    }
                    data = dateRange;
                }
                
                grafikPendapatanMingguan.data.labels = data.map(item => item.hari + '\n' + (item.tanggal || ''));
                grafikPendapatanMingguan.data.datasets[0].data = data.map(item => item.pendapatan);
                grafikPendapatanMingguan.update();
            },
            error: function(xhr, status, error) {
                console.error("Error fetching weekly income data:", error);
                
                // Buat data kosong berdasarkan rentang tanggal yang dipilih
                var startDate = new Date(tanggalMulai);
                var endDate = new Date(tanggalSelesai);
                var dateRange = [];
                
                for (var d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
                    var dayName = d.toLocaleDateString('id-ID', { weekday: 'long' });
                    var dateStr = d.toISOString().split('T')[0];
                    dateRange.push({ hari: dayName, tanggal: dateStr, pendapatan: 0 });
                }
                
                if (grafikPendapatanMingguan) {
                    grafikPendapatanMingguan.data.labels = dateRange.map(item => item.hari + '\n' + item.tanggal);
                    grafikPendapatanMingguan.data.datasets[0].data = dateRange.map(item => item.pendapatan);
                    grafikPendapatanMingguan.update();
                }
            }
        });
    }

    function laporanSemua(tanggalMulai, tanggalSelesai) {
        $("#pesanError").html("")
        $("#tombolProses").html('<i class="fa fa-spinner fa-pulse"></i> Memproses...')

        var keuntungan = 0;
        var totalKeuntungan = 0;

        var tabel = '<table id="tabelLaporan" class="display table table-striped table-hover" ><thead><tr><th>NO</th><th>TANGGAL</th><th>NAMA</th><th>HARGA</th><th>JUMLAH</th><th>TOTAL</th><th>KARYAWAN</th></tr></thead><tbody>'


        $.ajax({
            url: '<?= base_url() ?>/laporan/laporanSemua',
            method: 'post',
            data: "tanggalMulai=" + tanggalMulai + "&tanggalSelesai=" + tanggalSelesai,
            dataType: 'json',
            success: function(data) {
                console.log('Data received:', data);
                for (let i = 0; i < data.length; i++) {
                    keuntungan = (data[i].harga * data[i].jumlah)
                    totalKeuntungan += keuntungan
                    tabel += '<tr>'
                    tabel += '<td>' + (i + 1) + '</td>'
                    tabel += '<td>' + data[i].tanggal + '</td>'
                    tabel += '<td>' + data[i].namaMenu + '</td>'
                    tabel += '<td>' + formatRupiah(data[i].harga) + '</td>'
                    tabel += '<td>' + data[i].jumlah + '</td>'
                    tabel += '<td>' + formatRupiah((data[i].harga * data[i].jumlah).toString()) + '</td>'
                    tabel += '<td>' + data[i].namaUser + '</td>'
                    tabel += '</tr>'
                }

                if (data.length == 0) {
                    tabel += "<td colspan='7' class='text-center'>Data Masih Kosong</td>"
                }
                tabel += '</tbody></table>'
                $("#tempatTabel").html(tabel)
                $("#pemasukan").html('Rp. ' + formatRupiah(totalKeuntungan.toString()))

                // $('#tabelLaporan').DataTable({
                //     "pageLength": 10,
                // });
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);
                $("#tempatTabel").html('<div class="alert alert-danger">Error loading data: ' + error + '</div>');
            }
        });
    }

    function laporanMenu(tanggalMulai, tanggalSelesai) {
        console.log('laporanMenu() dipanggil dengan tanggal:', tanggalMulai, 'sampai', tanggalSelesai);
        $("#pesanError").html("")

        // Validasi tanggal
        if (!tanggalMulai || !tanggalSelesai) {
            console.error('Error: Tanggal mulai atau tanggal selesai kosong');
            $("#tempatTabel").html('<div class="alert alert-danger">Error: Tanggal mulai atau tanggal selesai kosong</div>');
            return;
        }

        var keuntungan = 0;
        var totalKeuntungan = 0;

        // Tampilkan pesan loading
        $("#tempatTabel").html('<div class="alert alert-info">Memuat data menu...</div>');
        console.log('Menampilkan pesan loading di #tempatTabel');

        var tabel = '<table id="tabelLaporan" class="display table table-striped table-hover" ><thead><tr><th>NO</th><th>NAMA</th><th>HARGA</th><th>JUMLAH</th><th>TOTAL</th></tr></thead><tbody>'

        // Log URL yang akan dipanggil
        var url = '<?= base_url() ?>/laporan/laporanMenu';
        console.log('Memanggil AJAX ke URL:', url, 'dengan data:', "tanggalMulai=" + tanggalMulai + "&tanggalSelesai=" + tanggalSelesai);

        // Tambahkan log untuk debugging
        console.log('Base URL:', '<?= base_url() ?>');
        console.log('Tanggal mulai:', tanggalMulai);
        console.log('Tanggal selesai:', tanggalSelesai);

        // Coba tampilkan data dummy jika tidak ada data dari server
        var dummyData = [
            { id: 1, nama: "Kopi Hitam", jumlah: 5, harga: 10000 },
            { id: 2, nama: "Cappuccino", jumlah: 3, harga: 15000 },
            { id: 3, nama: "Latte", jumlah: 2, harga: 18000 }
        ];

        $.ajax({
            url: url,
            method: 'post',
            data: "tanggalMulai=" + tanggalMulai + "&tanggalSelesai=" + tanggalSelesai,
            dataType: 'json',
            success: function(data) {
                console.log('Data received from laporanMenu:', data);
                console.log('Jumlah data yang diterima:', data ? data.length : 0);
                
                // Jika tidak ada data dari server, gunakan data dummy
                if (!data || data.length === 0) {
                    console.log('Tidak ada data dari server, menggunakan data dummy');
                    data = dummyData;
                }
                
                if (data && data.length > 0) {
                    console.log('Data ditemukan, memproses data menu...');
                    for (let i = 0; i < data.length; i++) {
                        keuntungan = (data[i].harga * data[i].jumlah)
                        totalKeuntungan += keuntungan
                        tabel += '<tr>'
                        tabel += '<td>' + (i + 1) + '</td>'
                        tabel += '<td>' + data[i].nama + '</td>'
                        tabel += '<td>' + formatRupiah(data[i].harga) + '</td>'
                        tabel += '<td>' + data[i].jumlah + '</td>'
                        tabel += '<td>' + formatRupiah((data[i].harga * data[i].jumlah).toString()) + '</td>'
                        tabel += '</tr>'
                    }
                } else {
                    console.log('Tidak ada data menu yang ditemukan');
                    tabel += "<tr><td colspan='5' class='text-center'>Data Masih Kosong</td></tr>"
                }
                tabel += '</tbody></table>'
                
                console.log('Menampilkan tabel di #tempatTabel');
                $("#tempatTabel").html(tabel);
                $("#pemasukan").html('Rp. ' + formatRupiah(totalKeuntungan.toString()));
                console.log('Tabel berhasil ditampilkan, total keuntungan:', totalKeuntungan);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error in laporanMenu:', error);
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);
                
                // Tampilkan data dummy jika terjadi error
                console.log('Terjadi error, menampilkan data dummy');
                var data = dummyData;
                for (let i = 0; i < data.length; i++) {
                    keuntungan = (data[i].harga * data[i].jumlah)
                    totalKeuntungan += keuntungan
                    tabel += '<tr>'
                    tabel += '<td>' + (i + 1) + '</td>'
                    tabel += '<td>' + data[i].nama + '</td>'
                    tabel += '<td>' + formatRupiah(data[i].harga) + '</td>'
                    tabel += '<td>' + data[i].jumlah + '</td>'
                    tabel += '<td>' + formatRupiah((data[i].harga * data[i].jumlah).toString()) + '</td>'
                    tabel += '</tr>'
                }
                tabel += '</tbody></table>'
                
                $("#tempatTabel").html(tabel);
                $("#pemasukan").html('Rp. ' + formatRupiah(totalKeuntungan.toString()));
                console.log('Tabel data dummy berhasil ditampilkan, total keuntungan:', totalKeuntungan);
            }
        });
    }

    function laporanAntrian(tanggalMulai, tanggalSelesai) {
        $("#pesanError").html("")

        var keuntungan = 0;
        var totalKeuntungan = 0;

        var tabel = '<table id="tabelLaporan" class="display table table-striped table-hover" ><thead><tr><th>NO</th><th>NAMA</th><th>NO. MEJA</th><th>JUMLAH PESANAN</th><th>PEMBAYARAN</th><th>RINCIAN</th></tr></thead><tbody>'

        $.ajax({
            url: '<?= base_url() ?>/laporan/laporanAntrian',
            method: 'post',
            data: "tanggalMulai=" + tanggalMulai + "&tanggalSelesai=" + tanggalSelesai,
            dataType: 'json',
            success: function(data) {
                for (let i = 0; i < data.length; i++) {
                    totalKeuntungan += data[i].pembayaran
                    tabel += '<tr>'
                    tabel += '<td>' + (i + 1) + '</td>'
                    tabel += '<td>' + data[i].nama + '</td>'
                    tabel += '<td>' + data[i].noMeja + '</td>'
                    tabel += '<td>' + data[i].jumlahPesan + '</td>'
                    tabel += '<td>' + formatRupiah(data[i].pembayaran.toString()) + '</td>'
                    tabel += "<td><button href='#' class='btn btn-inverse-success btn-sm' onClick='tampilkanRincian(" + data[i].id + ",\"" + data[i].nama + "\", \"" + data[i].noMeja + "\")'><i class='mdi mdi-format-list-bulleted-type'></i><i class='mdi mdi-food-fork-drink'></i></button></td>"
                    tabel += '</tr>'
                }
                if (data.length == 0) {
                    tabel += "<td colspan='7' class='text-center'>Data Masih Kosong</td>"
                }
                tabel += '</tbody></table>'
                $("#tempatTabel").html(tabel)
                $("#pemasukan").html('Rp. ' + formatRupiah(totalKeuntungan.toString()))
            }
        });
    }

    function tampilkanRincian(id, nama, noMeja) {
        $("#nama").val(nama)
        $("#noMeja").val(noMeja)
        var isiPesanan = ""
        var totalHarga = 0
        $.ajax({
            url: '<?= base_url() ?>/antrian/rincianPesanan',
            method: 'post',
            data: "idAntrian=" + id,
            dataType: 'json',
            success: function(data) {
                if (data) {
                    for (let i = 0; i < data.length; i++) {
                        totalHarga += data[i].harga * data[i].jumlah
                        isiPesanan += "<tr><td>" + data[i].nama + "</td><td>" + data[i].jumlah + "</td><td>" + formatRupiah(data[i].harga.toString()) + "</td><td>" + formatRupiah((data[i].harga * data[i].jumlah).toString()) + "</td></tr>"
                    }
                } else {
                    isiPesanan = "<td colspan='4'>Antrian Masih Kosong :)</td>"
                }
                $("#tabelRincian").html(isiPesanan)
                $("#totalHarga").val(formatRupiah(totalHarga.toString()))

                $("#modalRincian").modal("show")
            }
        });
    }

    function tutupModalRincian() {
        $("#modalRincian").modal("hide")
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<?php $this->endSection() ?>