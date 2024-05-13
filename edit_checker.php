<?php include 'template/header.php';?>

<?php
$dt = $_GET['dt'];
$exca=$_GET['exca'];
$dumping=$_GET['dumping'];
$loading=$_GET['loading'];
$grup=$_GET['grup'];
$shift=$_GET['shift'];
$tanggal=$_GET['tanggal'];
$jam=$_GET['jam'];
// var_dump($jam);die;
$query = mysqli_query($conn, "SELECT * FROM detail_input where exca='$exca' AND tanggal='$tanggal' AND shift='$shift' AND grup='$grup' AND setting_dt='$dt' AND jam='$jam'AND dumping_point='$dumping' AND loading_point='$loading'");

?>




  <div class="col-md-9 mb-2">
    <div class="row">

    <!-- barang -->
    <div class="col-md-12 mb-2">
        
<?php
include "config.php";
if(isset($_POST['update']))
{
    $id = $_POST['id'];
    
    $dt = $_POST['DT'];
    
    $ton = $_POST['tonase'];
    
    
    $lp = $_POST['loading'];
    $dp = $_POST['dumping'];
    $jarak = $_POST['jarak'];
    $jam = $_POST['jam'];
    $waktu = $_POST['waktu'];
    $ukur = $_POST['pengukuran'];
    $result = mysqli_query($conn, "UPDATE detail_input SET setting_dt='$dt',tonase='$ton',loading_point='$lp',dumping_point='$dp',jarak='$jarak',Pengukuran='$ukur' WHERE id_temporary ='$id'");
    if(!$result){
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>NOOO!</strong> data gagal di update.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>
        ";
        } else{
        echo "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>YESSS!</strong> Data berhasil diupdate.
            <span id='countdown'>3</span> detik
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
        <script>
            var countdown = 3; // Waktu hitung mundur dalam detik
            var countdownElement = document.getElementById('countdown');
    
            function updateCountdown() {
                countdown--;
                countdownElement.textContent = countdown;
    
                if (countdown <= 0) {
                    window.location.href = 'detail_dt_laporan.php?exca=$exca&loading=$loading&dumping=$dumping&tanggal=$tanggal&shift=$shift&grup=$grup'; // Alamat tujuan pengalihan
                } else {
                    setTimeout(updateCountdown, 1000); // Perbarui setiap 1 detik
                }
            }
    
            setTimeout(updateCountdown, 1000); // Memulai hitung mundur
        </script>
        ";
        }
}
?>

<?php

