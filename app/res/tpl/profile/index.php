<!-- Profile -->
<article class="main">

    <header>
		<h1><?php echo I18n::__('account_h1') ?></h1>
		<nav>
            
        </nav>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4" id="profile_container1">
            <div class="card" id="profile_left">
                <div class="card-body">

                    <div class="profile_image" style="background-color:grey; height:200px;margin-bottom:15px;">
                      
                    </div>

                    <div class="profile_info">
                        <h1><?php echo Flight::get('user')->name ?></h1>
                        <h1><?php echo I18n::__('user_reviews') ?>:  <?php echo count($records);?></h1>
                    </div>   
              
                </div>
            </div>  

            </div>
            <div class="col-md-8">
            
            <?php
        /**
         * Loop thru all the reports from the user
         * Fetch the relevant details and also company reviews/rates
         */
        foreach ($records as $id => $_record):
            $compname = $_record->person->name;
            $reportcontent = $_record->content;
        ?>

                <div class="container myreports">
                    <div class="card">
                        <div class="card-body">
                           <div class="row" id="report_head">
                                <div class="col-6">
                                    <h1><?php echo $compname ?></h1>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-outline-dark" id="rate_button"><?php echo I18n::__('business_rate_button') ?></button>
                                </div>
                           </div>
                           
                            
                           <div class="row">
                               <div class="col-md-6" id="report_rate">
                              
                                <div class="row">
                                    <div class="col-md-3"> <span class="positive_icon"><img src="/img/glyphicons/glyphicons_343_thumbs_up.png" alt=""></span> <span class="positive_result"><?php echo $_record->person->positive ?></span> </div>
                                    <div class="col-md-3"> <img src="/img/glyphicons/glyphicons_344_thumbs_down.png" alt=""> <span class="positive_result"><?php echo $_record->person->negative ?></span></div>
                                </div>

                               </div>
                               <div class="col-md-6">
                                <span id="report_date"><?php echo(strftime("%B %d %Y",$_record->stamp));?></span>
                               </div>
                
                           </div>

                           <div class="row" id="report_content">
                                <div class="col-md-12">
                                  <p>
                                  <?php echo $reportcontent ?>
                                  </p>
                               </div>
                
                           </div>

                        </div>
                    </div>
                </div>
            <?php endforeach ?>

            </div>
        </div>
    </div>
<article>
<!-- Profile End -->