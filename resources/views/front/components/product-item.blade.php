<div class="product-item item {{ $item->tag }}">
    <div class="pi-pic">
        <img src="front/img/products/{{ $item->productImages[0]->path }}" alt="">
        @if ($item->discount != null)
            <div class="sale" style="font-size: 15px;">
                Sale {{ round((($item->price - $item->discount) / $item->price) * 100) }}%
            </div>
        @endif
        <div class="icon">
            <i class="icon_heart_alt"></i>
        </div>
        <ul>
            <li class="w-icon active"><a href="{{ route('cart.create', $item->id) }}"><i class="icon_bag_alt"></i></a>
            </li>
            <li class="quick-view"><a href="{{ route('productDetail.index', $item->id) }}">Quick View</a></li>
            <li class="w-icon"><a href=""><i class="fa fa-random"></i></a></li>
        </ul>
    </div>
    <div class="pi-text">
        <div class="category-name">{{ $item->tag }}</div>
        <a href="{{ route('productDetail.index', $item->id) }}">
            <h5>{{ $item->name }}</h5>
        </a>
        <div class="product-price">
            @if ($item->discount != null)
                ${{ $item->discount }}
                <span>${{ $item->price }}</span>
            @else
                ${{ $item->price }}
            @endif
        </div>
    </div>
</div>
