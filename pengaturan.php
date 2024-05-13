<?php include 'template/header.php';?>
  <div class="col-md-9 mb-2">
    <div class="row">

    <!-- table barang -->
    <div class="col-md-7 mb-2">
                

        <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-cog"></i> <b>Account Setting</b></div>
            </div>
            <div class="card-body">
                <form method="POST">
                <fieldset>

                  <div class="form-group row">
                  <input type="hidden" name="id_login" value="<?php echo $id;?>">
                    <label class="col-sm-4 col-form-label"><b>Nama Toko :</b></label>
                    <div class="col-sm-8 mb-2">
                      <input type="text" name="nama_toko" class="form-control" value="<?php echo $toko;?>" required>
                    </div>
                    <label class="col-sm-4 col-form-label"><b>Telepon :</b></label>
                    <div class="col-sm-8 mb-2">
                      <input type="number" name="telp" class="form-control" value="<?php echo $telp;?>" required>
                    </div>
                    <label class="col-sm-4 col-form-label"><b>Alamat :</b></label>
                    <div class="col-sm-8 mb-2">
                      <input type="text" name="alamat" class="form-control" value="<?php echo $alamat;?>" required>
                    </div>
                    <label class="col-sm-4 col-form-label"><b>Username :</b></label>
                    <div class="col-sm-8 mb-2">
                    <input type="text" name="user" class="form-control" value="<?php echo $user;?>" required>
                    </div>
                    <label class="col-sm-4 col-form-label"><b>New Password:</b></label>
                    <div class="col-sm-8 mb-2">
                    <input type="password" name="pass" class="form-control"  placeholder="****" required>
                    </div>
                  </div>
                <div class="text-right">
                    <button class="btn btn-purple" name="get" type="submit">Update</button>
                </div>
                </fieldset>
                </form>
            </div>
        </div>
    </div>
    <!-- end table barang -->

    </div><!-- end row col-md-9 -->
  </div>

<?php include 'template/footer.php';?>
