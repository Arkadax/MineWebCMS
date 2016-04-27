<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $Lang->get('GLOBAL__UPDATE') ?></h3>
        </div>
        <div class="box-body">

           <center>
            <p class="text-center"><?= $Lang->get('UPDATE__LAST_VERSION') ?> : <?= $Update->update['version'] ?></p>
            <div class="btn-group">
              <button id="update" class="btn btn-large btn-primary"><?= $Lang->get('GLOBAL__UPDATE') ?></button>
              <a href="<?= $this->Html->url(array('action' => 'check')) ?>" class="btn btn-large btn-info"><?= $Lang->get('UPDATE__CHECK_STATUS') ?></a>
              <a href="http://mineweb.org/changelog" target="_blank" class="btn btn-large btn-default"><?= $Lang->get('UPDATE__VIEW_CHANGELOG') ?></a>
            </div>
            <div id="update-msg"></div>
            <div class="progress progress-striped active" style="display:none;">
              <div class="bar" style="width: 40%;"></div>
            </div>
          </center>
          <br>

          <?php if(!empty($logs)) { ?>
            <hr>
            <h5 class="text-center"><?= $Lang->get('UPDATE__LOGS') ?></h5>
            <div id="log-update">
              <p><b><?= $Lang->get('GLOBAL__VERSION') ?></b> : <?= $logs['head']['version'] ?><br>
              <b><?= $Lang->get('GLOBAL__CREATED') ?></b> : <?= $logs['head']['date'] ?></p>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th><?= $Lang->get('GLOBAL__ACTIONS') ?></th>
                    <th><?= $Lang->get('GLOBAL__STATUS') ?></th>
                    <th><?= $Lang->get('UPDATE__FILE') ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($logs['update'])) { ?>
                    <?php foreach ($logs['update'] as $k => $v) { ?>
                    <tr>
                      <td><?= $Lang->get('UPDATE__LOGS_'.key($v)) ?></td>
                      <td>
                        <?php
                          $status = strtoupper($v[key($v)]['statut']);
                          echo '<div class="label label-';
                          echo ($status == "SUCCESS") ? 'success' : 'danger';
                          echo '">';
                            echo $Lang->get('GLOBAL__'.$status);
                          echo '</div>';
                        ?>
                      </td>
                      <td><?= $v[key($v)]['arg'] ?></td>
                      <td></td>
                    </tr>
                    <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>
  </div>
</section>
<script>
  function callMAJ(updaterUpdated) {
    var inputs = {};
    inputs["data[_Token][key]"] = '<?= $csrfToken ?>';

    if(updaterUpdated === undefined || updaterUpdated.length == 0) {
      updaterUpdated = '0';
    }

    $.ajax({
      type: 'POST',
      url: '<?= $this->Html->url(array('action' => 'update')) ?>/'+updaterUpdated,
      data: inputs,
      success: function(data) {

        if(data.statut == "success") {
          $('#update-msg').empty().html('<div class="alert alert-success" style="margin-top:10px;margin-right:10px;margin-left:10px;"><a class="close" data-dismiss="alert">×</a><b><?= $Lang->get('GLOBAL__SUCCESS') ?> :</b> '+data.msg+'</i></div>').fadeIn(500);
          $('#update').remove();
          $("#log-update").load("<?= $this->Html->url(array('action' => 'index')) ?> #log-update").fadeIn(500);
        } else if(data.statut == "continue") {
          callMAJ('1');
        } else if(data.statut == "error") {
          $('#update-msg').empty().html('<div class="alert alert-danger" style="margin-top:10px;margin-right:10px;margin-left:10px;"><a class="close" data-dismiss="alert">×</a><b><?= $Lang->get('GLOBAL__ERROR') ?> :</b> '+data.msg+'</i></div>').fadeIn(500);
        } else {
          alert('Error!');
        }

      },
      error: function() {
        alert('Error!');
      }
    });
  }

  $('#update').click(function() {
    $('#update').attr('disabled', 'disabled');
    $('#update-msg').html('<br><div class="alert alert-info"><?= $Lang->get('UPDATE__LOADING') ?></div>').fadeIn(500);

    callMAJ();
  });

</script>
