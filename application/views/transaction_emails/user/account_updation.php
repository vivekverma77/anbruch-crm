<p>
    Hi <strong><?php echo $data['username'] ?></strong>,
    <br/>
    <br/>An account has been updated on behalf of you by the admin of Anbruch CRM. The account details are:
    <br/>Username: <strong><?php echo $data['email'] ?></strong>
    <br/>New Password: <strong><?php echo $data['password'] ?></strong>
    <br/>
    <br/>Please login into the <a href="<?php echo base_url() ?>" target="_blank"><strong>CRM</strong></a> and check your updated details.
    <br/>
    <br/>--------
    <br/>Thanks & Regards
    <br/>Admin
    <br/><strong><?php echo COMPANY_NAME ?></strong>
</p>
