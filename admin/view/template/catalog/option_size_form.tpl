<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">

  <div class="page-header">

    <div class="container-fluid">

      <div class="pull-right">

        <button type="submit" form="form-information" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>

        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>

      <h1><?php echo $heading_title; ?></h1>

      <ul class="breadcrumb">

        <?php foreach ($breadcrumbs as $breadcrumb) { ?>

        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>

        <?php } ?>

      </ul>

    </div>

  </div>

  <div class="container-fluid">

    <?php if ($error_warning) { ?>

    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>

      <button type="button" class="close" data-dismiss="alert">&times;</button>

    </div>

    <?php } ?>

    <div class="panel panel-default">

      <div class="panel-heading">

        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>

      </div>

      <div class="panel-body">

        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">

          <ul class="nav nav-tabs">

            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>

            <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>

          </ul>

          <div class="tab-content">

            <div class="tab-pane active" id="tab-general">

              <ul class="nav nav-tabs" id="language">

                <?php foreach ($languages as $language) { ?>

                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>

                <?php } ?>

              </ul>

              <div class="tab-content">

                <?php foreach ($languages as $language) { ?>

                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">

                  <div class="form-group required">

                    <label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>

                    <div class="col-sm-10">

                      <input type="text" name="option_size_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($option_size_description[$language['language_id']]) ? $option_size_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" id="input-title<?php echo $language['language_id']; ?>" class="form-control" />

                      <?php if (isset($error_name[$language['language_id']])) { ?>

                      <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>

                      <?php } ?>

                    </div>

                  </div>

                  <div class="form-group required">

                    <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>

                    <div class="col-sm-10">

                      <textarea name="option_size_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control summernote"><?php echo isset($option_size_description[$language['language_id']]) ? $option_size_description[$language['language_id']]['description'] : ''; ?></textarea>

                      <?php if (isset($error_description[$language['language_id']])) { ?>

                      <div class="text-danger"><?php echo $error_description[$language['language_id']]; ?></div>

                      <?php } ?>

                    </div>

                  </div>

                  <div class="form-group required">

                    <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>

                    <div class="col-sm-10">

                      <input type="text" name="option_size_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($option_size_description[$language['language_id']]) ? $option_size_description[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />

                      <?php if (isset($error_meta_title[$language['language_id']])) { ?>

                      <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>

                      <?php } ?>

                    </div>

                  </div>

                  <div class="form-group">

                    <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>

                    <div class="col-sm-10">

                      <textarea name="option_size_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($option_size_description[$language['language_id']]) ? $option_size_description[$language['language_id']]['meta_description'] : ''; ?></textarea>

                    </div>

                  </div>

                  <div class="form-group">

                    <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>

                    <div class="col-sm-10">

                      <textarea name="option_size_description[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($option_size_description[$language['language_id']]) ? $option_size_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>

                    </div>

                  </div>

                </div>

                <?php } ?>

              </div>

            </div>

            <div class="tab-pane" id="tab-data">


              <div class="form-group">

                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>

                <div class="col-sm-10">

                  <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />

                </div>

              </div>

            </div>

          </div>

        </form>

      </div>

    </div>

  </div>

  <script type="text/javascript"><!--

$('#language a:first').tab('show');

//--></script></div>

<?php echo $footer; ?>