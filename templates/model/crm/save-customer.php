<?php

include('../../../src/model/dbconn.php');

$customerID = $_POST['customerID'];
$staffName = $_POST['staffName'];
$source = $_POST['source'];
$customerName = $_POST['customerName'];
$customerEmail = $_POST['customerEmail'];
$customerPhone = $_POST['customerPhone'];
$strippedSpace = str_replace(' ', '', $customerPhone);
$address1 = $_POST['address1'];
$city = $_POST['city'];
$postcode = $_POST['postcode'];
$state = $_POST['state'];
$packageType = $_POST['packageType'];
$packageName = $_POST['packageName'];
$packageDate = $_POST['packageDate'];
$packageTWN = $_POST['packageTWN'];
$packageSGL = $_POST['packageSGL'];
$packageCTW = $_POST['packageCTW'];
$packageCWB = $_POST['packageCWB'];
$packageCNB = $_POST['packageCNB'];
$request = $_POST['request'];

// Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

// Check if customer ID already existed
$customerCheck = "SELECT * FROM customers WHERE id = '$customerID'";
$resultCheck = mysqli_query($conn, $customerCheck);

if (mysqLi_num_rows($resultCheck) > 0) {
  echo "Sorry, customer ID already existed inside the database";
} else {
  // Insert into customer table
  $customer = "INSERT INTO customers (staffName, source, customerName, customerEmail, customerPhone, address1, city, postcode, state, created, modified) VALUE ('$staffName', '$source', '$customerName', '$customerEmail', '$strippedSpace', '$address1', '$city', '$postcode', '$state', '$created', '$modified')";
  if ($resultCustomer = mysqli_query($conn, $customer)) {
    echo "Berjaya insert dalam customer's table<br>";
  } else {
    echo mysqli_error($conn) . "<br>";
  }

  // Insert into enquiry table
  $enquiry = "INSERT INTO enquiries (customerID, packageType, packageName, packageDate, packageTWN, packageSGL, packageCTW, packageCWB, packageCNB, request, created, modified) VALUE ('$customerID', '$packageType', '$packageName', '$packageDate', '$packageTWN', '$packageSGL', '$packageCTW', '$packageCWB', '$packageCNB', '$request', '$created', '$modified')";
  if ($resultEnquiry = mysqli_query($conn, $enquiry)) {
    echo "Berjaya insert dalam enquiry table";
  } else {
    echo mysqli_error($conn) . "<br>";
  }

  // Send email notification
  $to = "tours@enrichtravel.my";
  $subject = "New Customer Inserted | " . $customerName;

  $message = '
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer - Customer Name</title>
    <style type="text/css">
      .ExternalClass {
        width: 100%
      }

      .ExternalClass,
      .ExternalClass p,
      .ExternalClass span,
      .ExternalClass font,
      .ExternalClass td,
      .ExternalClass div {
        line-height: 150%
      }

      a {
        text-decoration: none
      }

      body,
      td,
      input,
      textarea,
      select {
        margin: unset;
        font-family: unset
      }

      input,
      textarea,
      select {
        font-size: unset
      }

      @media screen and (max-width: 600px) {

        table.row th.col-lg-1,
        table.row th.col-lg-2,
        table.row th.col-lg-3,
        table.row th.col-lg-4,
        table.row th.col-lg-5,
        table.row th.col-lg-6,
        table.row th.col-lg-7,
        table.row th.col-lg-8,
        table.row th.col-lg-9,
        table.row th.col-lg-10,
        table.row th.col-lg-11,
        table.row th.col-lg-12 {
          display: block;
          width: 100% !important
        }

        .d-mobile {
          display: block !important
        }

        .d-desktop {
          display: none !important
        }

        .w-lg-25 {
          width: auto !important
        }

        .w-lg-25>tbody>tr>td {
          width: auto !important
        }

        .w-lg-50 {
          width: auto !important
        }

        .w-lg-50>tbody>tr>td {
          width: auto !important
        }

        .w-lg-75 {
          width: auto !important
        }

        .w-lg-75>tbody>tr>td {
          width: auto !important
        }

        .w-lg-100 {
          width: auto !important
        }

        .w-lg-100>tbody>tr>td {
          width: auto !important
        }

        .w-lg-auto {
          width: auto !important
        }

        .w-lg-auto>tbody>tr>td {
          width: auto !important
        }

        .w-25 {
          width: 25% !important
        }

        .w-25>tbody>tr>td {
          width: 25% !important
        }

        .w-50 {
          width: 50% !important
        }

        .w-50>tbody>tr>td {
          width: 50% !important
        }

        .w-75 {
          width: 75% !important
        }

        .w-75>tbody>tr>td {
          width: 75% !important
        }

        .w-100 {
          width: 100% !important
        }

        .w-100>tbody>tr>td {
          width: 100% !important
        }

        .w-auto {
          width: auto !important
        }

        .w-auto>tbody>tr>td {
          width: auto !important
        }

        .p-lg-0>tbody>tr>td {
          padding: 0 !important
        }

        .pt-lg-0>tbody>tr>td,
        .py-lg-0>tbody>tr>td {
          padding-top: 0 !important
        }

        .pr-lg-0>tbody>tr>td,
        .px-lg-0>tbody>tr>td {
          padding-right: 0 !important
        }

        .pb-lg-0>tbody>tr>td,
        .py-lg-0>tbody>tr>td {
          padding-bottom: 0 !important
        }

        .pl-lg-0>tbody>tr>td,
        .px-lg-0>tbody>tr>td {
          padding-left: 0 !important
        }

        .p-lg-1>tbody>tr>td {
          padding: 0 !important
        }

        .pt-lg-1>tbody>tr>td,
        .py-lg-1>tbody>tr>td {
          padding-top: 0 !important
        }

        .pr-lg-1>tbody>tr>td,
        .px-lg-1>tbody>tr>td {
          padding-right: 0 !important
        }

        .pb-lg-1>tbody>tr>td,
        .py-lg-1>tbody>tr>td {
          padding-bottom: 0 !important
        }

        .pl-lg-1>tbody>tr>td,
        .px-lg-1>tbody>tr>td {
          padding-left: 0 !important
        }

        .p-lg-2>tbody>tr>td {
          padding: 0 !important
        }

        .pt-lg-2>tbody>tr>td,
        .py-lg-2>tbody>tr>td {
          padding-top: 0 !important
        }

        .pr-lg-2>tbody>tr>td,
        .px-lg-2>tbody>tr>td {
          padding-right: 0 !important
        }

        .pb-lg-2>tbody>tr>td,
        .py-lg-2>tbody>tr>td {
          padding-bottom: 0 !important
        }

        .pl-lg-2>tbody>tr>td,
        .px-lg-2>tbody>tr>td {
          padding-left: 0 !important
        }

        .p-lg-3>tbody>tr>td {
          padding: 0 !important
        }

        .pt-lg-3>tbody>tr>td,
        .py-lg-3>tbody>tr>td {
          padding-top: 0 !important
        }

        .pr-lg-3>tbody>tr>td,
        .px-lg-3>tbody>tr>td {
          padding-right: 0 !important
        }

        .pb-lg-3>tbody>tr>td,
        .py-lg-3>tbody>tr>td {
          padding-bottom: 0 !important
        }

        .pl-lg-3>tbody>tr>td,
        .px-lg-3>tbody>tr>td {
          padding-left: 0 !important
        }

        .p-lg-4>tbody>tr>td {
          padding: 0 !important
        }

        .pt-lg-4>tbody>tr>td,
        .py-lg-4>tbody>tr>td {
          padding-top: 0 !important
        }

        .pr-lg-4>tbody>tr>td,
        .px-lg-4>tbody>tr>td {
          padding-right: 0 !important
        }

        .pb-lg-4>tbody>tr>td,
        .py-lg-4>tbody>tr>td {
          padding-bottom: 0 !important
        }

        .pl-lg-4>tbody>tr>td,
        .px-lg-4>tbody>tr>td {
          padding-left: 0 !important
        }

        .p-lg-5>tbody>tr>td {
          padding: 0 !important
        }

        .pt-lg-5>tbody>tr>td,
        .py-lg-5>tbody>tr>td {
          padding-top: 0 !important
        }

        .pr-lg-5>tbody>tr>td,
        .px-lg-5>tbody>tr>td {
          padding-right: 0 !important
        }

        .pb-lg-5>tbody>tr>td,
        .py-lg-5>tbody>tr>td {
          padding-bottom: 0 !important
        }

        .pl-lg-5>tbody>tr>td,
        .px-lg-5>tbody>tr>td {
          padding-left: 0 !important
        }

        .p-0>tbody>tr>td {
          padding: 0 !important
        }

        .pt-0>tbody>tr>td,
        .py-0>tbody>tr>td {
          padding-top: 0 !important
        }

        .pr-0>tbody>tr>td,
        .px-0>tbody>tr>td {
          padding-right: 0 !important
        }

        .pb-0>tbody>tr>td,
        .py-0>tbody>tr>td {
          padding-bottom: 0 !important
        }

        .pl-0>tbody>tr>td,
        .px-0>tbody>tr>td {
          padding-left: 0 !important
        }

        .p-1>tbody>tr>td {
          padding: 4px !important
        }

        .pt-1>tbody>tr>td,
        .py-1>tbody>tr>td {
          padding-top: 4px !important
        }

        .pr-1>tbody>tr>td,
        .px-1>tbody>tr>td {
          padding-right: 4px !important
        }

        .pb-1>tbody>tr>td,
        .py-1>tbody>tr>td {
          padding-bottom: 4px !important
        }

        .pl-1>tbody>tr>td,
        .px-1>tbody>tr>td {
          padding-left: 4px !important
        }

        .p-2>tbody>tr>td {
          padding: 8px !important
        }

        .pt-2>tbody>tr>td,
        .py-2>tbody>tr>td {
          padding-top: 8px !important
        }

        .pr-2>tbody>tr>td,
        .px-2>tbody>tr>td {
          padding-right: 8px !important
        }

        .pb-2>tbody>tr>td,
        .py-2>tbody>tr>td {
          padding-bottom: 8px !important
        }

        .pl-2>tbody>tr>td,
        .px-2>tbody>tr>td {
          padding-left: 8px !important
        }

        .p-3>tbody>tr>td {
          padding: 16px !important
        }

        .pt-3>tbody>tr>td,
        .py-3>tbody>tr>td {
          padding-top: 16px !important
        }

        .pr-3>tbody>tr>td,
        .px-3>tbody>tr>td {
          padding-right: 16px !important
        }

        .pb-3>tbody>tr>td,
        .py-3>tbody>tr>td {
          padding-bottom: 16px !important
        }

        .pl-3>tbody>tr>td,
        .px-3>tbody>tr>td {
          padding-left: 16px !important
        }

        .p-4>tbody>tr>td {
          padding: 24px !important
        }

        .pt-4>tbody>tr>td,
        .py-4>tbody>tr>td {
          padding-top: 24px !important
        }

        .pr-4>tbody>tr>td,
        .px-4>tbody>tr>td {
          padding-right: 24px !important
        }

        .pb-4>tbody>tr>td,
        .py-4>tbody>tr>td {
          padding-bottom: 24px !important
        }

        .pl-4>tbody>tr>td,
        .px-4>tbody>tr>td {
          padding-left: 24px !important
        }

        .p-5>tbody>tr>td {
          padding: 48px !important
        }

        .pt-5>tbody>tr>td,
        .py-5>tbody>tr>td {
          padding-top: 48px !important
        }

        .pr-5>tbody>tr>td,
        .px-5>tbody>tr>td {
          padding-right: 48px !important
        }

        .pb-5>tbody>tr>td,
        .py-5>tbody>tr>td {
          padding-bottom: 48px !important
        }

        .pl-5>tbody>tr>td,
        .px-5>tbody>tr>td {
          padding-left: 48px !important
        }

        .s-lg-1>tbody>tr>td,
        .s-lg-2>tbody>tr>td,
        .s-lg-3>tbody>tr>td,
        .s-lg-4>tbody>tr>td,
        .s-lg-5>tbody>tr>td {
          font-size: 0 !important;
          line-height: 0 !important;
          height: 0 !important
        }

        .s-0>tbody>tr>td {
          font-size: 0 !important;
          line-height: 0 !important;
          height: 0 !important
        }

        .s-1>tbody>tr>td {
          font-size: 4px !important;
          line-height: 4px !important;
          height: 4px !important
        }

        .s-2>tbody>tr>td {
          font-size: 8px !important;
          line-height: 8px !important;
          height: 8px !important
        }

        .s-3>tbody>tr>td {
          font-size: 16px !important;
          line-height: 16px !important;
          height: 16px !important
        }

        .s-4>tbody>tr>td {
          font-size: 24px !important;
          line-height: 24px !important;
          height: 24px !important
        }

        .s-5>tbody>tr>td {
          font-size: 48px !important;
          line-height: 48px !important;
          height: 48px !important
        }
      }

      @media yahoo {
        .d-mobile {
          display: none !important
        }

        .d-desktop {
          display: block !important
        }

        .w-lg-25 {
          width: 25% !important
        }

        .w-lg-25>tbody>tr>td {
          width: 25% !important
        }

        .w-lg-50 {
          width: 50% !important
        }

        .w-lg-50>tbody>tr>td {
          width: 50% !important
        }

        .w-lg-75 {
          width: 75% !important
        }

        .w-lg-75>tbody>tr>td {
          width: 75% !important
        }

        .w-lg-100 {
          width: 100% !important
        }

        .w-lg-100>tbody>tr>td {
          width: 100% !important
        }

        .w-lg-auto {
          width: auto !important
        }

        .w-lg-auto>tbody>tr>td {
          width: auto !important
        }

        .p-lg-0>tbody>tr>td {
          padding: 0 !important
        }

        .pt-lg-0>tbody>tr>td,
        .py-lg-0>tbody>tr>td {
          padding-top: 0 !important
        }

        .pr-lg-0>tbody>tr>td,
        .px-lg-0>tbody>tr>td {
          padding-right: 0 !important
        }

        .pb-lg-0>tbody>tr>td,
        .py-lg-0>tbody>tr>td {
          padding-bottom: 0 !important
        }

        .pl-lg-0>tbody>tr>td,
        .px-lg-0>tbody>tr>td {
          padding-left: 0 !important
        }

        .p-lg-1>tbody>tr>td {
          padding: 4px !important
        }

        .pt-lg-1>tbody>tr>td,
        .py-lg-1>tbody>tr>td {
          padding-top: 4px !important
        }

        .pr-lg-1>tbody>tr>td,
        .px-lg-1>tbody>tr>td {
          padding-right: 4px !important
        }

        .pb-lg-1>tbody>tr>td,
        .py-lg-1>tbody>tr>td {
          padding-bottom: 4px !important
        }

        .pl-lg-1>tbody>tr>td,
        .px-lg-1>tbody>tr>td {
          padding-left: 4px !important
        }

        .p-lg-2>tbody>tr>td {
          padding: 8px !important
        }

        .pt-lg-2>tbody>tr>td,
        .py-lg-2>tbody>tr>td {
          padding-top: 8px !important
        }

        .pr-lg-2>tbody>tr>td,
        .px-lg-2>tbody>tr>td {
          padding-right: 8px !important
        }

        .pb-lg-2>tbody>tr>td,
        .py-lg-2>tbody>tr>td {
          padding-bottom: 8px !important
        }

        .pl-lg-2>tbody>tr>td,
        .px-lg-2>tbody>tr>td {
          padding-left: 8px !important
        }

        .p-lg-3>tbody>tr>td {
          padding: 16px !important
        }

        .pt-lg-3>tbody>tr>td,
        .py-lg-3>tbody>tr>td {
          padding-top: 16px !important
        }

        .pr-lg-3>tbody>tr>td,
        .px-lg-3>tbody>tr>td {
          padding-right: 16px !important
        }

        .pb-lg-3>tbody>tr>td,
        .py-lg-3>tbody>tr>td {
          padding-bottom: 16px !important
        }

        .pl-lg-3>tbody>tr>td,
        .px-lg-3>tbody>tr>td {
          padding-left: 16px !important
        }

        .p-lg-4>tbody>tr>td {
          padding: 24px !important
        }

        .pt-lg-4>tbody>tr>td,
        .py-lg-4>tbody>tr>td {
          padding-top: 24px !important
        }

        .pr-lg-4>tbody>tr>td,
        .px-lg-4>tbody>tr>td {
          padding-right: 24px !important
        }

        .pb-lg-4>tbody>tr>td,
        .py-lg-4>tbody>tr>td {
          padding-bottom: 24px !important
        }

        .pl-lg-4>tbody>tr>td,
        .px-lg-4>tbody>tr>td {
          padding-left: 24px !important
        }

        .p-lg-5>tbody>tr>td {
          padding: 48px !important
        }

        .pt-lg-5>tbody>tr>td,
        .py-lg-5>tbody>tr>td {
          padding-top: 48px !important
        }

        .pr-lg-5>tbody>tr>td,
        .px-lg-5>tbody>tr>td {
          padding-right: 48px !important
        }

        .pb-lg-5>tbody>tr>td,
        .py-lg-5>tbody>tr>td {
          padding-bottom: 48px !important
        }

        .pl-lg-5>tbody>tr>td,
        .px-lg-5>tbody>tr>td {
          padding-left: 48px !important
        }

        .s-lg-0>tbody>tr>td {
          font-size: 0 !important;
          line-height: 0 !important;
          height: 0 !important
        }

        .s-lg-1>tbody>tr>td {
          font-size: 4px !important;
          line-height: 4px !important;
          height: 4px !important
        }

        .s-lg-2>tbody>tr>td {
          font-size: 8px !important;
          line-height: 8px !important;
          height: 8px !important
        }

        .s-lg-3>tbody>tr>td {
          font-size: 16px !important;
          line-height: 16px !important;
          height: 16px !important
        }

        .s-lg-4>tbody>tr>td {
          font-size: 24px !important;
          line-height: 24px !important;
          height: 24px !important
        }

        .s-lg-5>tbody>tr>td {
          font-size: 48px !important;
          line-height: 48px !important;
          height: 48px !important
        }
      }
    </style>
  </head>

  <body
    style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border: 0;"
    bgcolor="#ffffff">
    <table valign="top" class=" body"
      style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0; padding: 0; border: 0;"
      bgcolor="#ffffff">
      <tbody>
        <tr>
          <td valign="top"
            style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
            align="left">

            <table class="s-4 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
              <tbody>
                <tr>
                  <td height="24"
                    style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 24px; width: 100%; height: 24px; margin: 0;"
                    align="left">

                  </td>
                </tr>
              </tbody>
            </table>

            <table class="container " border="0" cellpadding="0" cellspacing="0"
              style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%;">
              <tbody>
                <tr>
                  <td align="center"
                    style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0; padding: 0 16px;">
                    <!--[if (gte mso 9)|(IE)]>
          <table align="center">
            <tbody>
              <tr>
                <td width="600">
        <![endif]-->
                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                      style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%; max-width: 600px; margin: 0 auto;">
                      <tbody>
                        <tr>
                          <td
                            style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
                            align="left">

                            <table class="row" border="0" cellpadding="0" cellspacing="0"
                              style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
                              <thead>
                                <tr>

                                  <table class="card bg-light" border="0" cellpadding="0" cellspacing="0"
                                    style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: separate !important; border-radius: 4px; width: 100%; overflow: hidden; border: 1px solid #dee2e6;"
                                    bgcolor="#f8f9fa">
                                    <tbody>
                                      <tr>
                                        <td
                                          style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; width: 100%; margin: 0;"
                                          align="left" bgcolor="#f8f9fa">
                                          <div style="width: 800px;">
                                            <table class="s-4 w-100" border="0" cellpadding="0" cellspacing="0"
                                              style="width: 100%;">
                                              <tbody>
                                                <tr>
                                                  <td height="24"
                                                    style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 24px; width: 100%; height: 24px; margin: 0;"
                                                    align="left">

                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>

                                            <table class="card-body " border="0" cellpadding="0" cellspacing="0"
                                              style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%;">
                                              <tbody>
                                                <tr>
                                                  <td
                                                    style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 20px;"
                                                    align="left">
                                                    <div>
                                                      <table class="s-3 w-100" border="0" cellpadding="0"
                                                        cellspacing="0" style="width: 100%;">
                                                        <tbody>
                                                          <tr>
                                                            <td height="16"
                                                              style="border-spacing: 0px; border-collapse: collapse; line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;"
                                                              align="left">

                                                            </td>
                                                          </tr>
                                                        </tbody>
                                                      </table>

                                                      <h4 class="card-title "
                                                        style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 24px; line-height: 28.8px;"
                                                        align="left">New Customer - ' . $customerName . '</h4>
                                                      <table class="s-3 w-100" border="0" cellpadding="0"
                                                        cellspacing="0" style="width: 100%;">
                                                        <tbody>
                                                          <tr>
                                                            <td height="16"
                                                              style="border-spacing: 0px; border-collapse: collapse; line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;"
                                                              align="left">

                                                            </td>
                                                          </tr>
                                                        </tbody>
                                                      </table>


                                                      <table class="row" border="0" cellpadding="0" cellspacing="0"
                                                        style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
                                                        <thead>
                                                          <tr>

                                                            <table class="table table-responsive" border="0"
                                                              cellpadding="0" cellspacing="0"
                                                              style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%; max-width: 100%;">
                                                              <tr>
                                                                <th
                                                                  style="line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">Insert By</th>
                                                                <td class="align-middle"
                                                                  style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">' . $staffName . '</td>
                                                              </tr>
                                                              <tr>
                                                                <th
                                                                  style="line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">Created on</th>
                                                                <td class="align-middle"
                                                                  style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">' . $created . '</td>
                                                              </tr>
                                                              <tr>
                                                                <th
                                                                  style="line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">Source</th>
                                                                <td class="align-middle"
                                                                  style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">' . $source . '</td>
                                                              </tr>
                                                              <tr>
                                                                <th
                                                                  style="line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">Customer Name</th>
                                                                <td class="align-middle"
                                                                  style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">' . $customerName . '</td>
                                                              </tr>
                                                              <tr>
                                                                <th
                                                                  style="line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">Customer Email</th>
                                                                <td class="align-middle"
                                                                  style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">' . $customerEmail . '</td>
                                                              </tr>
                                                              <tr>
                                                                <th
                                                                  style="line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">Customer Phone</th>
                                                                <td class="align-middle"
                                                                  style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">' . $customerPhone . '</td>
                                                              </tr>
                                                              <tr>
                                                                <th
                                                                  style="line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">Address</th>
                                                                <td class="align-middle"
                                                                  style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">' . $address1 . ', ' . $city . ', ' .
    $postcode . ', ' . $state
    . '
                                                                </td>
                                                              </tr>
                                                              <tr>
                                                                <th
                                                                  style="line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">Package Type</th>
                                                                <td class="align-middle"
                                                                  style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">' . $packageType . '</td>
                                                              </tr>
                                                              <tr>
                                                                <th
                                                                  style="line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">Package Name</th>
                                                                <td class="align-middle"
                                                                  style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">' . $packageName . '</td>
                                                              </tr>
                                                              <tr>
                                                                <th
                                                                  style="line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">Package Date</th>
                                                                <td class="align-middle"
                                                                  style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">' . $packageDate . '</td>
                                                              </tr>
                                                              <tr>
                                                                <th
                                                                  style="line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">Pax</th>
                                                                <td class="align-middle"
                                                                  style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">Adult Twin [' . $packageTWN . '] | Adult
                                                                  Single [' .
    $packageSGL .
    '] |
                                                                  Child Twin [' . $packageCTW . '] | Child with Bed [' .
    $packageCWB . '] | Child no
                                                                  Bed
                                                                  [' .
    $packageCNB . ']</td>
                                                              </tr>
                                                              <tr>
                                                                <th
                                                                  style="line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">Other Request</th>
                                                                <td class="align-middle"
                                                                  style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">' . $request . '</td>
                                                              </tr>
                                                              <tr>
                                                                <th
                                                                  style="line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">Assigned to</th>
                                                                <td class="align-middle"
                                                                  style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">
                                                                  <a href="/project/templates/model/crm/view-customer?customerID=' . $customerID . '">Click
                                                                    here to assign staff</a>
                                                                </td>
                                                              </tr>
                                                              <tr>
                                                              </tr>
                                                              <tr>
                                                                <th
                                                                  style="line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">Status</th>
                                                                <td class="align-middle"
                                                                  style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;"
                                                                  align="left">
                                                                  <table class="badge badge-secondary" align="left"
                                                                    border="0" cellpadding="0" cellspacing="0"
                                                                    style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse;">
                                                                    <tbody>
                                                                      <tr>
                                                                        <td
                                                                          style="border-spacing: 0px; border-collapse: collapse; line-height: 1; font-size: 75%; display: inline-block; font-weight: 700; white-space: nowrap; border-radius: 4px; color: #ffffff; margin: 0; padding: 4px 6.4px;"
                                                                          align="center" bgcolor="#868e96"
                                                                          valign="baseline">
                                                                          <span>Unassigned</span>
                                                                        </td>
                                                                      </tr>
                                                                    </tbody>
                                                                  </table>

                                                                </td>
                                                              </tr>
                                                            </table>

                                                          </tr>
                                                        </thead>
                                                      </table>

                                                    </div>
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            <table class="s-4 w-100" border="0" cellpadding="0" cellspacing="0"
                                              style="width: 100%;">
                                              <tbody>
                                                <tr>
                                                  <td height="24"
                                                    style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 24px; width: 100%; height: 24px; margin: 0;"
                                                    align="left">

                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>



                                          </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>


                                </tr>
                              </thead>
                            </table>


                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                </td>
              </tr>
            </tbody>
          </table>
        <![endif]-->
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="s-4 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
              <tbody>
                <tr>
                  <td height="24"
                    style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 24px; width: 100%; height: 24px; margin: 0;"
                    align="left">

                  </td>
                </tr>
              </tbody>
            </table>




          </td>
        </tr>
      </tbody>
    </table>
  </body>

  </html>

';

  // Always set content-type when sending HTML email
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  // More headers
  $headers .= 'From: <postmaster@enrichtravel.my>' . "\r\n";


  mail($to, $subject, $message, $headers);

  // Redirect to summary
  header('Location:/project/templates/model/crm/summary.php');
}
