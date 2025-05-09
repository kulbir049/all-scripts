<div class="row">
                    <div class="col-md-3">
                    <p>Level <?php echo $tree_level;?>:</p>

                      </div>
                    <div class="col-md-9">
                        <ul class="section" id="rdoptions">
                    
                 <?php foreach ($objTree as $key => $value) {
                  ?>
                 <li><label class="option">
                        <input name="rdbcomposer" value="<?php echo $value->id;?>" title="Master Composers" type="radio" class="select_radio1" data-tree_level='<?php echo $tree_level;?>'>
                        <span class="radio" style="padding-top: 0px;"></span><?php echo $value->name;?></label></li>
                 <?php } ?>
                            
                        </div>
                    </div>
                    
                    <span id="result"></span>
                <div id="child_multi_level_<?php echo $tree_level;?>" class="child_multi_level">
                    
                </div>
                </div>