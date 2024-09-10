<x-app-layout>
    <x-customer-profile>
        <div class="add_box">
            <h3>My Wishlist</h3>
            <hr>
            <div class="row g-3">
                @foreach ($wishlists as $wishlist)
                    <div class="col-md-3">
                        <div class="position-relative bg-white">
                            <a onclick="return confirm('Are you sure you want to remove?')"
                                href="{{ route('wishlist.remove', $wishlist->id) }}" class="position-absolute top-0 end-0"
                                style="z-index: 2;">
                                <i class='bx bxs-trash p-2 m-1 bg-danger rounded text-white'></i>
                            </a>
                            <x-products.card :product="$wishlist->product" />
                        </div>
                    </div>
                @endforeach
            </div>
    </x-customer-profile>
</x-app-layout>
