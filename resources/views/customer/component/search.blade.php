
<div class="col-lg-5 col-md-8 ml-auto mr-auto col-10">
    <div class="categorie-search-box">
        <form action="{{ route('products.search') }}" method="GET">
            <input type="text" name="search" placeholder="I’m shopping for...">
            <button type="submit"><i class="lnr lnr-magnifier"></i></button>
        </form>
    </div>
</div>