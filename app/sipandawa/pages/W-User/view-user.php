<div id="content">	
    <section id="viewUser">
        
        <!--=========================== LOADING PAGE-->
        <div id="veiw_loading" class="modal fade bs-example-modal-sm" data-backdrop="static" data-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
            
                <div class="modal-header">
                </div>
                <div class="modal-body" align="center">
                  <span class="fa fa-spinner fa-spin fa-3x"></span> <span>Loading ... ! / 載入中 ... !</span>
                </div>
                <div class="modal-footer">
                </div>
            
              </div>
            </div>
        </div>
        <!--=========================== LOADING PAGE-->

        <div id="list">

            <div class="panel">
                <div class="panel-heading">
                    <!-- Include the panel-controlgrunt live -->
                    <div class="panel-control">
                        <button class="btn btn-s btn-bordered btn-default" type="button"
                                data-panel="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>                        
                    <div class="panel-title">
                        List <strong>USER</strong>
                    </div>
                </div>

                <!-- Content Untuk Panel -->
                <div class="panel-body panel-body-color">
                    <!--<button class="btn btn-primary" id="btnAdd">Tambah User</button>-->
                    
                    <div class="row">
                        <div class="col-md-2 center-margin"></div>
                        <div class="col-md-8 center-margin">
                            <form id="formInput" data-parsley-validate class="form-horizontal form-label-left">
                                <input type="hidden" class="form-control" name="id" id="id" value=""/>
                                <input type="hidden" class="form-control" name="id_level" id="id_level" value='<?php echo $_SESSION['id_level'] ?>'/>
                                <input type="hidden" class="form-control" name="id_user" id="id_user" value='<?php echo $_SESSION['id_user'] ?>'/>
                                <input type="hidden" class="form-control" name="inp_sysdate" id="inp_sysdate" value="<?php echo $_SESSION['sysdate'] ?>"/>
                                
                                <div class="form-group">
                                    <label>Level / 水平 * :</label>
                                    <select class="form-control" name="select_level" id="select_level" ></select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Nama User / 那抹 用戶 * :</label>
                                    <input type="text" name="nama_user" id="nama_user" class="form-control" placeholder="Enter Nama User / 輸入用戶名">
                                </div>
                            
                                <div class="form-group">
                                    <label>Email Or Username / 電子郵件或用戶名 * :</label>
                                    <input type="text" name="email_user" id="email_user" class="form-control" placeholder="Enter Email Or Username / 輸入電子郵件或用戶名">
                                </div>
                              
                                <div class="form-group">
                                    <label>Password / 密碼</label>
                                    <input type="password" name="password" id="password"  class="form-control" value="xxxxxxxxx">
                                </div>
                                
                                <div class="form-group" id="form_resetPassword" style="display:none">
                                    <input type="checkbox" name="reset_password" id="reset_password"> <label>Reset Password / 重置密碼</label> <br>
                                    <input type="hidden" name="nilai_reset" id="nilai_reset"  class="form-control" value="0" >
                                </div>
                             
                              <div class="ln_solid"></div>
                              
                              <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                  <button class="btn btn-primary" type="button" id="btnCancel">Cancel / 取消</button>
                                  <button type="submit" class="btn btn-success" id="btnSubmit">Submit / 提交</button>
                                </div>
                              </div>
            
                            </form>
                        </div>
                        <div class="col-md-2 center-margin"></div>
                    </div>
                    
                    <hr class="dotted"/>

                    <table id="tabelData" class="table table-striped table-hover dt-responsive" width="100%">
                        <thead>
                            <tr>
                                <th width="20">No</th>
            					<th>Level</th>
            					<th>Nama User</th>
            					<th>Email or Username</th>
            					<th width="200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>

        </div>



    </section>
</div>

<!-- TARUH SCRIPT MODUL MAHASISWA DI SINI -->
<script src="../pages/W-User/script-user.js" type="text/javascript"></script>

