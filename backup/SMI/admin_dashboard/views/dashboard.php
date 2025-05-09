<?php
//echo '<pre>',print_r($this_year_sales[0]['this_year_sales']),'</pre>';  die;

// print_r($this_year_april); die;
//print_r($last_year_oct); die;


?>
<style type="text/css">
   table {
      border-collapse: separate;
      border-spacing: 2px;
   }

   .tbl tr td {
      text-align: right;
      font-size: 15px;
      padding: 5px 10px 10px 10px;
   }

   .tbl tr td span {
      color: #0094ff;
      font-weight: bold;
   }

   .tbl tr td {
      text-align: right;
      font-size: 15px;
      padding: 0px 10px 4px 9px;
   }

   td span {
      line-height: 2px;
   }

   .spnew {
      color: red !important;
   }

   .sprenew {
      color: darkorange !important;
   }

   .sppaid {
      color: brown !important;
   }

   .spmrenew {
      color: lightcoral !important;
   }
</style>
<div class="page-title">
   <div class="title_left">
      <h3>Dashboard</h3>
   </div>
</div>
<div class="clearfix"></div>
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height: 573px;">
         <div class="x_title">
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <section id="content" class="">
               <table class="tbl" border="1" cellspacing="2" cellpadding="2" width="100%">
                  <tbody>
                     <tr>
                        <td colspan="4" valign="top" style="text-align: left;">
                           <h4><b>Compositions Search </b></h4>
                           <form method="post" id="feedInput" name="searchon" action="<?php echo base_url(); ?>admin_categories/keywordsearch" autocomplete="off">
                              <div class="main">
                                 <div class="row">
                                    <div class="col-md-9 ">
                                       <input type="text" name="home_search_file" class="form-control size col-md-6" id="ajax_search_file" placeholder="Compositions Search" value="<?php echo trim(strip_tags($home_search_file)); ?>">
                                    </div>
                                    <div class="col-md-3"><button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="4" valign="top" style="text-align: left;">
                           <h4><b class=" pull-left">Membership</b> </h4>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="4" valign="top" style="text-align: left;">
                           <table width="100%" cellspacing="2" cellpadding="2" border="1" height="249" style="color:rgb(0,0,0);font-variant-caps:normal">
                              <tbody>

                                 <tr>
                                    <td valign="top" style="text-align: left;"><b>Current Month Totals</b><b><br></b></td>
                                    <td valign="top" style="text-align: left;"><b>Last Month Totals</b><b><br></b></td>
                                    <td valign="top" style="text-align: left;"><b>Website Totals</b><b><br></b></td>
                                 </tr>
                                 <tr>
                                    <td valign="top">
                                       <strong style="float: left;">This Year Totals:</strong>
                                       Members <span><?php echo $membership['current_Month']['Members']; ?></span><br>
                                       Premium Members <span><?php echo $membership['current_Month']['Premium_Members']; ?></span><br>
                                       Standard Members <span><?php echo $membership['current_Month']['Standard_Members']; ?></span><br>
                                       Monthly <span><?php echo $membership['current_Month']['New_Monthly']; ?></span><br><br>
                                      
                                       <strong style="float: left;">New This Month:</strong>
                                       New Premium Members <span><?php echo $membership['current_Month']['New_Premium_Members']; ?></span><br>
                                       New Standard Members <span><?php echo $membership['current_Month']['New_Standard_Members']; ?></span><br>
                                       New Monthly Members <span><?php echo $membership['current_Month']['New_Monthly_Members']; ?></span><br>
                                    </td>
                                    <td valign="top">
                                    <strong style="float: left;">Last Year Totals:</strong>
                                       Total Members <span><?php echo $membership['last_Month']['Members']; ?></span><br>
                                       Premium <span><?php echo $membership['last_Month']['Premium_Members']; ?></span><br>
                                       Standard <span><?php echo $membership['last_Month']['Standard_Members']; ?></span><br>
                                        Monthly <span><?php echo $membership['last_Month']['New_Monthly']; ?></span><br><br>
                                        <strong style="float: left;">New Last Month:</strong>
                                        New Premium <span><?php echo $membership['last_Month']['New_Premium_Members']; ?></span><br>
                                       New Standard <span><?php echo $membership['last_Month']['New_Standard_Members']; ?></span><br>
                                       New Monthly <span><?php echo $membership['last_Month']['New_Monthly_Members']; ?></span><br>
                                    </td>
                                    <td valign="top">
                                       Total Files <span><?php echo count($total_files); ?></span><br>
                                       Total Folders <span><?php echo count($total_folder); ?></span><br><br>
                                       Users that Logged In:<br>
                                       This year <span><?php echo count($new_dahsboard['currentyearlogin']); ?></span><br>
                                       Last year <span><?php echo count($new_dahsboard['previousyearlogin']); ?></span><br><br>
                                       Total # of logins<br>
                                       This year <span><?php echo count($new_dahsboard['currentyearlogin']); ?></span><br>
                                       Last year <span><?php echo count($new_dahsboard['previousyearlogin']); ?></span><br>
                                    </td>
                                 </tr>


                              </tbody>
                           </table>
                        </td>
                     </tr>
                     <?php /*<tr>
                        <td valign="top">
                           Premium members total : <span><?php echo count($paid); ?></span><br />
                           Paid this month : <span><?php echo $new_dahsboard['paid_user_thisMonth']; ?></span> <br />
                           New Premium Members : <span><?php echo $new_dahsboard['new_paid_user_thisMonth']; ?></span>
                           <br />
                           Paid this month Monthly Plan : <span><?php echo $new_dahsboardm['paid_user_thisMonth']; ?></span>
                           <br />
                           New Members Monthly Plan : <span><?php echo $new_dahsboardm['new_paid_user_thisMonth']; ?></span>
                           <br />
                           Applied Group Code Users : <span><?php echo count($user_applied_coupon); ?></span>
                        </td>
                        <td valign="top">Total Members :
                           <span><?php echo count($total); ?></span><br>
                           New This Month : <span><?php echo $new_dahsboard['user_thisMonth']; ?></span> <br />
                           New Last Month : <span><?php echo $new_dahsboard['user_lastMonth']; ?></span>
                           <br />
                           New This Month Monthly Plan : <span><?php echo $new_dahsboardm['user_thisMonth']; ?></span> <br />
                           New Last Month Monthly Plan : <span><?php echo $new_dahsboardm['user_lastMonth']; ?></span>
                        </td>
                        <td valign="top">Total Number of Files :
                           <span><?php echo count($total_files); ?></span>
                           <br>
                           Total Number of Folders :
                           <span><?php echo count($total_folder); ?></span>
                        </td>
                        <td valign="top"> This Year login user :
                           <span><?php echo count($new_dahsboard['currentyearlogin']); ?></span>
                           <br>
                           Previous Year Login User:
                           <span><?php echo count($new_dahsboard['previousyearlogin']); ?></span>
                        </td>
                     </tr><?php */ ?>
                     <tr>
                        <td colspan="4" valign="top" style="text-align: center;">
                           <h4><b>Quarterly deposits this year</b></h4>
                        </td>
                     </tr>
                     <tr>
                        <td valign="top">Deposits 1st. Quartet (Jan-March)
                           <br>
                           $<span><?php if ($this_year_jan) {
                                       echo number_format($this_year_jan, 2) . "<br>";
                                    } else {
                                       echo '0.00';
                                    }   ?></span>
                        </td>
                        <td valign="top">Deposits 2nd. Quarter (April-June)<br>
                           $<span><?php if ($this_year_april) {
                                       echo number_format($this_year_april, 2) . "<br>";
                                    } else {
                                       echo '0.00';
                                    } ?></span>
                        </td>
                        <td valign="top">Deposits 3rd. Quarter (July-September)
                           <br>
                           $<span><?php if ($this_year_july) {
                                       echo number_format($this_year_july, 2) . "<br>";
                                    } else {
                                       echo '0.00';
                                    } ?></span>
                        </td>
                        <td valign="top">Deposits 4th. quartet (October-December)
                           <br>
                           $<span><?php if ($this_year_oct) {
                                       echo number_format($this_year_oct, 2) . "<br>";
                                    } else {
                                       echo '0.00';
                                    } ?></span>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="4" valign="top" style="text-align: center;">
                           <h4><b>Quarterly deposits last year</b></h4>
                        </td>
                     </tr>
                     <tr>
                        <td valign="top">Deposits 1st. Quartet (Jan-March)
                           <br>
                           $<span><?php if ($last_year_jan) {
                                       echo number_format($last_year_jan, 2) . "<br>";
                                    } else {
                                       echo '0.00';
                                    } ?></span>
                        </td>
                        <td valign="top">Deposits 2nd. Quarter (April-June)<br>
                           $<span><?php if ($last_year_april) {
                                       echo number_format($last_year_april, 2) . "<br>";
                                    } else {
                                       echo '0.00';
                                    } ?></span>
                        </td>
                        <td valign="top">Deposits 3rd. Quarter (July-September)
                           <br>
                           $<span><?php if ($last_year_july) {
                                       echo number_format($last_year_july, 2) . "<br>";
                                    } else {
                                       echo '0.00';
                                    } ?></span>
                        </td>
                        <td valign="top">Deposits 4th. quartet (October-December)
                           <br>
                           $<span><?php if ($last_year_oct) {
                                       echo number_format($last_year_oct, 2) . "<br>";
                                    } else {
                                       echo '0.00';
                                    } ?></span>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="4" valign="top" style="text-align: left;">
                           <h4><b class=" pull-left">Finances</b> </h4>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="4">
                           <table style="width: 100%;" border="1">
                              <tbody>
                                 <tr>
                                    <td valign="top">This year total:
                                       <?php echo '<span>' . getYearlyTotla(date('Y')) . "</span>"; ?>
                                    </td>
                                    <td valign="top">Last year total:
                                       <?php echo '<span>' . getYearlyTotla((date('Y') - 1)) . "</span>"; ?>
                                    </td>
                                    <td valign="top">10-Year History</td>
                                 </tr>
                                 <!-- <tr>
                                 <td valign="top" style="text-align: left;">
                                    # Members Paid last 12 months<br />
                                    # New / # paid / renewed
                                 </td>
                                 <td valign="top"> Deposits last 12 months</td>
                                 <td valign="top"> 10-Year History</td>
                              </tr> -->
                                 <tr>
                                    <td valign="top">
                                       Jan. <span><?php echo $new_dahsboard['jan_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['jan_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['jan_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['jan_c_year']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['jan_p']['amount']; ?></span><br />
                                       Feb. <span><?php echo $new_dahsboard['feb_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['feb_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['feb_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['feb_c_year']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['feb_p']['amount']; ?></span><br />
                                       March <span><?php echo $new_dahsboard['mar_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['mar_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['mar_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['mar_c_year']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['mar_p']['amount']; ?></span><br />
                                       April <span><?php echo $new_dahsboard['apr_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['apr_p']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboard['apr_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['apr_c_year']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['apr_p']['amount']; ?></span><br />
                                       May <span><?php echo $new_dahsboard['may_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['may_p']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboard['may_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['may_c_year']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['may_p']['amount']; ?></span><br />
                                       June <span><?php echo $new_dahsboard['jun_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['jun_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['jun_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['jun_c_year']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['jun_p']['amount']; ?></span><br />
                                       July <span><?php echo $new_dahsboard['jul_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['jul_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['jul_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['jul_c_year']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['jul_p']['amount']; ?></span><br />
                                       Aug. <span><?php echo $new_dahsboard['aug_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['aug_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['aug_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['aug_c_year']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['aug_p']['amount']; ?></span><br />
                                       Sept. <span><?php echo $new_dahsboard['sep_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['sep_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['sep_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['sep_c_year']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['sep_p']['amount']; ?></span><br />
                                       Oct. <span><?php echo $new_dahsboard['oct_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['oct_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['oct_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['oct_c_year']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['oct_p']['amount']; ?></span><br />
                                       Nov. <span><?php echo $new_dahsboard['nov_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['nov_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['nov_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['nov_c_year']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['nov_p']['amount']; ?></span><br />
                                       Dec. <span><?php echo $new_dahsboard['dec_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['dec_p']['paid']; ?> <span class="sppaid">P</span>/<?php echo $new_dahsboard['dec_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['dec_c_year']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['dec_p']['amount']; ?></span>
                                    </td>
                                    <td valign="top">
                                       Jan. <span><?php echo $new_dahsboard['jan']['new']; ?> <span class="spnew">N</span>/ <?php echo $new_dahsboard['jan']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboard['jan']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['jan']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['jan']['amount']; ?></span><br />
                                       Feb. <span><?php echo $new_dahsboard['feb']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['feb']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['feb']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['feb']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['feb']['amount']; ?></span><br />
                                       March <span><?php echo $new_dahsboard['mar']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['mar']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['mar']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['mar']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['mar']['amount']; ?></span><br />
                                       April <span><?php echo $new_dahsboard['apr']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['apr']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['apr']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['apr']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['apr']['amount']; ?></span><br />
                                       May <span><?php echo $new_dahsboard['may']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['may']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['may']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['may']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['may']['amount']; ?></span><br />
                                       June <span><?php echo $new_dahsboard['jun']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['jun']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['jun']['renew']; ?><span class="sprenew">R</span>
                                          /<?php echo $new_dahsboard['jun']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['jun']['amount']; ?></span><br />
                                       July <span><?php echo $new_dahsboard['jul']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['jul']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['jul']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['jul']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['jul']['amount']; ?></span><br />
                                       Aug. <span><?php echo $new_dahsboard['aug']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['aug']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['aug']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['aug']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['aug']['amount']; ?></span><br />
                                       Sept. <span><?php echo $new_dahsboard['sep']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['sep']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['sep']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['sep']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['sep']['amount']; ?></span><br />
                                       Oct. <span><?php echo $new_dahsboard['oct']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['oct']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['oct']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['oct']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['oct']['amount']; ?></span><br />
                                       Nov. <span><?php echo $new_dahsboard['nov']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['nov']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['nov']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['nov']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['nov']['amount']; ?></span><br />
                                       Dec. <span><?php echo $new_dahsboard['dec']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['dec']['paid']; ?> <span class="sppaid">P</span>/<?php echo $new_dahsboard['dec']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['dec']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['dec']['amount']; ?></span>
                                    </td>
                                    <td valign="top">
                                       <?php for ($i = date('Y'); $i >= 2015; $i--) {
                                          $lenght = strlen(getYearlyTotla($i));
                                          echo '<span style="margin-right: ' . (100 - ($lenght * 7)) . 'px;">' . $i . '</span>';
                                          echo '<span>' . getYearlyTotla($i) . "</span><br/>";
                                       }  ?>

                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </section>
         </div>
      </div>
   </div>
</div>