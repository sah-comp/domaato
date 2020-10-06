
<article>

    <section class="user_profile" id="profile">
        <div class="profile-main clearfix">
            <div class="row">
                <div class="span3" id="profile_left">
                    <div class="image_wrapper">
                        <div class="profile_image">
                           
                        </div>
                    </div>

                    <div class="user_details">
                        <h2><?php echo $record->name ?></h2>
                        <h2><?php echo I18n::__('user_reports') ?>: </h2>
                        <?php if (Flight::has('user')): ?>
                            <div class="edit_profile">
                                <div class="row">
                                <a href="<?php echo Url::build('/profile/edit/' . $record->hash  ) ?>">
                                    <div class="span3">
                                        <img src="/img/glyphicons/glyphicons_030_pencil.png" alt="">
                                    </div>
                                    <div class="span6"><span><?php echo I18n::__('edit_profile') ?></span></div>
                                </a>
                                    
                                </div>
                            </div>
                        <?php else: ?>   
                               asd 
                        <?php endif; ?>
                    </div>
             
                </div>
                <div class="span8">
               <?php foreach ($records as $id => $report):
                $report_content = $report->content;
                $report_company = $report->person->name;
                $report_vote = $report->vote;
        ?>

                    <div class="user_reports">
                        <div class="report_name">

                            <div class="row">
                                <div class="span6">
                                <h4 class="report_title"><?php echo $report_company ?></h4> 
                                </div>
                                <div class="span6">
                                    <div id="report_add">
                                    <a href="<?php echo Url::build('/file-a-report/' . $report->person->id) ?>">
                                        <button class="profile_button">
                                            <?php echo I18n::__('add_report') ?>
                                        </button>
                                    </a>
                                    
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="report_content">
                            <div class="row">
                                <div class="span3" id="user_votes">
                             
                                    <!-- echo $report_vote on positive --> 
                                    <span><img src="/img/glyphicons/glyphicons_343_thumbs_up.png" alt="">
                                    </span><span id="vote_positive"><?php echo $report->person->positive ?></span> 
                                      <!-- Assign 0 on negative --> 
                                    <span id="vote_icon2"><img src="/img/glyphicons/glyphicons_344_thumbs_down.png" alt="">
                                    <span id="vote_negative"><?php echo $report->person->negative ?></span></span>

                                </div>
                            </div>
                           <a href="<?php echo Url::build('/review-a-report/' . $report->id) ?>" id="report_link"><p> <?php echo $report_content ?> </p> </a>
                        </div>

                        <div class="report_content2">
                           <h2>Comments  <?php 
                            $comments = R::count('comment', "report_id=?", [$report->id]);
                            echo $comments; ?></h2>
                        </div>

                    </div>
                <?php endforeach ?>
                    
                </div>
            </div>
        
        </div>
    </section>

</article>
