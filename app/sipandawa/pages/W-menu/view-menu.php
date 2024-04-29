<div class="page-inner">
  <div id="content">
    <section id="viewMenu">
      <div class="col-md-12 col-lg-12">
        <div class="card mb-4 shadow-1">
          <div class="card-header">
            <h4 class="card-header-title">
              Form
              <?php echo $title ?>
            </h4>
          </div>
          <div class="card-body collapse show" id="collapse1">
            <form id="formInput" data-parsley-validate class="form-horizontal form-label-left"
              enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="idMenu" id="idMenu" value="" />
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">Sub Level</label>
                      <select class="form-control" data-live-search="true" name="subLevel" id="subLevel">
                        <option value="">- Pilih Level -</option>
                        <option value="1">1. Menu Parent</option>
                        <option value="2">2. Sub Menu Parent</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-email">Menu Parent</label>
                      <select class="form-control" name="menuParent" id="menuParent">
                        <option value="0">- Pilih Parent -</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">Nama Menu</label>
                      <input type="text" name="namaMenu" id="namaMenu" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-last-name">URL</label>
                      <input type="text" name="url" id="url" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">Icon</label>
                      <input type="text" name="icon" id="icon" value="fa fa-home" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-last-name">Letak Menu</label>
                      <div class="col-sm-7">
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="kiri" name="letakMenu" class="custom-control-input" checked
                            value="kiri">
                          <label class="custom-control-label" for="kiri">Kiri</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="kanan" name="letakMenu" class="custom-control-input" value="kanan">
                          <label class="custom-control-label" for="kanan">Kanan</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">Urutan</label>
                      <input type="text" name="urutanMenu" id="urutanMenu" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <hr class="my-4" />
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-7">
                  <button class="btn btn-primary" type="button" id="btnCancel">Cancel</button>
                  <button type="submit" class="btn btn-success" id="btnSubmit">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-12 col-lg-12">
        <div class="card mb-4 shadow-1">
          <div class="card-header">
            <h4 class="card-header-title">
              List Menu
            </h4>
          </div>
          <div class="card-body">
            <table class="table table-flush" id="tabelData">
              <thead class="thead-light">
                <tr>
                  <th width="20">ID</th>
                  <th>Sub Level</th>
                  <th>Nama Menu</th>
                  <th>Url</th>
                  <th>Letak Menu</th>
                  <th>Urutan Menu</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
    </section>
  </div>
</div>

<!-- TARUH SCRIPT MODUL MAHASISWA DI SINI -->
<script src="../pages/W-menu/script-menu.js?n=1" type="text/javascript"></script>