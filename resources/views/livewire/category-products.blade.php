<div wire:init="loadPosts">
    @if (count($products))
        <div class="glider-contain">
            <ul class="glider-{{ $category->id }}">

                @foreach ($products as $product)
                    <li class="bg-white rounded-lg shadow {{ $loop->last ? '' : 'sm:mr-4' }}">
                        <article>
                            <a href="{{ route('products.show', $product) }}">
                                <figure>

                                    @if ($product->images->count())
                                        <img class="h-48 w-full object-cover object-center"
                                            src="{{ Storage::url($product->images->first()->url) }}"
                                            alt="img-{{ $product->slug }}">
                                    @else
                                        <x-icon-product-deafult />
                                    @endif
                                </figure>
                            </a>
                            <div class="py-4 px-6">
                                <h1 class="text-lg font-semibold">
                                    <a href="{{ route('products.show', $product) }}">
                                        {{ Str::limit($product->name, 20) }}
                                    </a>
                                </h1>
                                <p class="font-bold text-trueGray-700">$MXN {{ $product->price }}</p>
                            </div>
                        </article>

                    </li>
                @endforeach
            </ul>

            <button aria-label="Previous" class="glider-prev">«</button>
            <button aria-label="Next" class="glider-next">»</button>
            <div role="tablist" class="dots"></div>
        </div>
    @else
        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <i class="fas fa-spinner animate-spin text-Orange-700 sm:text-5xl text-3xl"></i>
        </div>
    @endif
</div>
