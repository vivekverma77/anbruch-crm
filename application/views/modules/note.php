<section class="panel" style="border:0;">
    <div class="panel-body">

     <!--  <div class="tab-title">
          <span>Notes</span>
          <span class="toggle-tab" data-toggle="collapse" data-target="#collapse-notes"> <i class="fa fa-minus-circle"></i> </span>
      </div>
				
      <div id="collapse-notes" class="collapse in">
        <?php if (isset($notes) && count($notes) > 0) { ?>
            <?php foreach ($notes as $key => $note) { ?>
                <div class="well well-large" style="padding:10px;">
                    <strong class="text-info" style="color:#444;">Posted on: <?php echo date("M d, Y H:i:s A", $note["created_time"]) ?> by <?php echo $note["created_by"] ?></strong>
                    <hr style="margin: 0;"/>
                    <h4 style="margin-top: 5px;color:#0098E3;font-size:12pt;font-weight:bold;"><?php echo $note["note_title"] ?></h4>
                    <?php echo $note["note"] ?>
                </div>
            <?php } ?>
        <?php } else { ?>
            <h3 class="text-center" style="margin: 0;">No notes available.</h3>
        <?php } ?>
        </div> -->


        <form role="form" id="addNoteForm" action="?cm=<?php echo $current_module; ?>&ac=note&id=<?php echo $current_record_id; ?>" method="post">
            <input type="hidden" name="module_name" value="<?php echo $current_module; ?>"/>
            <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>"/>
            <div class="row">
                <div class="form-group col-xs-12">
                    <div class="tab-title"> <span>Enter your note *</span> </div>
                    <textarea style="padding: 10px !important; height: auto !important; border: 1px solid #cccccc !important;" cols="10" rows="10" name="note" class="form-control" required="required" id="note" placeholder="Enter your note"></textarea>
                    <input type="hidden" name="note_title" value="" />
                </div>

                <div class="form-group col-xs-12 text-right">
                    <button type="submit" class="btn btn-success">Add note <i class="fa fa-plus icon-right"></i> </button>
                </div>
            </div>
        </form>
    </div>
</section>
