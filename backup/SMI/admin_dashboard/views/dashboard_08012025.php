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
td span{line-height: 2px;}
.spnew{
    color: red !important;
}
    .sprenew{
        color: darkorange !important;
    }

    .sppaid{
        color: brown !important;
    }
    .spmrenew{
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
                               <form method="post" id="feedInput" name="searchon" action="<?php echo base_url();?>admin_categories/keywordsearch" autocomplete="off">
                <div class="main">
                
                        <div class="row">
                        <div class="col-md-9 ">
                            
                    
                       
                        <input type="text" name="home_search_file" class="form-control size col-md-6" id="ajax_search_file" placeholder="Compositions Search" value="<?php echo trim(strip_tags($home_search_file));?>">
                        
                        
                        
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
                    <h4><b class=" pull-left">Membership</b>    </h4>
   
        

                </td>
            </tr>
           
            
            <tr>
                <td valign="top">
                    Premium members total : <span><?php echo count($paid); ?></span><br/>

                    Paid this month : <span><?php echo $new_dahsboard['paid_user_thisMonth']; ?></span>  <br/>
                    New Premium Members : <span><?php echo $new_dahsboard['new_paid_user_thisMonth']; ?></span>
                 <br/>

                    Paid this month Monthly Plan : <span><?php echo $new_dahsboardm['paid_user_thisMonth']; ?></span>

                    <br/>
                    New Members Monthly Plan : <span><?php echo $new_dahsboardm['new_paid_user_thisMonth']; ?></span>

                </td>
                <td valign="top">Total Members  :
                     
                    <span><?php echo count($total); ?></span><br>
                

                    New This Month : <span><?php echo $new_dahsboard['user_thisMonth']; ?></span>  <br/>
                    New Last Month : <span><?php echo $new_dahsboard['user_lastMonth']; ?></span>
                    <br/>
                    New This Month Monthly Plan : <span><?php echo $new_dahsboardm['user_thisMonth']; ?></span>  <br/>
                    New Last Month Monthly Plan : <span><?php echo $new_dahsboardm['user_lastMonth']; ?></span>
                </td>
                <td valign="top">Total Number of Files  :
                     
                    <span><?php echo count($total_files); ?></span>
                    <br>
                    Total Number of Folders  :

                    <span><?php echo count($total_folder); ?></span>
                </td>
                <td valign="top"> This Year login user :
                     
                    <span><?php echo count($new_dahsboard['currentyearlogin']); ?></span>
                    <br>
                     Previous Year Login User:

                    <span><?php echo count($new_dahsboard['previousyearlogin']); ?></span>
                </td>

            </tr>
            
            <tr>

                <td colspan="4" valign="top" style="text-align: left;">
                    <h4><b class=" pull-left">Finances</b>    </h4>
   
        

                </td>
            </tr>
            <tr>
                <td valign="top">Deposits this month  :

                    $<span><?php 

                    if(!empty($current_month))
                    {
                        echo number_format($current_month,2)."<br>";
                        
                    }else{
                        echo '0.00';
                    }?>    

                    </span>

                </td>
                <td valign="top">Deposited last year  :
                   
                    $<span><?php echo number_format($last_year,2)."<br>"; ?></span>
                </td>
                <td valign="top">Deposited year to date  :
                   


                    $<span><?php  echo number_format($this_year_data,2)."<br>"; ?></span>
                </td>
                <td valign="top">Sales year to date  :
                    $<span><?php echo number_format($this_year_sales[0]['this_year_sales'],2);


                     ?></span></td>
            </tr>


                
            
           
            
            <tr>
                <td valign="top" style="text-align: left;">
                # Members Paid last 12 months<br/>
                                # New / # paid / renewed

                </td>
                <td valign="top"> Deposits last 12 months</td>
                <td valign="top"> Deposits by year</td>
                <td valign="top">Membership totals : <span><?php echo count($total); ?></span><br/>
                New / Paid / renewed / Total</td>
            </tr>
            <tr>
            <td valign="top">  This month <span><?php echo $new_dahsboard['current_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['current_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['current_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['current_p']['mrenew']; ?><span class="spmrenew">MR</span></span><br/>

                Jan. <span><?php echo $new_dahsboard['jan_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['jan_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['jan_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['jan_p']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['jan_p']['amount']; ?></span><br/>
                Feb. <span><?php echo $new_dahsboard['feb_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['feb_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['feb_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['feb_p']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['feb_p']['amount']; ?></span><br/>
                March <span><?php echo $new_dahsboard['mar_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['mar_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['mar_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['mar_p']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['mar_p']['amount']; ?></span><br/>
                April <span><?php echo $new_dahsboard['apr_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['apr_p']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboard['apr_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['apr_p']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['apr_p']['amount']; ?></span><br/>
                May  <span><?php echo $new_dahsboard['may_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['may_p']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboard['may_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['may_p']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['may_p']['amount']; ?></span><br/>
                June  <span><?php echo $new_dahsboard['jun_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['jun_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['jun_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['jun_p']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['jun_p']['amount']; ?></span><br/>
                July  <span><?php echo $new_dahsboard['jul_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['jul_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['jul_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['jul_p']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['jul_p']['amount']; ?></span><br/>
                Aug.  <span><?php echo $new_dahsboard['aug_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['aug_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['aug_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['aug_p']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['aug_p']['amount']; ?></span><br/>
                Sept. <span><?php echo $new_dahsboard['sep_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['sep_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['sep_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['sep_p']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['sep_p']['amount']; ?></span><br/>
                Oct. <span><?php echo $new_dahsboard['oct_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['oct_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['oct_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['oct_p']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['oct_p']['amount']; ?></span><br/>
                Nov.  <span><?php echo $new_dahsboard['nov_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['nov_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['nov_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['nov_p']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['nov_p']['amount']; ?></span><br/>
                Dec. <span><?php echo $new_dahsboard['dec_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['dec_p']['paid']; ?> <span class="sppaid">P</span>/<?php echo $new_dahsboard['dec_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['dec_p']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['dec_p']['amount']; ?></span></td>
                            <td valign="top">
                            This month <span>$<?php echo $new_dahsboard['current']['amount']; ?></span><br/>

                            Jan. <span><?php echo $new_dahsboard['jan']['new']; ?> <span class="spnew">N</span>/ <?php echo $new_dahsboard['jan']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboard['jan']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['jan']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['jan']['amount']; ?></span><br/>
                Feb. <span><?php echo $new_dahsboard['feb']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['feb']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['feb']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['feb']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['feb']['amount']; ?></span><br/>
                March <span><?php echo $new_dahsboard['mar']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['mar']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['mar']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['mar']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['mar']['amount']; ?></span><br/>
                April <span><?php echo $new_dahsboard['apr']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['apr']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['apr']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['apr']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['apr']['amount']; ?></span><br/>
                May  <span><?php echo $new_dahsboard['may']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['may']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['may']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['may']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['may']['amount']; ?></span><br/>
                June  <span><?php echo $new_dahsboard['jun']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['jun']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['jun']['renew']; ?><span class="sprenew">R</span>
                                    /<?php echo $new_dahsboard['jun']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['jun']['amount']; ?></span><br/>
                July  <span><?php echo $new_dahsboard['jul']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['jul']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['jul']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['jul']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['jul']['amount']; ?></span><br/>
                Aug.  <span><?php echo $new_dahsboard['aug']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['aug']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['aug']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['aug']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['aug']['amount']; ?></span><br/>
                Sept. <span><?php echo $new_dahsboard['sep']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['sep']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['sep']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['sep']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['sep']['amount']; ?></span><br/>
                Oct. <span><?php echo $new_dahsboard['oct']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['oct']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['oct']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['oct']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['oct']['amount']; ?></span><br/>
                Nov.  <span><?php echo $new_dahsboard['nov']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['nov']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboard['nov']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['nov']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['nov']['amount']; ?></span><br/>
                Dec. <span><?php echo $new_dahsboard['dec']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['dec']['paid']; ?> <span class="sppaid">P</span>/<?php echo $new_dahsboard['dec']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboard['dec']['mrenew']; ?><span class="spmrenew">MR</span>/ $<?php echo $new_dahsboard['dec']['amount']; ?></span>
                 </td>
                            <td valign="top">Year to Date <span>$<?php  echo number_format($this_year_data_mem,2); ?></span><br/>
                Last Year <span>$<?php echo number_format($last_year_mem,2); ?></span><br/>
                Previous Year <span>$<?php echo $previous_last_year;?></span> </td>
                            <td valign="top">
                            Year to date <span> <?php echo $new_dahsboard['year_to_date']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['year_to_date']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboard['year_to_date']['renew']; ?><span class="sprenew">R</span>/ <?php echo $new_dahsboard['year_to_date']['mrenew']; ?><span class="spmrenew">MR</span>/ <?php echo count($total_mem); ?></span><br/>
                Last Year <span> <?php echo $new_dahsboard['year_last']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['year_last']['paid']; ?><span class="sppaid">P</span>/  <?php echo $new_dahsboard['year_last']['renew']; ?><span class="sprenew">R</span>/ <?php echo $new_dahsboard['year_last']['mrenew']; ?><span class="spmrenew">MR</span>/ <?php echo (count($total_mem)-$new_dahsboard['year_to_date']['new']); ?></span><br/>
                Year Before <span> <?php echo $new_dahsboard['year_before']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['year_before']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboard['year_before']['renew']; ?><span class="sprenew">R</span>/ <?php echo $new_dahsboard['year_before']['mrenew']; ?><span class="spmrenew">MR</span>/ <?php echo (count($total_mem)-$new_dahsboard['year_to_date']['new']-$new_dahsboard['year_last']['new']); ?></span><br/>


                                Previous Year <span> <?php echo $new_dahsboard['year_previous2']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['year_previous2']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboard['year_previous2']['renew']; ?><span class="sprenew">R</span>/ <?php echo $new_dahsboard['year_previous2']['mrenew']; ?><span class="spmrenew">MR</span>/ <?php echo (count($total_mem)-$new_dahsboard['year_to_date']['new']-$new_dahsboard['year_last']['new'])-$new_dahsboard['year_before']['new']; ?></span><br/>

                                Previous Year <span> <?php echo $new_dahsboard['year_previous3']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboard['year_previous3']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboard['year_previous3']['renew']; ?><span class="sprenew">R</span>/ <?php echo $new_dahsboard['year_previous3']['mrenew']; ?><span class="spmrenew">MR</span>/ <?php echo (count($total_mem)-$new_dahsboard['year_to_date']['new']-$new_dahsboard['year_last']['new'])-$new_dahsboard['year_before']['new']-$new_dahsboard['year_previous2']['new']; ?></span><br/>
                 </td>
                            </tr>

                <tr>
                    <td colspan="4" valign="top" style="text-align: center;">
                        <h4><b>Monthly Plan Details</b></h4>
                    </td>
                </tr>
                <tr>
                    <td valign="top">  This month <span><?php echo $new_dahsboardm['current_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['current_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['current_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['current_p']['mrenew']; ?><span class="spmrenew">YR</span></span><br/>

                        Jan. <span><?php echo $new_dahsboardm['jan_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['jan_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['jan_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['jan_p']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['jan_p']['amount']; ?></span><br/>
                        Feb. <span><?php echo $new_dahsboardm['feb_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['feb_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['feb_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['feb_p']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['feb_p']['amount']; ?></span><br/>
                        March <span><?php echo $new_dahsboardm['mar_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['mar_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['mar_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['mar_p']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['mar_p']['amount']; ?></span><br/>
                        April <span><?php echo $new_dahsboardm['apr_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['apr_p']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboardm['apr_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['apr_p']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['apr_p']['amount']; ?></span><br/>
                        May  <span><?php echo $new_dahsboardm['may_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['may_p']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboardm['may_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['may_p']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['may_p']['amount']; ?></span><br/>
                        June  <span><?php echo $new_dahsboardm['jun_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['jun_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['jun_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['jun_p']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['jun_p']['amount']; ?></span><br/>
                        July  <span><?php echo $new_dahsboardm['jul_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['jul_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['jul_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['jul_p']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['jul_p']['amount']; ?></span><br/>
                        Aug.  <span><?php echo $new_dahsboardm['aug_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['aug_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['aug_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['aug_p']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['aug_p']['amount']; ?></span><br/>
                        Sept. <span><?php echo $new_dahsboardm['sep_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['sep_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['sep_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['sep_p']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['sep_p']['amount']; ?></span><br/>
                        Oct. <span><?php echo $new_dahsboardm['oct_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['oct_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['oct_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['oct_p']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['oct_p']['amount']; ?></span><br/>
                        Nov.  <span><?php echo $new_dahsboardm['nov_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['nov_p']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['nov_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['nov_p']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['nov_p']['amount']; ?></span><br/>
                        Dec. <span><?php echo $new_dahsboardm['dec_p']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['dec_p']['paid']; ?> <span class="sppaid">P</span>/<?php echo $new_dahsboardm['dec_p']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['dec_p']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['dec_p']['amount']; ?></span></td>
                    <td valign="top">
                        This month <span>$<?php echo $new_dahsboardm['current']['amount']; ?></span><br/>

                        Jan. <span><?php echo $new_dahsboardm['jan']['new']; ?> <span class="spnew">N</span>/ <?php echo $new_dahsboardm['jan']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboardm['jan']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['jan']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['jan']['amount']; ?></span><br/>
                        Feb. <span><?php echo $new_dahsboardm['feb']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['feb']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['feb']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['feb']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['feb']['amount']; ?></span><br/>
                        March <span><?php echo $new_dahsboardm['mar']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['mar']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['mar']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['mar']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['mar']['amount']; ?></span><br/>
                        April <span><?php echo $new_dahsboardm['apr']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['apr']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['apr']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['apr']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['apr']['amount']; ?></span><br/>
                        May  <span><?php echo $new_dahsboardm['may']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['may']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['may']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['may']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['may']['amount']; ?></span><br/>
                        June  <span><?php echo $new_dahsboardm['jun']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['jun']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['jun']['renew']; ?><span class="sprenew">R</span>
                                    /<?php echo $new_dahsboardm['jun']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['jun']['amount']; ?></span><br/>
                        July  <span><?php echo $new_dahsboardm['jul']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['jul']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['jul']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['jul']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['jul']['amount']; ?></span><br/>
                        Aug.  <span><?php echo $new_dahsboardm['aug']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['aug']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['aug']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['aug']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['aug']['amount']; ?></span><br/>
                        Sept. <span><?php echo $new_dahsboardm['sep']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['sep']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['sep']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['sep']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['sep']['amount']; ?></span><br/>
                        Oct. <span><?php echo $new_dahsboardm['oct']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['oct']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['oct']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['oct']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['oct']['amount']; ?></span><br/>
                        Nov.  <span><?php echo $new_dahsboardm['nov']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['nov']['paid']; ?><span class="sppaid">P</span>/<?php echo $new_dahsboardm['nov']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['nov']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['nov']['amount']; ?></span><br/>
                        Dec. <span><?php echo $new_dahsboardm['dec']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['dec']['paid']; ?> <span class="sppaid">P</span>/<?php echo $new_dahsboardm['dec']['renew']; ?><span class="sprenew">R</span>/<?php echo $new_dahsboardm['dec']['mrenew']; ?><span class="spmrenew">YR</span>/ $<?php echo $new_dahsboardm['dec']['amount']; ?></span>
                    </td>
                    <td valign="top">Year to Date <span>$<?php  echo number_format($this_year_datam,2); ?></span><br/>
                        Last Year <span>$<?php echo number_format($last_yearm,2); ?></span><br/>
                        Previous Year <span>$<?php echo $previous_last_yearm;?></span> </td>
                    <td valign="top">
                        Year to date <span> <?php echo $new_dahsboardm['year_to_date']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['year_to_date']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboardm['year_to_date']['renew']; ?><span class="sprenew">R</span>/ <?php echo $new_dahsboardm['year_to_date']['mrenew']; ?><span class="spmrenew">YR</span>/ <?php echo count($totalm); ?></span><br/>
                        Last Year <span> <?php echo $new_dahsboardm['year_last']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['year_last']['paid']; ?><span class="sppaid">P</span>/  <?php echo $new_dahsboardm['year_last']['renew']; ?><span class="sprenew">R</span>/ <?php echo $new_dahsboardm['year_last']['mrenew']; ?><span class="spmrenew">YR</span>/ <?php echo (count($totalm)-$new_dahsboardm['year_to_date']['new']); ?></span><br/>
                        Year Before <span> <?php echo $new_dahsboardm['year_before']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['year_before']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboardm['year_before']['renew']; ?><span class="sprenew">R</span>/ <?php echo $new_dahsboardm['year_before']['mrenew']; ?><span class="spmrenew">YR</span>/ <?php echo (count($totalm)-$new_dahsboardm['year_to_date']['new']-$new_dahsboardm['year_last']['new']); ?></span><br/>


                        Previous Year <span> <?php echo $new_dahsboardm['year_previous2']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['year_previous2']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboardm['year_previous2']['renew']; ?><span class="sprenew">R</span>/ <?php echo $new_dahsboardm['year_previous2']['mrenew']; ?><span class="spmrenew">YR</span>/ <?php echo (count($totalm)-$new_dahsboardm['year_to_date']['new']-$new_dahsboardm['year_last']['new'])-$new_dahsboardm['year_before']['new']; ?></span><br/>

                        Previous Year <span> <?php echo $new_dahsboardm['year_previous3']['new']; ?><span class="spnew">N</span>/ <?php echo $new_dahsboardm['year_previous3']['paid']; ?><span class="sppaid">P</span>/ <?php echo $new_dahsboardm['year_previous3']['renew']; ?><span class="sprenew">R</span>/ <?php echo $new_dahsboardm['year_previous3']['mrenew']; ?><span class="spmrenew">YR</span>/ <?php echo (count($totalm)-$new_dahsboardm['year_to_date']['new']-$new_dahsboardm['year_last']['new'])-$new_dahsboardm['year_before']['new']-$new_dahsboardm['year_previous2']['new']; ?></span><br/>
                    </td>
                </tr>
            <tr>
                <td colspan="4" valign="top" style="text-align: center;">
                    <h4><b>Quarterly deposits this year</b></h4>
                </td>
            </tr>
            <tr>
                <td valign="top">Deposits 1st.   Quartet  (Jan-March)
                    <br>
                    
                    $<span><?php if($this_year_jan){
                        echo number_format($this_year_jan,2)."<br>";
                        }else{
                            echo '0.00';
                            }   ?></span>
                </td>
                <td valign="top">Deposits 2nd. Quarter (April-June)<br>

                    
                   $<span><?php if($this_year_april)
                   {
                    echo number_format($this_year_april,2)."<br>";
                    }else{
                        echo '0.00';
                    } ?></span>
                </td>
                <td valign="top">Deposits 3rd.  Quarter  (July-September)
                    <br>
                     
                    $<span><?php  if($this_year_july)
                    {
                        echo number_format($this_year_july,2)."<br>";
                    }else{
                        echo '0.00';
                    } ?></span>
                </td>
                <td valign="top">Deposits 4th. quartet (October-December)
                    <br>

                    $<span><?php if($this_year_oct){
                     echo number_format($this_year_oct,2)."<br>";
                     }else{  echo '0.00';
                      } ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="4" valign="top" style="text-align: center;">
                    <h4><b>Quarterly deposits last year</b></h4>
                </td>
            </tr>
            <tr>
                <td valign="top">Deposits 1st.   Quartet  (Jan-March)
                    <br>
                    $<span><?php if($last_year_jan){
                     echo number_format($last_year_jan,2)."<br>";
                     }else{ echo '0.00';
                      } ?></span>
                </td>
                <td valign="top">Deposits 2nd. Quarter (April-June)<br>
                    
                   $<span><?php if($last_year_april){
                    echo number_format($last_year_april,2)."<br>";
                    }else{ echo '0.00';
                     } ?></span>
                </td>
                <td valign="top">Deposits 3rd.  Quarter  (July-September)
                    <br>
                   
                   $<span><?php if($last_year_july){
                    echo number_format($last_year_july,2)."<br>";
                    }else{ echo '0.00';
                    } ?></span>
                </td>
                <td valign="top">Deposits 4th. quartet (October-December)
                    <br>
                    
                    $<span><?php if($last_year_oct){
                     echo number_format($last_year_oct,2)."<br>";
                     }else{
                        echo '0.00';
                     } ?></span>
                </td>
            </tr> 







    </tbody>
    </table>
    </section>
        </div>
    </div>
    </div>
    </div>