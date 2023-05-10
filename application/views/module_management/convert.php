<!--<link href="<?php /*echo base_url() */?>application/third_party/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php /*echo base_url() */?>application/third_party/select2/dist/js/select2.min.js"></script>-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<style type="text/css">
    .clearfix-row:nth-child(even) {background:#f9fafc; margin-top:15px; padding-bottom:20px;}
</style>

<section id="main-content">
    <section class="wrapper">
        <div class="row col-lg-12">
            <section class="panel">
                <header class="panel-heading">Lead Conversion Mapping</header>
                <div class="panel-body">
                    <?php if (isset($message)) foreach ($message as $key => $value) { ?>
                        <div class="alert alert-<?php echo $key ?> alert-block fade in">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            <h4>
                                <i class="icon-ok-sign"></i>
                                <?php echo ucfirst($key) ?>!
                            </h4>
                            <p><?php echo $value ?></p>
                        </div>
                    <?php } ?>
                    <form role="form" action="" method="post">
                        <?php foreach ($leads_meta_fields as $key => $leadMeta) {
                            $leadMetaId = $leadMeta['id'];
                            $leadMetaModuleId = $leadMeta['module_id'];
                            $leadMetaName = $leadMeta['name'];
                            $jsID = str_replace(" ", "_", $leadMeta["name"]);
                            ?>
                            <div class="clearfix clearfix-row">
                                <div class="form-group col-lg-4" style="margin:15px 0 0;">
                                    <label>Lead Meta</label>
                                    <input type="text" value="<?php echo $leadMeta['name']; ?>" class="form-control" disabled="disabled"/>
                                </div>
                                <div class="form-group col-lg-4" style="margin:15px 0 0;">
                                    <label>Client Meta</label>
                                    <select name="client_<?php echo $jsID ?>" id="client_<?php echo $jsID ?>" style="width: 100% !important; padding: 5px;" class="populate">
                                        <option value="">None</option>
                                        <?php foreach ($clients_meta_fields as $key2 => $clientMeta) { ?>
                                            <?php $optionValue = "{$leadMetaModuleId}_{$leadMetaId}_{$clientMeta['id']}_{$clientMeta['module_id']}"; ?>
                                            <option <?php echo (in_array($optionValue, $meta_fields_mapping)) ? 'selected="selected"' : ""; ?> value="<?php echo $optionValue; ?>"><?php echo $clientMeta['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4" style="margin:15px 0 0;">
                                    <label>Contract Meta</label>
                                    <select name="contract_<?php echo $jsID ?>" id="contract_<?php echo $jsID ?>" style="width: 100% !important; padding: 5px;" class="populate">
                                        <option value="">None</option>
                                        <?php foreach ($contracts_meta_fields as $key3 => $contractMeta) { ?>
                                            <?php $optionValue = "{$leadMetaModuleId}_{$leadMetaId}_{$contractMeta['id']}_{$contractMeta['module_id']}"; ?>
                                            <option <?php echo (in_array($optionValue, $meta_fields_mapping)) ? 'selected="selected"' : ""; ?> value="<?php echo $optionValue; ?>"><?php echo $contractMeta['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group text-right" style="padding:15px 15px 0;">
                            <button type="submit" class="btn btn-success">Confirm Mapping</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>
</section>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                   // $("#client_<?php echo $jsID; ?>").select2();
                                });
                            </script>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                  //  $("#contract_<?php echo $jsID; ?>").select2();
                                });
                            </script>
