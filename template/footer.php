</div><!-- end row -->
</div> <!-- end container fluid -->
<footer class="text-center mb-0 py-3">
    <p class="text-muted small mb-0">Copyright &copy; <?php echo  date("Y");?> <a href="https://satriam.github.io" style="text-decoration:none;">
    <b>Satria Mulya</b></a>. All Rights Reserved</p>
</footer>
</div>
<!-- Unlock Modal -->
<div class="modal fade" id="unlockModal" tabindex="-1" aria-labelledby="unlockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unlockModalLabel">Enter Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="password" id="unlockPassword" class="form-control" placeholder="Enter Password">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="unlockButton">Unlock</button>
            </div>
        </div>
    </div>
</div>

<!-- Lock Popup Modal -->
<div class="modal fade" id="lockPopupModal" tabindex="-1" aria-labelledby="lockPopupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lockPopupModalLabel">System Locked</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>The system is locked. Please unlock the system to access the content.</p>
                <p>Trouble? <a href="https://wa.me/6285156145066" target="_blank">Chat Admin</a> </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


<!-- Locked Content -->
<div class="container d-flex flex-column justify-content-center align-items-center min-vh-100" id="lockedMessage">
    <div class="h-1 bd-highlight"><img src="../assets/img/icon.png" width="80%" height="80%"></div>
    <div class="h-1 bd-highlight"><p class="text-muted small mb-0">Copyright &copy; <?php echo  date("Y");?> <a href="https://satriam.github.io" style="text-decoration:none;">
    <b>Satria Mulya</b></a>. All Rights Reserved</p></div>
    
  
</div>
<script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
    <!--<script src="assets/js/jquery.slim.min.js"></script>-->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>

    <!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script> -->
    <script type="text/javascript">
      $(document).ready(function() {
    $('#table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
$(document).ready(function() {
    $('#table_data').DataTable( {
    } );
} );
    </script>

    <script type = "text/javascript">

$(document).ready(function() {
    $(".tabell-data").DataTable( {
    } );
} );
    </script>

<script type="text/javascript">
 $(document).ready(function() {
     $(".js-example-responsive").select2();
 });
</script>


<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
    const unlockPasswordInput = document.getElementById('unlockPassword');
    const unlockButton = document.getElementById('unlockButton');
    const unlockModal = new bootstrap.Modal(document.getElementById('unlockModal'), {});
    const lockPopupModal = new bootstrap.Modal(document.getElementById('lockPopupModal'), {}); // Modal for lock popup
    const lockedMessage = document.getElementById('lockedMessage'); // Reference to the locked message element
    document.getElementById("unlockPassword").addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            // Trigger the action you want here, for example, clicking the unlock button
            document.getElementById("unlockButton").click();
        }
    });
    // Function to lock the system
    function lockSystem() {
        showLockedContent();
        // You can add additional logic here if needed
    }

    // Function to show locked content and hide unlocked content
    function showLockedContent() {
        unlockedContent.classList.add('d-none');
        lockedMessage.classList.remove('d-none'); // Show the locked message
    }

    // Function to hide locked content
    function hideLockedContent() {
        lockedMessage.classList.add('d-none'); // Hide the locked message
        lockedMessage.classList.remove('d-flex'); // Hide the locked message

    }

    // Function to show unlocked content and hide locked content
    function showUnlockedContent() {
        hideLockedContent();
        unlockedContent.classList.remove('d-none');
        unlockModal.hide(); // Hide the modal when the password is correct
    }

    // Function to clear input value in the modal
    function clearModalInput() {
        unlockPasswordInput.value = ''; // Clear the input value
    }

    // Function to check if the system is locked and update the UI accordingly
    function checkLockStatus() {
        const lockTime = localStorage.getItem('?hs78gjdhf9873hfjdbbc7');
        const currentTime = new Date().getTime();
        const sixHoursInMillis = 6 * 60 * 60 * 1000; // 6 hours in milliseconds

        if (lockTime && currentTime - lockTime < sixHoursInMillis) {
            showUnlockedContent();
        } else {
            lockSystem();
            lockPopupModal.show(); // Show lock popup modal after 6 hours
        }
    }

    // Check the lock status when the page loads
    checkLockStatus();

    // Event listener for the unlock button
    // unlockButton.addEventListener('click', function () {
    //     const enteredPassword = unlockPasswordInput.value;
    //     // Add your password validation logic here
    //     // For simplicity, let's assume the correct password is 'password'
    //     if (enteredPassword === 'rehandling2023!') {
    //         localStorage.setItem('lockTime', new Date().getTime());
    //         showUnlockedContent();
    //         hideLockedContent(); // Hide the locked message when unlocked
    //     } else {
    //         alert('Incorrect Password. Please try again.');
    //     }
    // });


