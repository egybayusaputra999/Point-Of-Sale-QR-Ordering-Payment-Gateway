<?php $this->extend('template') ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="text-primary"><i class="mdi mdi-food-fork-drink"></i> Manajemen Status Menu</h4>
                <p class="text-muted">Anda dapat mengubah status ketersediaan menu (Tersedia/Habis)</p>
            </div>
            <div class="card-body text-center">
                <h2>Daftar Menu</h2>
                <hr>
                <table class="table table-striped">
                    <thead class="text-info">
                        <th>ID</th>
                        <th>NAMA</th>
                        <th>JENIS</th>
                        <th>HARGA</th>
                        <th>STATUS</th>
                        <th>FOTO</th>
                    </thead>
                    <tbody id="tabelMenu">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    muatData()

    function muatData() {
        $.ajax({
            url: '<?= base_url() ?>/menuKasir/muatData',
            method: 'post',
            dataType: 'json',
            success: function(data) {
                var tabel = ''
                for (let i = data.length - 1; i > -1; i--) {
                    tabel += "<tr><td>" + data[i].id + "</td><td>" + data[i].nama + "</td><td>"
                    if (data[i].jenis == 1) {
                        tabel += "Makanan"
                    } else if (data[i].jenis == 2) {
                        tabel += "Snack"
                    } else if (data[i].jenis == 3) {
                        tabel += "Minuman Dingin"
                    } else {
                        tabel += "Minuman Panas"
                    }
                    tabel += "</td><td>Rp. " + new Intl.NumberFormat('id-ID').format(data[i].harga) + "</td><td><select class='form-control text-dark' id='status" + data[i].id + "' onChange='ubahStatus(" + data[i].id + ")'>"
                    if (data[i].status == 0) {
                        tabel += "<option value='0' selected>Habis</option>"
                        tabel += "<option value='1'>Tersedia</option>"
                    } else {
                        tabel += "<option value='0'>Habis</option>"
                        tabel += "<option value='1' selected>Tersedia</option>"
                    }
                    tabel += "</select></td><td>"
                    if (data[i].foto && data[i].foto !== 'default.jpg') {
                        tabel += "<img src='<?= base_url() ?>/public/images/menu/" + data[i].foto + "' style='width: 50px; height: 50px; object-fit: cover; border-radius: 5px;' alt='" + data[i].nama + "'>"
                    } else {
                        tabel += "<span class='text-muted'><i class='mdi mdi-image-off'></i> No Image</span>"
                    }
                    tabel += "</td></tr>"
                }
                if (!tabel) {
                    tabel = '<tr><td class="text-center" colspan="6">Data Masih kosong :)</td></tr>'
                }
                $("#tabelMenu").html(tabel)
                $(".table").addClass('table-responsive')
            }
        });
    }

    function ubahStatus(id) {
        $.ajax({
            url: '<?= base_url() ?>/menuKasir/ubahStatus',
            method: 'post',
            data: "id=" + id + "&status=" + $("#status" + id).val(),
            dataType: 'json',
            success: function(data) {
                // Show success message
                var statusText = $("#status" + id).val() == 1 ? 'Tersedia' : 'Habis';
                
                // Create temporary success message
                var successMsg = $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                    '<i class="mdi mdi-check-circle"></i> Status menu berhasil diubah menjadi: <strong>' + statusText + '</strong>' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                    '</div>');
                
                $('.card-header').after(successMsg);
                
                // Auto hide after 3 seconds
                setTimeout(function() {
                    successMsg.fadeOut();
                }, 3000);
            }
        });
    }
</script>
<?php $this->endSection() ?>