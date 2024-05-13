<!DOCTYPE html>
<html>
<head>
    <title>Contoh Form</title>
</head>
<body>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label><b>Dump Truck</b></label>
            <div class="form-select">
                <select name="DT" id="dt" class="form-control">
                    <option disabled selected> Pilih </option>
                    <?php
                    // Sambungkan ke database
                    $conn = mysqli_connect("localhost", "root", "", "dispatcher");

                    if (!$conn) {
                        die("Koneksi ke database gagal: " . mysqli_connect_error());
                    }

                    $query = mysqli_query($conn, "SELECT Nama_DT from setting_dt");
                    while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <option value="<?=$data['Nama_DT'];?>"><?php echo $data['Nama_DT'];?></option>
                        <?php
                    }
                    mysqli_close($conn);
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div>
        <label><b>Nama Loading</b></label>
        <div class="form-select">
            <select name="loading" id="loading" class="form-control">
                <option disabled selected> Pilih </option>
            </select>
        </div>
    </div>

    <div id="result"></div>

    <script>
    // Dapatkan elemen select
    var selectElement = document.getElementById('dt');
    var loadingSelect = document.getElementById('loading');
    var resultDiv = document.getElementById('result');

    // Sembunyikan elemen yang menampilkan respons JSON
    resultDiv.style.display = 'none';

    // Tambahkan event listener untuk mengidentifikasi perubahan nilai pada elemen "dt"
    selectElement.addEventListener('change', function() {
        // Dapatkan nilai yang dipilih
        var selectedValue = selectElement.value;

        // Kirim permintaan ke server untuk mengambil data sesuai dengan nilai yang dipilih
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_data.php?nama_dt=' + selectedValue, true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                // Parsing data yang diterima dari server
                var data = JSON.parse(xhr.responseText);

                // Mengisi elemen "loadingSelect" dengan opsi yang diterima
                loadingSelect.innerHTML = ''; // Menghapus opsi yang sudah ada

                for (var i = 0; i < data.length; i++) {
                    var option = document.createElement('option');
                    option.text = data[i].loading;
                    option.value = data[i].loading;
                    loadingSelect.appendChild(option);
                }
            }
        };

        xhr.send();
    });
</script>





</body>
</html>
