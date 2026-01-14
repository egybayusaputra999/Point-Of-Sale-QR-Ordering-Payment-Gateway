// Dashboard JavaScript Functions
var pesanan = [];
var ditemukan = false;
var jmlPesanan = 0;

// Fungsi untuk membuka modal keranjang
function bukaModalKeranjang() {
    tampilkanPesanan();
    $("#modalKeranjang").modal("show");
    $("#peringatan").hide();
}

// Fungsi untuk membuka modal login
function bukaModalLogin() {
    $("#modalLogin").modal("show");
}

// Fungsi untuk menampilkan hanya kategori yang dipilih
function showCategory(categoryId) {
    // Sembunyikan semua tab pane
    $('.tab-pane').removeClass('show active');
    $('.nav-link').removeClass('active');
    
    // Tampilkan tab kategori yang dipilih
    $('#' + categoryId).addClass('show active');
    $('#' + categoryId + '-tab').addClass('active');
    
    // Sembunyikan tombol kembali karena tab kategori tetap terlihat
    $('#backToAllContainer').hide();
    
    // Tetap tampilkan tab navigation
    $('#menuTabs').show();
}

// Fungsi untuk kembali ke tampilan semua menu
function showAllCategories() {
    // Tampilkan tab "Semua Menu"
    $('.tab-pane').removeClass('show active');
    $('.nav-link').removeClass('active');
    $('#all').addClass('show active');
    $('#all-tab').addClass('active');
    
    // Sembunyikan tombol kembali
    $('#backToAllContainer').hide();
    
    // Tampilkan tab navigation
    $('#menuTabs').show();
}

// Fungsi login
function login() {
    var idUser = $("#idUser").val();
    var pass = $("#pass").val();

    if ($("#pass").val() == "") {
        $("#pass").focus();
    } else {
        $.ajax({
            type: 'POST',
            data: 'idUser=' + idUser + '&pass=' + pass,
            url: window.baseUrl + '/dashboard/auth',
            dataType: 'json',
            success: function(data) {
                if (data == "") {
                    window.location.href = "antrian";
                } else {
                    $("#errorLogin").html(data);
                }
            }
        });
    }
}

// Fungsi proses transaksi
function prosesTransaksi() {
    var nama = $('#nama').val();
    var noMeja = $('#noMeja').val();
    if (nama == "") {
        $("#nama").focus();
        $("#peringatan").show();
    } else if (noMeja == "") {
        $("#noMeja").focus();
        $("#peringatan").show();
    } else {
        $("#simpanTransaksi").html('<i class="mdi mdi-reload fa-pulse"></i> Memproses..');
        
        // Simpan salinan pesanan untuk struk sebelum AJAX
        var pesananUntukStruk = JSON.parse(JSON.stringify(pesanan));
        var totalBayar = 0;
        for (let i = 0; i < pesananUntukStruk.length; i++) {
            totalBayar += pesananUntukStruk[i][2] * pesananUntukStruk[i][3];
        }
        
        $.ajax({
            type: 'POST',
            url: window.baseUrl + '/dashboard/tambahPesanan',
            data: {
                'pesanan': pesanan,
                'nama': nama,
                'noMeja': noMeja,
                'total': totalBayar
            },
            dataType: 'json',
            success: function(data) {
                if (data.status === 'success') {
                    // Simpan data untuk struk setelah transaksi berhasil
                    window.pesananStruk = pesananUntukStruk;
                    window.namaPelangganStruk = nama;
                    window.noMejaStruk = noMeja;
                    window.totalBayarStruk = totalBayar;
                    
                    // Tampilkan nama dan meja di modal sebelum reset form
                    $("#namaPemesan").html(nama);
                    $("#lokasiMeja").html(noMeja);
                    
                    $("#modalKeranjang").modal("hide");
                    pesanan = [];
                    $('#nama').val("");
                    $('#noMeja').val("");
                    tampilkanPesanan();

                    $("#simpanTransaksi").html('Pesan');
                    $("#modalSelesai").modal("show");
                } else {
                    alert('Gagal menyimpan pesanan: ' + data.message);
                    $("#simpanTransaksi").html('Pesan');
                }
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan saat memproses pesanan: ' + error);
                $("#simpanTransaksi").html('Pesan');
            }
        });
    }
}

