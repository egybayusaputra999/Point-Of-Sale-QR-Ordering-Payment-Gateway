<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Kelola Status Menu</h4>
                <p class="card-description">
                    Ubah status ketersediaan menu
                </p>
                <div class="table-responsive">
                    <table class="table table-striped" id="tabelMenu">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        muatData();
    });

    function muatData() {
        $.ajax({
            url: "<?= base_url() ?>/menuKaryawan/muatData",
            type: "POST",
            dataType: 'json',
            success: function(menu) {
                console.log('Data received:', menu);
                var html = "";
                if (menu && menu.length > 0) {
                    for (var i = 0; i < menu.length; i++) {
                        var jenisText = "";
                        if (menu[i].jenis == 1) {
                            jenisText = "Makanan";
                        } else if (menu[i].jenis == 2) {
                            jenisText = "Snack";
                        } else if (menu[i].jenis == 3) {
                            jenisText = "Minuman Dingin";
                        } else if (menu[i].jenis == 4) {
                            jenisText = "Minuman Panas";
                        }
                        
                        html += "<tr>";
                        html += "<td>" + menu[i].id + "</td>";
                        html += "<td>" + menu[i].nama + "</td>";
                        html += "<td>" + jenisText + "</td>";
                        html += "<td>Rp " + parseInt(menu[i].harga).toLocaleString('id-ID') + "</td>";
                        html += "<td>";
                        html += "<select class='form-control form-control-sm' onchange='ubahStatus(" + menu[i].id + ", this.value)' style='width: 120px;'>";
                        html += "<option value='1'" + (menu[i].status == 1 ? " selected" : "") + ">Tersedia</option>";
                        html += "<option value='0'" + (menu[i].status == 0 ? " selected" : "") + ">Habis</option>";
                        html += "</select>";
                        html += "</td>";
                        html += "<td>";
                        if (menu[i].foto && menu[i].foto !== 'default.jpg') {
                            html += "<img src='<?= base_url() ?>/public/images/menu/" + menu[i].foto + "' alt='Menu' style='width: 50px; height: 50px; object-fit: cover; border-radius: 5px;'>";
                        } else {
                            html += "<span class='text-muted'>Tidak ada foto</span>";
                        }
                        html += "</td>";
                        html += "</tr>";
                    }
                } else {
                    html = "<tr><td colspan='6' class='text-center'>Tidak ada data menu</td></tr>";
                }
                $("#tabelMenu tbody").html(html);
            },
            error: function(xhr, status, error) {
                console.log('Error details:', xhr.responseText);
                console.log('Status:', status);
                console.log('Error:', error);
                alert("Gagal memuat data menu: " + error);
                $("#tabelMenu tbody").html("<tr><td colspan='6' class='text-center text-danger'>Gagal memuat data</td></tr>");
            }
        });
    }

    function ubahStatus(id, status) {
        $.ajax({
            url: "<?= base_url() ?>/menuKaryawan/ubahStatus",
            type: "POST",
            data: {
                id: id,
                status: status,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    // Tampilkan notifikasi sukses
                    var statusText = status == 1 ? "Tersedia" : "Habis";
                    alert("Status menu berhasil diubah menjadi " + statusText);
                    // Refresh data
                    muatData();
                } else {
                    alert("Gagal mengubah status menu: " + (result.error || "Unknown error"));
                    // Refresh untuk mengembalikan nilai select
                    muatData();
                }
            },
            error: function(xhr, status, error) {
                console.log('Error details:', xhr.responseText);
                alert("Terjadi kesalahan saat mengubah status menu: " + error);
                // Refresh untuk mengembalikan nilai select
                muatData();
            }
        });
    }
</script>
<?= $this->endSection() ?>