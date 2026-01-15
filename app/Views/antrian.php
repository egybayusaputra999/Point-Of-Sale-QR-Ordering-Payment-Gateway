<?php $this->extend('template') ?>

<?php $this->section('content') ?>

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Pelanggan</h4>
                <p class="card-description">
                    Meja yang memiliki pesanan belum dihidangkan.
                </p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Meja</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Ubah</th>
                            </tr>
                        </thead>
                        <tbody id="tabelAntrian">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Pelanggan Selesai</h4>
                <p class="card-description">
                    Pesanan pelanggan yang sudah dihidangkan hari ini.
                </p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Meja</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Rincian</th>
                            </tr>
                        </thead>
                        <tbody id="tabelAntrianSelesai">
                        </tbody>
                    </table>
                </div>
            </div>
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
                <button type="button" class="btn btn-secondary" onclick="tutupModalRincian()">Tutup</button>
                <button type="button" class="btn btn-info" onclick="cetakStruk()" style="margin-right: 10px;">Cetak Struk</button>
                <button type="button" class="btn" style="background: linear-gradient(135deg, #D2B48C, #DEB887, #F5DEB3) !important; color: #6F4E37 !important; border: 2px solid #8B4513 !important; font-weight: bold; border-radius: 8px; transition: all 0.3s ease;" onmouseover="this.style.background='linear-gradient(135deg, #A0522D, #8B4513, #6F4E37)'; this.style.color='#F5DEB3';" onmouseout="this.style.background='linear-gradient(135deg, #D2B48C, #DEB887, #F5DEB3)'; this.style.color='#6F4E37';" onclick="proses()" id="proses">Bayar</button>
            </div>
        </div>
    </div>
</div>


