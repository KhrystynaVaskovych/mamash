{!! view_render_event('bagisto.shop.products.list.card.before', ['product' => $product]) !!}

<div class="product-card bg-orange-light border border-orange px-4 py-3 relative">

    @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')

    <?php $productBaseImage = $productImageHelper->getProductBaseImage($product); ?>

    @if ($product->new)
        <div class="sticker new">
            {{ __('shop::app.products.new') }}
        </div>
    @endif

    <div class="product-information">
        @if ($product->line)
            <div class="text-base text-center text-gray-dark">
                {{ $product->name }}
            </div>
        @endif

        <div class="product-name cursor-pointer text-gray-dark uppercase text-xl text-center mb-2">
            <a href="{{ url()->to('/').'/products/' . $product->url_key }}" title="{{ $product->name }}">
                <span>
                    {{ $product->name }}
                </span>
            </a>
        </div>

        @include ('shop::products.price', ['product' => $product])

        @include('shop::products.add-buttons', ['product' => $product])
    </div>

    <div class="product-image flex justify-content-center items-center overflow-hidden">
        <a href="{{ route('shop.products.index', $product->url_key) }}" title="{{ $product->name }}" class="my-auto mx-auto">
            <img class="h-full object-cover" src="{{ $productBaseImage['medium_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'"/>
        </a>
    </div>


</div>

{!! view_render_event('bagisto.shop.products.list.card.after', ['product' => $product]) !!}