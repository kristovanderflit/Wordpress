<form id="searchForm" class="smartlib-navbar-search-form pull-right"
      action="<?php echo home_url('/'); ?>" method="get"
      novalidate="novalidate">



    <div class="input-group">
        <div class="smartlib-input-search-outer">
            <a href="#" class="btn smartlib-search-close-form smartlib-btn-close"></a>
        <input id="search-input" class="form-control" type="text" name="s"
               placeholder="<?php _e('Search for ...', 'bootframe-core'); ?>" value="">
        </div>
        <div class="input-group-btn">



									<button class="btn btn-default btn-sm smartlib-search-btn pull-right" type="submit">

                                        <i class="fa fa-search"></i>

                                    </button>

        </div>

    </div>

</form>