<?php global $qodeIconCollections;?>
<form role="search" id="searchform" action="<?php echo home_url('/'); ?>" class="qode_search_form" method="get">
    <?php if($header_in_grid){ ?>
    <div class="container">
        <div class="container_inner clearfix">
            <?php } ?>

            <?php $qodeIconCollections->getSearchIcon(qodef_option_get_value('search_icon_pack'), array('icon_attributes' => array('class' => 'qode_icon_in_search'))); ?>
            <input type="text" placeholder="<?php _e('Search', 'qode'); ?>" name="s" class="qode_search_field" autocomplete="off" />
            <input type="submit" value="Search" />

            <div class="qode_search_close">
                <a href="#">
                    <?php $qodeIconCollections->getSearchClose(qodef_option_get_value('search_icon_pack'), array('icon_attributes' => array('class' => 'qode_icon_in_search'))); ?>
                </a>
            </div>
            <?php if($header_in_grid){ ?>
        </div>
    </div>
<?php } ?>
</form>