// Event listener for the unlock button
unlockButton.addEventListener('click', function () {
    const enteredPassword = unlockPasswordInput.value;

    // Kirim data ke server untuk verifikasi
    fetch('verify_password.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `password=${encodeURIComponent(enteredPassword)}`,
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {     
            // Dapatkan informasi sistem operasi dan browser
            const os = window.navigator.platform;
            const browser = window.navigator.userAgent;

    // Introduce a delay before making the next request
    setTimeout(() => {
        // Kirim data ke server PHP menggunakan metode POST
        fetch('save_computer_info.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `operatingSystem=${encodeURIComponent(os)}&browser=${encodeURIComponent(browser)}`,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.text();
        })
        .then(message => {
            console.log(message);
            // Lakukan tindakan selanjutnya setelah data disimpan
            localStorage.setItem('?hs78gjdhf9873hfjdbbc7', new Date().getTime());
            showUnlockedContent();
            hideLockedContent(); 
        })
        .catch(error => console.error('Failed to save computer info:', error.message));
    }, 1000); // Adjust the delay (in milliseconds) as needed
}
               
  else {
            alert('Gagal Masuk! ' + data.error); // Include specific error message
        }
    })
    .catch(error => console.error('Failed to verify password:', error.message));
});



    // Event listener for the "OK" button on the lock popup modal
    const lockPopupOkButton = document.querySelector('#lockPopupModal .btn-primary');
    lockPopupOkButton.addEventListener('click', function () {
        unlockModal.show(); // Show the password modal
    });

    // Event listener for the 'hidden.bs.modal' event on the unlock modal
    unlockModal._element.addEventListener('hidden.bs.modal', clearModalInput);

    // Set up a timer to check the lock status every 10 seconds
    setInterval(checkLockStatus, 60000); // Check every 10 seconds
});

</script>


<script>
    const driver = window.driver.js.driver;
    function toggleMenu() {
    var menu = document.querySelector('.menu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
}

function handleMenuItem(option) {
    
    if (option === 'Menu') {
        const driverObj = driver({
  showProgress: true,
  steps: [
    { element: '#nav', popover: { title: 'Sidebar', description: 'Bagian ini Berisi data menu yang digunakan oleh dispatcher untuk melakukan semua setting data.', side: "left", align: 'start' }},
    { element: '#dispatcher', popover: { title: 'Menu Dispatch', description: 'Menu ini digunakan untuk dispatch melakukan input data perDT melakukan dumping.', side: "right", align: 'start' }},
    { element: '#settingfleet', popover: { title: 'Menu Setting Fleet', description: 'Menu Setting Fleet digunakan untuk menginput data fleet exca yang akan beroperasi dan lokasi exca oleh dispatcher', side: "right", align: 'start' }},
    { element: '#settingdt', popover: { title: 'Menu Setting Dump Truck', description: 'Menu Setting Dump Truck digunakan untuk menginputkan data dump truck yang akan beroperasi dan dengan exca mana dump truck melakukan loading', side: "left", align: 'start' }},
    { element: '#unit', popover: { title: 'Menu Unit', description: 'Menu unit digunakan untuk menginputkan data Exca jika terdapat exca baru', side: "right", align: 'start' }},
    { element: '#jarak', popover: { title: 'Menu Jarak', description: 'Menu Jarak digunakan untuk menginputkan data Jarak Antara Loading Point dan Dumping Point.', side: "right", align: 'start' }},
    { element: '#laporan', popover: { title: 'Menu Laporan', description: 'Menu Laporan digunakan untuk melihat data laporan yang sudah diinputkan oleh dispatcher, rekap laporan akan masuk ke menu laporan di akhir shift', side: "right", align: 'start' }},
    { popover: { title: 'Selamat Bekerja!', description: 'jika ada pertanyaan, silahkan tanyakan pada admin' } }
  ]
});

driverObj.drive();
    }
}
</script>



</body>
</html>