// Fungsi tutup modal keranjang
function tutupModalKeranjang() {
    $("#modalKeranjang").modal("hide");
}

// Fungsi tutup modal selesai
function tutupModalSelesai() {
    $("#modalSelesai").modal("hide");
}

// Fungsi cetak struk
function cetakStruk() {
    // Ambil data pesanan dari variabel yang disimpan
    var nama = window.namaPelangganStruk || $("#namaPemesan").text();
    var noMeja = window.noMejaStruk || $("#lokasiMeja").text();
    var tanggal = new Date().toLocaleString('id-ID');
    
    // Buat tabel detail pesanan
    var detailPesanan = '';
    var totalBayar = 0;
    
    if (window.pesananStruk && window.pesananStruk.length > 0) {
        detailPesanan += '<table style="width: 100%; border-collapse: collapse;">';
        detailPesanan += '<tr><th style="text-align: left;">Item</th><th style="text-align: center;">Qty</th><th style="text-align: right;">Harga</th><th style="text-align: right;">Total</th></tr>';
        detailPesanan += '<tr><td colspan="4"><hr style="border-top: 1px dashed #000;"></td></tr>';
        
        for (let i = 0; i < window.pesananStruk.length; i++) {
            var item = window.pesananStruk[i];
            var namaItem = item[1];
            var qty = item[2];
            var harga = item[3];
            var total = qty * harga;
            totalBayar += total;
            
            detailPesanan += `<tr>
                <td style="text-align: left;">${namaItem}</td>
                <td style="text-align: center;">${qty}</td>
                <td style="text-align: right;">${formatRupiah(harga.toString())}</td>
                <td style="text-align: right;">${formatRupiah(total.toString())}</td>
            </tr>`;
        }
        
        detailPesanan += '<tr><td colspan="4"><hr style="border-top: 1px dashed #000;"></td></tr>';
        detailPesanan += `<tr>
            <td colspan="2"></td>
            <td style="text-align: right;"><strong>Total:</strong></td>
            <td style="text-align: right;"><strong>${formatRupiah(window.totalBayarStruk.toString())}</strong></td>
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

// Fungsi tutup modal login
function tutupModalLogin() {
    $("#modalLogin").modal("hide");
}

// Fungsi tambah pesanan
function tambahPesanan(id, nama, harga) {
    ditemukan = false;
    jmlPesanan = 0;
    for (let i = 0; i < pesanan.length; i++) {
        if (pesanan[i][0] == id) {
            pesanan[i][2] += 1;
            ditemukan = true;
        }
        jmlPesanan += pesanan[i][2];
    }
    if (ditemukan == false) {
        pesanan.push([id, nama, 1, harga]);
        jmlPesanan += 1;
    }

    $("#jmlPesanan").html("(" + jmlPesanan + ")");
}

// Fungsi tampilkan pesanan
function tampilkanPesanan() {
    var isiPesanan = "";

    for (let i = 0; i < pesanan.length; i++) {
        isiPesanan += "<tr><td>" + pesanan[i][1] + "</td><td>" + pesanan[i][2] + "</td><td>" + formatRupiah(pesanan[i][3].toString()) + "</td><td>" + formatRupiah((pesanan[i][2] * pesanan[i][3]).toString()) + "</td><td><button href='#' class='badge badge-danger' onClick='hapusPesanan(" + i + ")'>x</button></td></tr>";
    }
    if (pesanan.length < 1) {
        $("#simpanTransaksi").prop("disabled", true);
        isiPesanan = "<td colspan='5'>Pesanan Masih Kosong :)</td>";
    } else {
        $("#simpanTransaksi").prop("disabled", false);
    }

    $("#tabelPesanan").html(isiPesanan);
}

// Fungsi hapus pesanan
function hapusPesanan(id) {
    pesanan.splice(id, 1);
    tampilkanPesanan();
}

// Fungsi format rupiah
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