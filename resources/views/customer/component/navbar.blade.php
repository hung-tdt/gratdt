

@php $productCategoriesHtml =  \App\Helpers\Helper::productCategories($productCategories); @endphp
<div class="col-xl-3 col-lg-4 d-none d-lg-block">
    <div class="vertical-menu mb-all-30">
        <nav>
            <ul class="vertical-menu-list">
                {!! $productCategoriesHtml !!}
            </ul>
        </nav>
    </div>
</div>