<script>
    tampilkanAntrian()
    tampilkanAntrianSelesai()

    function tampilkanAntrian() {
        var isiPesanan = ""
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>/antrian/dataAntrian',
            dataType: 'json',
            success: function(data) {
                if (data.length) {
                    for (let i = 0; i < data.length; i++) {
                        isiPesanan += "<tr><td>" + data[i].noMeja + "</td><td>" + data[i].nama + "</td><td>"

                        if (data[i].status == 0) {
                            isiPesanan += "<label class='badge badge-danger'>Bayar"
                        } else {
                            isiPesanan += "<label class='badge badge-success'>Memasak"
                        }

                        isiPesanan += "</label></td><td><button href='#' class='btn btn-inverse-warning btn-sm' onClick='modalRincian(" + data[i].id + ", \"" + data[i].nama + "\", " + data[i].noMeja + "," + data[i].status + ")'><i class='mdi mdi-format-list-bulleted-type'></i><i class='mdi mdi-food-fork-drink'></i></button></td></tr>"
                    }
                } else {
                    isiPesanan = "<td colspan='4'>Antrian Masih Kosong :)</td>"
                }
                $("#tabelAntrian").html(isiPesanan)
            }
        });
    }

    function tampilkanAntrianSelesai() {
        var isiPesanan = ""
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>/antrian/dataAntrianSelesai',
            dataType: 'json',
            success: function(data) {
                if (data.length) {
                    for (let i = 0; i < data.length; i++) {
                        isiPesanan += "<tr><td>" + data[i].noMeja + "</td><td>" + data[i].nama + "</td><td><label class='badge badge-success'>Selsai :)</label></td><td><button href='#' class='btn btn-inverse-success btn-sm' onClick='modalRincian(" + data[i].id + ", \"" + data[i].nama + "\", " + data[i].noMeja + "," + data[i].status + ")'><i class='mdi mdi-playlist-check'></i><i class='mdi mdi-food'></i></button></td></tr>"
                    }
                } else {
                    isiPesanan = "<td colspan='4' class='text-center'>Antrian Masih Kosong :)</td>"
                }
                $("#tabelAntrianSelesai").html(isiPesanan)
            }
        });
    }

    function modalRincian(id, nama, noMeja, status) {
        $("#nama").val(nama)
        $("#noMeja").val(noMeja)
        $("#proses").show()

        tampilkanRincian(id)
        if (status == 0) {
            $("#proses").html("Bayar")
        } else if (status == 1) {
            $("#proses").html("Selesai")
        } else {
            $("#proses").hide()
        }

        $("#idTransaksi").val(id)
        $("#statusTransaksi").val(status)

        $("#modalRincian").modal("show")
    }

    function proses() {
        var id = $("#idTransaksi").val()
        var status = $("#statusTransaksi").val()

        $.ajax({
            url: '<?= base_url() ?>/antrian/proses',
            method: 'post',
            data: "idTransaksi=" + id + "&statusTransaksi=" + status,
            dataType: 'json',
            success: function(data) {
                tampilkanAntrian()
                tampilkanAntrianSelesai()
                tutupModalRincian()
            }
        });
    }

    function tampilkanRincian(id) {
        var isiPesanan = ""
        var totalHarga = 0
        $.ajax({
            url: '<?= base_url() ?>/antrian/rincianPesanan',
            method: 'post',
            data: "idAntrian=" + id,
            dataType: 'json',
            success: function(data) {
                if (data.length) {
                    for (let i = 0; i < data.length; i++) {
                        totalHarga += data[i].harga * data[i].jumlah
                        isiPesanan += "<tr><td>" + data[i].nama + "</td><td>" + data[i].jumlah + "</td><td>" + formatRupiah(data[i].harga.toString()) + "</td><td>" + formatRupiah((data[i].harga * data[i].jumlah).toString()) + "</td></tr>"
                    }
                } else {
                    isiPesanan = "<td colspan='4'>Antrian Masih Kosong :)</td>"
                }
                $("#tabelRincian").html(isiPesanan)
                $("#totalHarga").val(formatRupiah(totalHarga.toString()))

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

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function cetakStruk() {
        // Ambil data dari modal
        var nama = document.getElementById('nama').value;
        var noMeja = document.getElementById('noMeja').value;
        var totalHarga = document.getElementById('totalHarga').value;
        var tanggal = new Date().toLocaleString('id-ID');
        
        // Buat tabel detail pesanan
        var detailPesanan = '';
        var tabelRincian = document.getElementById('tabelRincian');
        
        if (tabelRincian && tabelRincian.rows.length > 0) {
            detailPesanan += '<table style="width: 100%; border-collapse: collapse;">';
            detailPesanan += '<tr><th style="text-align: left;">Item</th><th style="text-align: center;">Qty</th><th style="text-align: right;">Harga</th><th style="text-align: right;">Total</th></tr>';
            detailPesanan += '<tr><td colspan="4"><hr style="border-top: 1px dashed #000;"></td></tr>';
            
            for (var i = 0; i < tabelRincian.rows.length; i++) {
                var row = tabelRincian.rows[i];
                if (row.cells.length >= 4) {
                    var namaItem = row.cells[0].textContent;
                    var qty = row.cells[1].textContent;
                    var harga = row.cells[2].textContent;
                    var total = row.cells[3].textContent;
                    
                    detailPesanan += `<tr>
                        <td style="text-align: left;">${namaItem}</td>
                        <td style="text-align: center;">${qty}</td>
                        <td style="text-align: right;">${harga}</td>
                        <td style="text-align: right;">${total}</td>
                    </tr>`;
                }
            }
            
            detailPesanan += '<tr><td colspan="4"><hr style="border-top: 1px dashed #000;"></td></tr>';
            detailPesanan += `<tr>
                <td colspan="2"></td>
                <td style="text-align: right;"><strong>Total:</strong></td>
                <td style="text-align: right;"><strong>Rp. ${formatRupiah(totalHarga)}</strong></td>
            </tr>`;
            detailPesanan += '</table>';
        } else {
            detailPesanan = '<p>Tidak ada detail pesanan tersedia.</p>';
        }
        
        // Buat konten struk
        var kontenStruk = `
        <div style="font-family: 'Courier New', monospace; width: 300px; padding: 10px;">
            <div style="text-align: center; margin-bottom: 10px;">
                <h3 style="margin: 5px 0;">KUBOKOPI</h3>
                <p style="margin: 5px 0;">Jl. Ryacudu No.48, Waydadi, Kec.Sukarame, Kota Bandar Lampung</p>
                <p style="margin: 5px 0;">Telp: 0812-3456-7890</p>
                <hr style="border-top: 1px dashed #000;">
            </div>
            <div>
                <p>Tanggal: ${tanggal}</p>
                <p>Nama: ${nama}</p>
                <p>No. Meja: ${noMeja}</p>
                <hr style="border-top: 1px dashed #000;">
            </div>
            <div>
                ${detailPesanan}
            </div>
            <div style="margin-top: 20px;">
                <p style="text-align: center;">*** TERIMA KASIH ***</p>
                <p style="text-align: center;">Silahkan datang kembali</p>
            </div>
        </div>
        `;
        
        // Buat jendela baru untuk mencetak
        var jendela = window.open('', '_blank', 'width=400,height=600');
        jendela.document.write('<html><head><title>Struk Pembayaran</title></head><body>');
        jendela.document.write(kontenStruk);
        jendela.document.write('</body></html>');
        jendela.document.close();
        
        // Cetak dan tutup jendela setelah selesai
        setTimeout(function() {
            jendela.print();
            // jendela.close();
        }, 500);
    }


</script>
<?php $this->endSection() ?>