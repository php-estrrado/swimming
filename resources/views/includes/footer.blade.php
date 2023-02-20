
<footer id="footer">
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                    <a href="{{ url('/') }}"><img src="{{ url('/public/images/bm_logo.png') }}" alt="" /></a>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-12 ftmenu">
                    <?php if(getFooterMenu()) echo str_replace("{{ url('/') }}",$app['url']->to('/'),getFooterMenu()->content); ?>
                    <?php if(getCopyRights()) echo getCopyRights()->content; ?>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <?php if(getSocialLinks()) echo getSocialLinks()->content; ?>
                </div>
            </div>
        </div>
    </div>
</footer>

