<form action="{{ request()->segment(2) == 'product' ? 'shop' : '' }}">
    <div class="filter-widget">
        <h4 class="fw-title">Categories</h4>
        <ul class="filter-catagories">
            @foreach ($category as $item)
                <li>
                    <a href="shop/category/{{ $item->name }}">{{ $item->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Brand</h4>
        <div class="fw-brand-check">
            @foreach ($brand as $item)
                <div class="bc-item">
                    <label for="bc-{{ $item->id }}">
                        {{ $item->name }}
                        <input {{ (request('brand')[$item->id] ?? '') == 'on' ? 'checked' : '' }}
                            name="brand[{{ $item->id }}]" type="checkbox" id="bc-{{ $item->id }}"
                            onchange="this.form.submit();">
                        <span class="checkmark"></span>
                    </label>
                </div>
            @endforeach

        </div>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Price</h4>
        <div class="filter-range-wrap">
            <div class="range-slider">
                <div class="price-input">
                    <input type="text" id="minamount" name="price_min">
                    <input type="text" id="maxamount" name="price_max">
                </div>
            </div>
            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                data-min="10" data-max="999" data-min-value="{{ str_replace('$', '', request('price_min')) }}"
                data-max-value="{{ str_replace('$', '', request('price_max')) }}">
                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
            </div>
        </div>
        <div class="bg-filter"> <button type="submit" class="filter-btn">Filter</button></div>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Color</h4>
        <div class="fw-color-choose">
            <div class="cs-item">
                <input type="radio" name="color" id="cs-black" onchange="this.form.submit();"
                    {{ request('color') == 'black' ? 'checked' : '' }} value="black">
                <label class="cs-black" for="cs-black">Black</label>
            </div>
            <div class="cs-item">
                <input type="radio" name="color" id="cs-violet" onchange="this.form.submit();"
                    {{ request('color') == 'violet' ? 'checked' : '' }} value="violet">
                <label class="cs-violet" for="cs-violet">Violet</label>
            </div>
            <div class="cs-item">
                <input type="radio" name="color" id="cs-blue" onchange="this.form.submit();"
                    {{ request('color') == 'blue' ? 'checked' : '' }} value="blue">
                <label class="cs-blue" for="cs-blue">Blue</label>
            </div>
            <div class="cs-item">
                <input type="radio" name="color" id="cs-yellow" onchange="this.form.submit();"
                    {{ request('color') == 'yellow' ? 'checked' : '' }} value="yellow">
                <label class="cs-yellow" for="cs-yellow">Yellow</label>
            </div>
            <div class="cs-item">
                <input type="radio" name="color" id="cs-red" onchange="this.form.submit();"
                    {{ request('color') == 'red' ? 'checked' : '' }} value="red">
                <label class="cs-red" for="cs-red">Red</label>
            </div>
            <div class="cs-item">
                <input type="radio" name="color" id="cs-green" onchange="this.form.submit();"
                    {{ request('color') == 'green' ? 'checked' : '' }} value="green">
                <label class="cs-green" for="cs-green">Green</label>
            </div>
        </div>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Size</h4>
        <div class="fw-size-choose">
            <div class="sc-item">
                <input type="radio" name="size" onchange="this.form.submit();"
                    {{ request('size') == 'S' ? 'checked' : '' }} id="s-size" value="S">
                <label class="{{ request('size') == 'S' ? 'active' : '' }}" for="s-size">S</label>
            </div>
            <div class="sc-item">
                <input type="radio" name="size" onchange="this.form.submit();"
                    {{ request('size') == 'M' ? 'checked' : '' }} id="m-size" value="M">
                <label class="{{ request('size') == 'M' ? 'active' : '' }}" for="m-size">M</label>
            </div>
            <div class="sc-item">
                <input type="radio" name="size" onchange="this.form.submit();"
                    {{ request('size') == 'L' ? 'checked' : '' }} id="l-size" value="L">
                <label class="{{ request('size') == 'L' ? 'active' : '' }}" for="l-size">L</label>
            </div>
            <div class="sc-item">
                <input type="radio" name="size" onchange="this.form.submit();"
                    {{ request('size') == 'XL' ? 'checked' : '' }} id="xl-size" value="XL">
                <label class="{{ request('size') == 'XL' ? 'active' : '' }}" for="xl-size">XL</label>
            </div>
        </div>
    </div>
    {{-- <div class="filter-widget">
        <h4 class="fw-title">Tags</h4>
        <div class="fw-tags">
            <a href="">Towel</a>
            <a href="">Shoes</a>
            <a href="">Coat</a>
            <a href="">Dresses</a>
            <a href="">Trousers</a>
            <a href="">Men`s hats</a>
            <a href="">Backpack</a>
        </div>
    </div> --}}
</form>
