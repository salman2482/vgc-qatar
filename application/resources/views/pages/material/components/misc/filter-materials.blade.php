<div class="right-sidebar" id="sidepanel-filter-materials">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <i class="icon-Filter-2"></i>{{ cleanLang(__('Filter Materials')) }}
                <span>
                    <i class="ti-close js-toggle-side-panel" data-target="sidepanel-filter-materials"></i>
                </span>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body">

                <!--client-->
                <div class="filter-block">
                    <div class="title">
                        {{ cleanLang(__('Select Material')) }}
                    </div>
                    <div class="fields">
                        <div class="row">
                            <div class="col-md-12">
                                <!--select2 basic search-->
                                    <select class="select2-basic form-control form-control-sm" name="material_category" id="material_category"
                                        data-allow-clear="false" >
                                        <option value="soft service">Soft Service</option>
                                        <option value="hard service">Hard Service</option>
                                        <option value="office supply">Office Supply</option>
                                        <option value="transport">Transport</option>
                                    </select>
                                <!--select2 basic search-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--client-->
                <!--buttons-->
                <div class="buttons-block">
                    <button type="button" name="foo1"
                        class="btn btn-rounded-x btn-secondary js-reset-filter-side-panel">{{ cleanLang(__('lang.reset')) }}</button>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="source" value="{{ $page['source_for_filter_panels'] ?? '' }}">
                    <button type="button" class="btn btn-rounded-x btn-danger js-ajax-ux-request apply-filter-button"
                    data-url="{{ urlResource('/materials/search') }}"
                    data-type="form" data-ajax-type="GET">{{ cleanLang(__('lang.apply_filter')) }}</button>
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>