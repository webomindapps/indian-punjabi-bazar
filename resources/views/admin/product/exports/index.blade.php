<table>
    <thead>
        <tr>
            <th>Sl No</th>
            <th>Category</th>
            <th>Name</th>
            <th>SKU</th>
            <th>Brand</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Cost</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @foreach ($product->categories as $category)
                        <span>{{ $category->category?->slug }}</span>,
                    @endforeach
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->brand_name?->name }}</td>
                <td>{{ $product->inventory?->inventory }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->cost }}</td>
                <td>{{ $product->status ? 'Active' : 'Not Active' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
