<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= $Lang->get('NEWS__ADD_NEWS') ?></h3>
                </div>
                <div class="card-body">
                    <form action="<?= $this->Html->url(array('controller' => 'news', 'action' => 'add_ajax')) ?>"
                          method="post" data-ajax="true"
                          data-redirect-url="<?= $this->Html->url(array('controller' => 'news', 'action' => 'admin_index', 'admin' => 'true')) ?>">

                        <div class="ajax-msg"></div>

                        <div class="form-group">
                            <label><?= $Lang->get('GLOBAL__TITLE') ?></label>
                            <input name="title" class="form-control" placeholder="<?= $Lang->get('GLOBAL__TITLE') ?>"
                                   type="text">
                        </div>

                        <div class="form-group">
                            <label><?= $Lang->get('GLOBAL__SLUG') ?></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><?= $this->Html->url('/blog/', true) ?></span>
                                </div>
                                <input name="slug" id="slug" class="form-control"
                                       placeholder="<?= $Lang->get('GLOBAL__SLUG') ?>" type="text">
                                <div class="input-group-append">
                                    <a href="#" id="generate_slug" class="btn d-inline btn-info"><?= $Lang->get('GLOBAL__GENERATE') ?></a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <?= $this->Html->script('admin/tinymce/tinymce.min.js') ?>
                            <script type="text/javascript">
                                tinymce.init({
                                    selector: "textarea",
                                    height: 300,
                                    width: '100%',
                                    language: 'fr_FR',
                                    plugins: "textcolor code image link",
                                    toolbar: "fontselect fontsizeselect bold italic underline strikethrough link image forecolor backcolor alignleft aligncenter alignright alignjustify cut copy paste bullist numlist outdent indent blockquote code"
                                });
                            </script>
                            <textarea id="editor" name="content" cols="30" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <input name="published" type="checkbox" checked="checked">
                                <label><?= $Lang->get('NEWS__WANT_TO_PUBLISH') ?></label>
                            </div>
                        </div>

                        <div class="float-right">
                            <a href="<?= $this->Html->url(array('controller' => 'news', 'action' => 'admin_index', 'admin' => true)) ?>"
                               class="btn btn-default"><?= $Lang->get('GLOBAL__CANCEL') ?></a>
                            <button class="btn btn-primary" type="submit"><?= $Lang->get('GLOBAL__SUBMIT') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
