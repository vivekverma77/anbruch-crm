<p>
    Dear test<strong><?php echo $closer_name ?></strong>,

    This is to inform you that a lead has been assigned to you for further processing by <strong><?php echo $opener_name ?></strong>.

    The Company Highlights are as follows:

    Company: <?php echo $lead['company_name'] ?>
    Parent Company Name: <?php echo $lead['parent_company_name'] ?>
    Business Type: <?php echo $lead['business_type'] ?>
    Service Type: <strong><?php echo $lead['service_type'] ?></strong>
    Primary NAICS Description: <?php echo $lead['primary_naics_description'] ?>
    Estimated Sales: <?php echo $lead['estimated_sales'] ?>
    Lead Name: <strong><a href="<?php echo $lead['link'] ?>" target="_blank"><?php echo $lead['name'] ?></a></strong>
    Opener Call Status: <strong><?php echo $lead['opener_call_status'] ?></strong>
    Title: <?php echo $lead['title'] ?>
    Email: <?php echo $lead['email'] ?>
    Phone: <?php echo $lead['phone'] ?>
    Direct Number: <?php echo $lead['direct_number'] ?>
    Direct Number Extension: <?php echo $lead['direct_number_extension'] ?>
    Address Line 1: <?php echo $lead['address_line_1'] ?>
    City: <?php echo $lead['city'] ?>
    Province: <?php echo $lead['province'] ?>
    Country: <?php echo $lead['country'] ?>
    Zip Code: <?php echo $lead['zip_code'] ?>
    Website: <?php echo $lead['website'] ?>

    Should you have any questions or concerns please let me know.

    --------
    Regards,
    Assigned By: <strong><?php echo $username ?></strong>
    Opener: <strong><?php echo $opener_name ?></strong>
    Closer: <strong><?php echo $closer_name ?></strong>
    <strong><?php echo COMPANY_NAME ?></strong>
</p>