if(isset($_POST['delete']))
{
    $id = $_POST['id'];
   
    $result = mysqli_query($conn, "Delete FROM detail_input WHERE id_temporary ='$id'");
    if(!$result){
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>NOOO!</strong> data gagal di hapus.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>
        ";
        } else{
        echo "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>YESSS!</strong> Data berhasil dihapus.
            <span id='countdown'>3</span> detik
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
        <script>
            var countdown = 3; // Waktu hitung mundur dalam detik
            var countdownElement = document.getElementById('countdown');
    
            function updateCountdown() {
                countdown--;
                countdownElement.textContent = countdown;
    
                if (countdown <= 0) {
                    window.location.href = 'detail_dt_laporan.php?exca=$exca&loading=$loading&dumping=$dumping&tanggal=$tanggal&shift=$shift&grup=$grup'; // Alamat tujuan pengalihan
                } else {
                    setTimeout(updateCountdown, 1000); // Perbarui setiap 1 detik
                }
            }
    
            setTimeout(updateCountdown, 1000); // Memulai hitung mundur
        </script>
        ";
        }
}
?>
<?php
while($data = mysqli_fetch_array($query))
{
    $idb = $data['id_temporary'];
    $dt = $data['setting_dt'];
    $ton = $data['tonase'];
    $lp = $data['loading_point'];
    $dp = $data['dumping_point'];
    $jarak = $data['jarak'];
    $jenis = $data['Jenis_BB'];
    $pengukuran = $data['Pengukuran'];
    $status = $data['Status'];
    $jam = $data['jam'];
    $jamloading = $data['jam_loading'];
    $waktu = $data['waktu'];
   
}
?>
         <div class="row">

        <!-- barang -->
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header bg-purple">
                    <div class="card-title text-white"><i class="fa fa-plus-square"></i> <b>Edit Dispatch</b></div>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-row">
                            <input type="hidden" name="id" value="<?php echo $idb ?>">
                            <div class="form-group col-md-6">
                                <label><b>Dump Truck</b></label>
                                <div class="form-select">
                                    <select name="DT" id="dts" class="form-control">
                                        <option disabled selected> Pilih </option>
                                        <?php
                                        $query = mysqli_query($conn, "SELECT unit from unit_dt");
                                        while ($data = mysqli_fetch_array($query)) {
                                              $selected = ($data['unit'] == $dt) ? 'selected' : '';
                                            ?>
                                            <option value="<?=$data['unit'];?>"<?= $selected; ?>><?php echo $data['unit'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                             <div class="form-group col-md-6">
                                <label><b>Exca</b></label>
                                <div class="form-select">
                                    <select name="exca"  class="form-control">
                                        <option disabled selected> Pilih </option>
                                        <?php
                                        $query = mysqli_query($conn, "SELECT unit from unit_exca");
                                        while ($data = mysqli_fetch_array($query)) {
                                              $selected = ($data['unit'] == $exca) ? 'selected' : '';
                                            ?>
                                            <option value="<?=$data['unit'];?>"<?= $selected; ?>><?php echo $data['unit'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!--<input type="hidden" id="selectedDT" name="selectedDT">-->
                           
                            <div class="form-group col-md-6">
                                <label><b>Nama Loading</b></label>
                                <div class="form-select">
                                <select name="loading" id="loading" class="form-control">
                                    <option disabled selected> Pilih </option>
                                     <?php
                                        $query = mysqli_query($conn, "SELECT Nama_loading from loading");
                                        while ($data = mysqli_fetch_array($query)) {
                                              $selected = ($data['Nama_loading'] == $lp) ? 'selected' : '';
                                            ?>
                                            <option value="<?=$data['Nama_loading'];?>"<?= $selected; ?>><?php echo $data['Nama_loading'];?></option>
                                            <?php
                                        }
                                        ?>
                                </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label><b>Nama Dumping</b></label>
                                <div class="form-select">
                                <select name="dumping" id="dumping" class="form-control">
                                    <option disabled selected> Pilih </option>
                                     <?php
                                        $query = mysqli_query($conn, "SELECT Nama_dumping from dumping");
                                        while ($data = mysqli_fetch_array($query)) {
                                              $selected = ($data['Nama_dumping'] == $dp) ? 'selected' : '';
                                            ?>
                                            <option value="<?=$data['Nama_dumping'];?>"<?= $selected; ?>><?php echo $data['Nama_dumping'];?></option>
                                            <?php
                                        }
                                        ?>
                                </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label><b>Jarak</b></label>
                                <input type="text" id="jarakk" name="jarak" class="form-control" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label><b>Jam Loading</b></label>
                                <input type="time"  name="jamloading" id="jamloading"class="form-control" value="<?php echo $jamloading?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label><b>Jam Dumping</b></label>
                                <input type="time"  name="jam" id="jamdumping" class="form-control" value="<?php echo $jam?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label><b>Waktu</b></label>
                                <input type="number"  name="waktu" id="waktu" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                        <label><b>Pengukuran</b></label>
                            <select name="pengukuran"  id="ukur" class="form-control">
                                 <option disabled selected> Pilih </option>
                                <?php
                                $ukur = array("Timbangan", "bypass", "beltscale");
                                foreach ($ukur as $option) {
                                        $selected = ($pengukuran == $option) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $option; ?>" <?= $selected; ?>><?php echo $option; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                            <div class="form-group col-md-6">
                                <label><b>Tonase</b></label>
                                <div class="input-group">
                                <input type="double" id="tonase" name="tonase" class="form-control" required value="<?php echo $ton?>">
                            </div>
                                    
                            </div>
                            
                        </div>
                        <button name="update" value="simpan" class="btn btn-purple" type="submit">
                                    <i class="fa fa-plus mr-2"></i>Update</button>
                                    <button name="delete" value="delete" class="btn btn-danger" type="submit">
                                    <i class="fa fa-minus mr-2"></i>delete</button>
                    </form>
                </div>
            </div>
        <!--</div>-->
        <!-- end barang -->


  <!--  </div><!-- end row col-md-9 -->
  <!--</div>-->
  
 
 <script>
    // Fungsi untuk mengambil jarak berdasarkan nama loading dan nama dumping
    function getJarak() {
        var nama_loading = document.getElementById('loading').value;
        var nama_dumping = document.getElementById('dumping').value;

        // Kirim permintaan AJAX ke server untuk mengambil data jarak
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_test.php?nama_loading=' + nama_loading + '&nama_dumping=' + nama_dumping, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var jarak = xhr.responseText;
                document.getElementById('jarakk').value = jarak;
                console.log(jarak);
            }
        };

        xhr.send();
    }

    // Memantau perubahan pada input
    document.getElementById('loading').addEventListener("change", getJarak);
    document.getElementById('dumping').addEventListener("change", getJarak);

    // Memanggil fungsi getJarak saat halaman dimuat
    document.addEventListener("DOMContentLoaded", function() {
        getJarak();
    });
</script>

<script>
    // Dapatkan elemen select
    var selectElement = document.getElementById('dts');
    var loadingSelect = document.getElementById('loading');
    var dumpingSelect = document.getElementById('dumping');
    var tonaseInput = document.getElementById('tonase');
    var ukurs = document.getElementById('ukur');
// Function to fetch and populate data
function fetchDataAndPopulateSelect() {
    // Get the selected value from the HTML select element
    var selectedValue = document.getElementById('dts').value;
    var encodedValue = btoa(selectedValue);

    // Send a request to the server to get data based on the selected value
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_data.php?nama_dt=' + encodedValue, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Parse the data received from the server
            var data = JSON.parse(xhr.responseText);
            var jenisPengukuran = data[0].Pengukuran;
            console.log(jenisPengukuran);

             // Iterate through the options and set the selected attribute
            for (var i = 0; i < ukurs.options.length; i++) {
                if (ukurs.options[i].value === jenisPengukuran) {
                    ukurs.options[i].selected = true;
                }
            }
            // Clear existing options in "loadingSelect"
            loadingSelect.innerHTML = '';

            // Add a default option for loading
            var defaultOption = document.createElement('option');
            defaultOption.text = 'Pilih Loading';
            defaultOption.value = '';
            loadingSelect.appendChild(defaultOption);

            // Populate "loadingSelect" with options from the retrieved data
            for (var i = 1; i < data.length; i++) {
                var option = document.createElement('option');
                option.text = data[i].loading;
                option.value = data[i].loading;
                loadingSelect.appendChild(option);

                // Display the name "Loading" and the value
                console.log("Loading: " + data[i].loading);
            }

            // Clear existing options in "dumpingSelect"
            dumpingSelect.innerHTML = '';

            // Add a default option for dumping
            var defaultOptionDumping = document.createElement('option');
            defaultOptionDumping.text = 'Pilih Dumping';
            defaultOptionDumping.value = '';
            dumpingSelect.appendChild(defaultOptionDumping);

            // Populate "dumpingSelect" with options from the retrieved data
            for (var i = 1; i < data.length; i++) {
                var option = document.createElement('option');
                option.text = data[i].dumping;
                option.value = data[i].dumping;
                dumpingSelect.appendChild(option);

                // Display the name "Dumping" and the value
                console.log("Dumping: " + data[i].dumping);
            }

            // Select the "nama loading" based on the first item in the data array
            var selectedLoading = data[1].loading; // Assuming the data array has at least one item
            loadingSelect.value = selectedLoading;

            // Select the "nama loading" based on the first item in the data array
            var selectedDumping = data[1].dumping; // Assuming the data array has at least one item
            dumpingSelect.value = selectedDumping;

        
        }
    };

    // Send the XMLHttpRequest
    xhr.send();
}

// Add an event listener for changes in the "dts" select element
document.getElementById('dts').addEventListener('change', function () {
    // Call the function to fetch and populate data when the select value changes
    fetchDataAndPopulateSelect();
});

// Call the function initially to populate data based on the initial select value
fetchDataAndPopulateSelect();

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen input jam loading, jam dumping, dan input waktu
        var jamLoadingInput = document.getElementById('jamloading');
        var jamDumpingInput = document.getElementById('jamdumping');
        var waktuInput = document.getElementById('waktu');

        // Tambahkan event listener untuk setiap perubahan nilai input
        jamLoadingInput.addEventListener('input', hitungRentangWaktu);
        jamDumpingInput.addEventListener('input', hitungRentangWaktu);

        // Fungsi untuk menghitung rentang waktu
        function hitungRentangWaktu() {
            // Ambil nilai jam loading dan jam dumping
            var jamLoadingValue = jamLoadingInput.valueAsDate;
            var jamDumpingValue = jamDumpingInput.valueAsDate;

            // Periksa apakah kedua nilai telah diisi
            if (jamLoadingValue && jamDumpingValue) {
                // Tambahkan 24 jam ke jamDumping jika jamDumping lebih kecil dari jamLoading
                if (jamDumpingValue < jamLoadingValue) {
                    jamDumpingValue.setHours(jamDumpingValue.getHours() + 24);
                }

                // Hitung selisih waktu dalam menit
                var selisihWaktu = (jamDumpingValue - jamLoadingValue) / (60 * 1000);

                // Update nilai input waktu
                waktuInput.value = selisihWaktu;

                // Tampilkan hasil perhitungan rentang waktu
                document.getElementById('hasilRentangWaktu').innerText = 'Rentang Waktu: ' + selisihWaktu + ' menit';
            } else {
                // Jika salah satu atau kedua input belum diisi, kosongkan hasil rentang waktu dan nilai input waktu
                document.getElementById('hasilRentangWaktu').innerText = '';
                waktuInput.value = '';
            }
        }
    });
</script>

<?php include 'template/footer.php';?>
